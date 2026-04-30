'use client'

import { useState } from 'react'
import Link from 'next/link'
import { ArrowLeft, ArrowRight, CheckCircle2, Building2, User, Phone, Mail, Users } from 'lucide-react'
import { submitOrgEnquiry } from '@/lib/orgEnquiry'

type Size = '1–10' | '10–50' | '50–200' | '200+'
type Step = 'form' | 'submitted'

interface FormData {
  company: string
  contact: string
  phone: string
  email: string
  size: Size | ''
  message: string
}

const SIZES: Size[] = ['1–10', '10–50', '50–200', '200+']

export default function OrgEnquiryPage() {
  const [step, setStep] = useState<Step>('form')
  const [submitting, setSubmitting] = useState(false)
  const [form, setForm] = useState<FormData>({
    company: '', contact: '', phone: '', email: '', size: '', message: '',
  })
  const [errors, setErrors] = useState<Partial<Record<keyof FormData, string>>>({})

  const set = (field: keyof FormData, val: string) => {
    setForm(f => ({ ...f, [field]: val }))
    setErrors(e => ({ ...e, [field]: '' }))
  }

  const validate = () => {
    const e: typeof errors = {}
    if (!form.company.trim()) e.company = 'Required'
    if (!form.contact.trim()) e.contact = 'Required'
    if (!form.phone.trim())   e.phone   = 'Required'
    if (!form.email.trim() || !/\S+@\S+\.\S+/.test(form.email)) e.email = 'Valid email required'
    if (!form.size)           e.size    = 'Please select your team size'
    setErrors(e)
    return Object.keys(e).length === 0
  }

  const [submitError, setSubmitError] = useState('')

  const handleSubmit = async () => {
    if (!validate()) return
    setSubmitting(true)
    setSubmitError('')
    try {
      await submitOrgEnquiry({
        org_name: form.company,
        contact_name: form.contact,
        email: form.email,
        phone: form.phone,
        team_size: form.size,
        message: form.message || undefined,
      })
      setStep('submitted')
    } catch {
      setSubmitError('Something went wrong. Please try again or email us at info@careaccess.ng')
    } finally {
      setSubmitting(false)
    }
  }

  return (
    <div className="min-h-screen bg-gray-50 pt-20">
      <div className="container-max max-w-xl py-12">

        <Link href="/become-a-member" className="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-navy mb-8 transition-colors">
          <ArrowLeft size={16} /> Back
        </Link>

        <div className="bg-white rounded-3xl shadow-soft border border-gray-100 overflow-hidden">

          {step === 'form' && (
            <div className="p-8">
              {/* Header */}
              <div className="flex items-center gap-4 mb-7">
                <div className="w-12 h-12 rounded-2xl bg-navy/10 flex items-center justify-center flex-shrink-0">
                  <Building2 size={22} className="text-navy" />
                </div>
                <div>
                  <div className="section-tag bg-teal/10 text-teal mb-1">For Organisations</div>
                  <h1 className="text-2xl font-extrabold text-navy">Organisation Enquiry</h1>
                </div>
              </div>
              <p className="text-sm text-gray-500 leading-relaxed mb-8">
                Let's design a healthcare solution for your team. Tell us about your organisation and we'll get back to you within one business day.
              </p>

              <div className="space-y-5">
                {/* Company Name */}
                <div>
                  <label className="block text-sm font-semibold text-navy mb-2">Company / Organisation Name</label>
                  <div className="relative">
                    <Building2 size={15} className="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400" />
                    <input type="text" value={form.company} onChange={e => set('company', e.target.value)}
                      placeholder="e.g. Acme Solutions Ltd" className={`form-input pl-10 ${errors.company ? 'border-red-400' : ''}`} />
                  </div>
                  {errors.company && <p className="text-xs text-red-500 mt-1">{errors.company}</p>}
                </div>

                {/* Contact Person */}
                <div>
                  <label className="block text-sm font-semibold text-navy mb-2">Contact Person</label>
                  <div className="relative">
                    <User size={15} className="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400" />
                    <input type="text" value={form.contact} onChange={e => set('contact', e.target.value)}
                      placeholder="e.g. Chidi Mensah (HR Manager)" className={`form-input pl-10 ${errors.contact ? 'border-red-400' : ''}`} />
                  </div>
                  {errors.contact && <p className="text-xs text-red-500 mt-1">{errors.contact}</p>}
                </div>

                {/* Phone & Email row */}
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
                        placeholder="hr@company.com" className={`form-input pl-10 ${errors.email ? 'border-red-400' : ''}`} />
                    </div>
                    {errors.email && <p className="text-xs text-red-500 mt-1">{errors.email}</p>}
                  </div>
                </div>

                {/* Team size */}
                <div>
                  <label className="block text-sm font-semibold text-navy mb-2">
                    <span className="flex items-center gap-2"><Users size={14} className="text-teal" /> Number of Employees</span>
                  </label>
                  <div className="flex flex-wrap gap-2">
                    {SIZES.map(s => (
                      <button key={s} onClick={() => set('size', s)}
                        className={`px-4 py-2.5 rounded-xl text-sm font-semibold border-2 transition-all duration-200 ${
                          form.size === s ? 'border-navy bg-navy text-white' : 'border-gray-200 text-gray-600 hover:border-navy/40 hover:text-navy'
                        }`}>
                        {s}
                      </button>
                    ))}
                  </div>
                  {errors.size && <p className="text-xs text-red-500 mt-1">{errors.size}</p>}
                </div>

                {/* What are you looking for */}
                <div>
                  <label className="block text-sm font-semibold text-navy mb-2">What are you looking for?</label>
                  <textarea value={form.message} onChange={e => set('message', e.target.value)}
                    rows={4} placeholder="Tell us about your needs, any specific requirements, or what your team currently lacks in healthcare support…"
                    className="form-input resize-none" />
                </div>
              </div>

              {submitError && (
                <div className="mt-4 p-4 bg-red-50 border border-red-100 rounded-xl text-sm text-red-600">
                  {submitError}
                </div>
              )}

              <button onClick={handleSubmit} disabled={submitting}
                className="w-full flex items-center justify-center gap-2 py-4 bg-navy text-white rounded-xl font-bold text-sm mt-8 hover:bg-navy-600 transition-all duration-200 hover:-translate-y-0.5 disabled:opacity-70">
                {submitting ? (
                  <><span className="w-4 h-4 border-2 border-white/40 border-t-white rounded-full animate-spin" /> Sending…</>
                ) : (
                  <>Request a Call <ArrowRight size={16} /></>
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
              <h1 className="text-2xl font-extrabold text-navy mb-3">Thank You!</h1>
              <p className="text-gray-500 text-sm leading-relaxed max-w-sm mx-auto mb-2">
                Our team will contact <span className="font-semibold text-navy">{form.contact}</span> at <span className="font-semibold text-navy">{form.company}</span> shortly to discuss your organisation&apos;s healthcare needs.
              </p>
              <p className="text-xs text-gray-400 mb-8">We typically respond within one business day.</p>

              <div className="flex flex-col sm:flex-row gap-3 justify-center">
                <Link href="/" className="btn-secondary text-sm px-6 py-3">Back to Home</Link>
                <Link href="/become-a-member" className="btn-primary text-sm px-6 py-3">View Plans</Link>
              </div>
            </div>
          )}
        </div>
      </div>
    </div>
  )
}
