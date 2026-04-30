'use client'

import { useState } from 'react'
import Link from 'next/link'
import { ArrowLeft, ArrowRight, CheckCircle2, User, Phone, Mail, MapPin, Home, FlaskConical, Pill, Hospital, Siren, MoreHorizontal } from 'lucide-react'
import { submitCareRequest } from '@/lib/careRequests'

type ServiceType = 'Home Visit' | 'Lab Test' | 'Medication Delivery' | 'Hospital Support' | 'Emergency' | 'Others'
type Step = 'form' | 'submitted'

interface FormData {
  name: string
  phone: string
  email: string
  location: string
  services: ServiceType[]
  notes: string
}

const SERVICES: { type: ServiceType; icon: React.ElementType; desc: string; urgent?: boolean }[] = [
  { type: 'Home Visit',           icon: Home,          desc: 'Doctor or nurse at your location' },
  { type: 'Lab Test',             icon: FlaskConical,  desc: 'Sample collection or lab referral' },
  { type: 'Medication Delivery',  icon: Pill,          desc: 'Prescription drugs delivered to you' },
  { type: 'Hospital Support',     icon: Hospital,      desc: 'Admission, billing, and liaison help' },
  { type: 'Emergency',            icon: Siren,         desc: 'Urgent care or ambulance coordination', urgent: true },
  { type: 'Others',               icon: MoreHorizontal,desc: 'Something not listed above' },
]

export default function RequestCarePage() {
  const [step, setStep] = useState<Step>('form')
  const [submitting, setSubmitting] = useState(false)
  const [form, setForm] = useState<FormData>({
    name: '', phone: '', email: '', location: '', services: [], notes: '',
  })
  const [errors, setErrors] = useState<Partial<Record<keyof FormData, string>>>({})

  const set = (field: keyof FormData, val: string) => {
    setForm(f => ({ ...f, [field]: val }))
    setErrors(e => ({ ...e, [field]: '' }))
  }

  const toggleService = (s: ServiceType) => {
    setForm(f => ({
      ...f,
      services: f.services.includes(s)
        ? f.services.filter(x => x !== s)
        : [...f.services, s],
    }))
    setErrors(e => ({ ...e, services: '' }))
  }

  const validate = () => {
    const e: typeof errors = {}
    if (!form.name.trim())  e.name  = 'Required'
    if (!form.phone.trim()) e.phone = 'Required'
    if (!form.email.trim() || !/\S+@\S+\.\S+/.test(form.email)) e.email = 'Valid email required'
    if (!form.location.trim()) e.location = 'Required'
    if (form.services.length === 0) e.services = 'Please select at least one service'
    setErrors(e)
    return Object.keys(e).length === 0
  }

  const [submitError, setSubmitError] = useState('')

  const handleSubmit = async () => {
    if (!validate()) return
    setSubmitting(true)
    setSubmitError('')
    try {
      await submitCareRequest({
        full_name: form.name,
        email: form.email,
        phone: form.phone,
        service_types: form.services,
        location: form.location || undefined,
        notes: form.notes || undefined,
      })
      setStep('submitted')
    } catch {
      setSubmitError('Something went wrong. Please try again or call us on 0700 700 1234.')
    } finally {
      setSubmitting(false)
    }
  }

  const isEmergency = form.services.includes('Emergency')

  return (
    <div className="min-h-screen bg-gray-50 pt-20">
      <div className="container-max max-w-xl py-12">

        <Link href="/" className="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-navy mb-8 transition-colors">
          <ArrowLeft size={16} /> Back
        </Link>

        <div className="bg-white rounded-3xl shadow-soft border border-gray-100 overflow-hidden">

          {step === 'form' && (
            <div className="p-8">
              <div className="mb-7">
                <div className="section-tag bg-teal/10 text-teal mb-3">Additional Care</div>
                <h1 className="text-2xl font-extrabold text-navy">Request a Service</h1>
                <p className="text-sm text-gray-500 mt-1">
                  We&apos;ll review your request and a member of our clinical team will contact you to arrange everything.
                </p>
              </div>

              {/* Emergency banner */}
              {isEmergency && (
                <div className="flex items-start gap-3 bg-orange/10 border border-orange/30 rounded-2xl p-4 mb-6">
                  <Siren size={18} className="text-orange flex-shrink-0 mt-0.5" />
                  <div>
                    <p className="text-sm font-bold text-orange">Emergency Request</p>
                    <p className="text-xs text-gray-600 mt-0.5">
                      For life-threatening emergencies call <span className="font-bold">112</span> immediately.
                      Our team will also contact you as quickly as possible after this submission.
                    </p>
                  </div>
                </div>
              )}

              <div className="space-y-5">
                {/* Name */}
                <div>
                  <label className="block text-sm font-semibold text-navy mb-2">Full Name</label>
                  <div className="relative">
                    <User size={15} className="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400" />
                    <input type="text" value={form.name} onChange={e => set('name', e.target.value)}
                      placeholder="e.g. Funmi Adeyemi" className={`form-input pl-10 ${errors.name ? 'border-red-400' : ''}`} />
                  </div>
                  {errors.name && <p className="text-xs text-red-500 mt-1">{errors.name}</p>}
                </div>

                {/* Phone & Email */}
                <div className="grid sm:grid-cols-2 gap-4">
                  <div>
                    <label className="block text-sm font-semibold text-navy mb-2">Phone Number</label>
                    <div className="relative">
                      <Phone size={15} className="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400" />
                      <input type="tel" value={form.phone} onChange={e => set('phone', e.target.value)}
                        placeholder="08012345678" className={`form-input pl-10 ${errors.phone ? 'border-red-400' : ''}`} />
                    </div>
                    {errors.phone && <p className="text-xs text-red-500 mt-1">{errors.phone}</p>}
                  </div>
                  <div>
                    <label className="block text-sm font-semibold text-navy mb-2">Email Address</label>
                    <div className="relative">
                      <Mail size={15} className="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400" />
                      <input type="email" value={form.email} onChange={e => set('email', e.target.value)}
                        placeholder="you@email.com" className={`form-input pl-10 ${errors.email ? 'border-red-400' : ''}`} />
                    </div>
                    {errors.email && <p className="text-xs text-red-500 mt-1">{errors.email}</p>}
                  </div>
                </div>

                {/* Location */}
                <div>
                  <label className="block text-sm font-semibold text-navy mb-2">Your Location / Address</label>
                  <div className="relative">
                    <MapPin size={15} className="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400" />
                    <input type="text" value={form.location} onChange={e => set('location', e.target.value)}
                      placeholder="e.g. 12 Allen Ave, Ikeja, Lagos" className={`form-input pl-10 ${errors.location ? 'border-red-400' : ''}`} />
                  </div>
                  {errors.location && <p className="text-xs text-red-500 mt-1">{errors.location}</p>}
                </div>

                {/* Service type */}
                <div>
                  <label className="block text-sm font-semibold text-navy mb-3">What do you need help with?</label>
                  <div className="grid grid-cols-2 gap-3">
                    {SERVICES.map(({ type, icon: Icon, desc, urgent }) => {
                      const selected = form.services.includes(type)
                      return (
                        <button key={type} onClick={() => toggleService(type)}
                          className={`text-left p-4 rounded-2xl border-2 transition-all duration-200 ${
                            selected
                              ? urgent ? 'border-orange bg-orange/5' : 'border-navy bg-navy/3'
                              : 'border-gray-200 hover:border-gray-300'
                          }`}>
                          <div className={`w-9 h-9 rounded-xl flex items-center justify-center mb-2 ${
                            selected
                              ? urgent ? 'bg-orange/10' : 'bg-navy/10'
                              : 'bg-gray-100'
                          }`}>
                            <Icon size={17} className={selected ? (urgent ? 'text-orange' : 'text-navy') : 'text-gray-500'} />
                          </div>
                          <p className={`text-xs font-bold mb-0.5 ${selected ? (urgent ? 'text-orange' : 'text-navy') : 'text-gray-700'}`}>{type}</p>
                          <p className="text-xs text-gray-400 leading-snug">{desc}</p>
                        </button>
                      )
                    })}
                  </div>
                  {errors.services && <p className="text-xs text-red-500 mt-2">{errors.services}</p>}
                </div>

                {/* Notes */}
                <div>
                  <label className="block text-sm font-semibold text-navy mb-2">
                    Tell us more <span className="text-gray-400 font-normal">(optional)</span>
                  </label>
                  <textarea value={form.notes} onChange={e => set('notes', e.target.value)}
                    rows={3} placeholder="Any extra details that will help our team prepare…"
                    className="form-input resize-none" />
                </div>
              </div>

              {submitError && (
                <div className="mt-6 p-4 bg-red-50 border border-red-100 rounded-xl text-sm text-red-600">
                  {submitError}
                </div>
              )}

              <button onClick={handleSubmit} disabled={submitting}
                className={`w-full flex items-center justify-center gap-2 py-4 text-white rounded-xl font-bold text-sm mt-8 transition-all duration-200 hover:-translate-y-0.5 disabled:opacity-70 ${
                  isEmergency ? 'bg-orange hover:bg-orange/90' : 'bg-navy hover:bg-navy-600'
                }`}>
                {submitting ? (
                  <><span className="w-4 h-4 border-2 border-white/40 border-t-white rounded-full animate-spin" /> Sending…</>
                ) : (
                  <>{isEmergency ? 'Submit Emergency Request' : 'Request a Call'} <ArrowRight size={16} /></>
                )}
              </button>
            </div>
          )}

          {/* Submitted */}
          {step === 'submitted' && (
            <div className="p-10 text-center">
              <div className="w-20 h-20 rounded-full bg-teal/10 flex items-center justify-center mx-auto mb-6">
                <CheckCircle2 size={40} className="text-teal" />
              </div>
              <h1 className="text-2xl font-extrabold text-navy mb-3">Request Received</h1>
              <p className="text-gray-500 text-sm leading-relaxed max-w-sm mx-auto mb-2">
                A member of our clinical team will contact <span className="font-semibold text-navy">{form.name}</span> shortly to arrange everything.
              </p>
              {form.services.includes('Emergency') && (
                <p className="text-xs text-orange font-semibold mt-2 mb-2">
                  Emergency flagged — our team will prioritise your request.
                </p>
              )}
              <p className="text-xs text-gray-400 mb-8">We'll reach you at {form.phone}</p>

              <div className="flex flex-col sm:flex-row gap-3 justify-center">
                <Link href="/" className="btn-secondary text-sm px-6 py-3">Back to Home</Link>
                <Link href="/dashboard" className="btn-primary text-sm px-6 py-3">Go to Dashboard</Link>
              </div>
            </div>
          )}
        </div>
      </div>
    </div>
  )
}
