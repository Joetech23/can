'use client'

import { useState } from 'react'
import AnimatedSection from '@/components/ui/AnimatedSection'
import {
  ArrowRight,
  X,
  CheckCircle2,
  HeartPulse,
  BedDouble,
  UserRound,
  Stethoscope,
  ActivitySquare,
  HandHeart,
} from 'lucide-react'
import { submitHomeCareRequest, type HomeCareRequest } from '@/lib/homeCare'

const careTypes = [
  { icon: HeartPulse,      label: 'In-home nursing care' },
  { icon: BedDouble,       label: 'Hospital bedside support' },
  { icon: UserRound,       label: 'Elderly care assistance' },
  { icon: Stethoscope,     label: 'Post-surgical support' },
  { icon: ActivitySquare,  label: 'Recovery support' },
  { icon: HandHeart,       label: 'Ongoing healthcare assistance' },
]

const supportOptions = [
  'In-home nursing care',
  'Hospital bedside support',
  'Elderly care assistance',
  'Post-surgical support',
  'Recovery support',
  'Ongoing healthcare assistance',
  'Other',
]

const durationOptions = [
  'Less than 1 week',
  '1–2 weeks',
  '1 month',
  '2–3 months',
  '3–6 months',
  '6 months or more',
  'Ongoing / undetermined',
]

const EMPTY: HomeCareRequest = {
  full_name: '',
  phone: '',
  email: '',
  patient_location: '',
  support_type: '',
  preferred_start_date: '',
  duration: '',
  setting: '',
  description: '',
}

export default function HomeCareSection() {
  const [open, setOpen]       = useState(false)
  const [form, setForm]       = useState<HomeCareRequest>(EMPTY)
  const [loading, setLoading] = useState(false)
  const [done, setDone]       = useState(false)
  const [error, setError]     = useState<string | null>(null)

  function change(e: React.ChangeEvent<HTMLInputElement | HTMLSelectElement | HTMLTextAreaElement>) {
    setForm(f => ({ ...f, [e.target.name]: e.target.value }))
  }

  function openModal() {
    setForm(EMPTY)
    setDone(false)
    setError(null)
    setOpen(true)
  }

  function closeModal() {
    if (loading) return
    setOpen(false)
  }

  async function handleSubmit(e: React.FormEvent) {
    e.preventDefault()
    setLoading(true)
    setError(null)
    try {
      await submitHomeCareRequest(form)
      setDone(true)
    } catch (err: unknown) {
      setError(err instanceof Error ? err.message : 'Something went wrong. Please try again.')
    } finally {
      setLoading(false)
    }
  }

  return (
    <>
      {/* ── Section ─────────────────────────────────────────────────────────── */}
      <section className="section-padding bg-white" aria-labelledby="home-care-heading">
        <div className="container-max">
          <AnimatedSection className="text-center mb-12">
            <div className="section-tag bg-teal/10 text-teal mx-auto mb-5 uppercase tracking-widest text-xs font-bold">
              Home Care Support
            </div>
            <h2
              id="home-care-heading"
              className="text-3xl md:text-4xl font-extrabold text-navy leading-tight mb-5 max-w-2xl mx-auto"
            >
              Professional healthcare{' '}
              <span className="text-teal">in your home or hospital room</span>
            </h2>
            <p className="text-base md:text-lg text-gray-500 max-w-2xl mx-auto leading-relaxed">
              Professional healthcare support tailored to individuals who may require hands-on,
              in-person assistance — at home or at the bedside.
            </p>
          </AnimatedSection>

          {/* Care types grid */}
          <AnimatedSection>
            <div className="grid grid-cols-2 md:grid-cols-3 gap-4 mb-10 max-w-3xl mx-auto">
              {careTypes.map(({ icon: Icon, label }) => (
                <div
                  key={label}
                  className="flex items-center gap-3 p-4 rounded-xl border border-gray-100 bg-[#F5F8FC]"
                >
                  <div className="w-9 h-9 rounded-lg bg-teal/10 flex items-center justify-center flex-shrink-0">
                    <Icon size={18} className="text-teal" />
                  </div>
                  <span className="text-sm font-medium text-navy leading-snug">{label}</span>
                </div>
              ))}
            </div>
          </AnimatedSection>

          {/* Info strip */}
          <AnimatedSection>
            <div className="max-w-3xl mx-auto rounded-2xl border border-teal/20 bg-teal/5 px-8 py-6 flex flex-col md:flex-row items-center justify-between gap-6 mb-10">
              <div>
                <p className="font-semibold text-navy mb-1">
                  Our team will assess your care needs and assign a suitable clinician.
                </p>
                <p className="text-sm text-gray-500 leading-relaxed">
                  Pricing is tailored based on individual care requirements, location, and duration.
                  We will contact you with a personalised care plan and quote.
                </p>
              </div>
              <button
                onClick={openModal}
                className="btn-primary whitespace-nowrap flex-shrink-0"
              >
                Request Assessment <ArrowRight size={16} />
              </button>
            </div>
          </AnimatedSection>

          {/* Reassurance bullets */}
          <AnimatedSection>
            <div className="max-w-2xl mx-auto grid sm:grid-cols-3 gap-4 text-center">
              {[
                'Qualified nurses and care assistants',
                'Flexible home or hospital support',
                'Care coordinated with your clinical team',
              ].map((item) => (
                <div key={item} className="flex flex-col items-center gap-2">
                  <CheckCircle2 size={20} className="text-teal" />
                  <span className="text-sm text-gray-600 leading-snug">{item}</span>
                </div>
              ))}
            </div>
          </AnimatedSection>
        </div>
      </section>

      {/* ── Modal ───────────────────────────────────────────────────────────── */}
      {open && (
        <div
          className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm"
          role="dialog"
          aria-modal="true"
          aria-labelledby="hc-modal-title"
          onClick={(e) => { if (e.target === e.currentTarget) closeModal() }}
        >
          <div className="relative w-full max-w-xl max-h-[90vh] overflow-y-auto bg-white rounded-2xl shadow-2xl">
            {/* Modal header */}
            <div className="sticky top-0 z-10 bg-navy px-6 py-5 rounded-t-2xl flex items-start justify-between gap-4">
              <div>
                <p className="text-xs font-bold uppercase tracking-widest text-teal-300 mb-1">
                  Home Care Support
                </p>
                <h3 id="hc-modal-title" className="text-xl font-extrabold text-white">
                  Home Care Support Request Form
                </h3>
              </div>
              <button
                onClick={closeModal}
                className="text-white/60 hover:text-white transition-colors mt-0.5"
                aria-label="Close form"
              >
                <X size={20} />
              </button>
            </div>

            <div className="px-6 py-6">
              {done ? (
                /* ── Success state ── */
                <div className="text-center py-8">
                  <div className="w-16 h-16 rounded-full bg-teal/10 flex items-center justify-center mx-auto mb-5">
                    <CheckCircle2 size={32} className="text-teal" />
                  </div>
                  <h4 className="text-xl font-bold text-navy mb-3">Request Received</h4>
                  <p className="text-gray-500 leading-relaxed max-w-sm mx-auto">
                    Thank you for contacting Care Access Nigeria. A member of our clinical team will
                    review your request and contact you shortly.
                  </p>
                  <button
                    onClick={closeModal}
                    className="mt-8 btn-primary"
                  >
                    Close
                  </button>
                </div>
              ) : (
                /* ── Form ── */
                <form onSubmit={handleSubmit} className="space-y-4">
                  {/* Full Name */}
                  <div>
                    <label className="block text-xs font-semibold text-gray-600 uppercase tracking-wide mb-1.5" htmlFor="hc-full_name">Full Name *</label>
                    <input
                      id="hc-full_name"
                      name="full_name"
                      type="text"
                      required
                      value={form.full_name}
                      onChange={change}
                      className="form-input"
                      placeholder="Enter your full name"
                    />
                  </div>

                  {/* Phone + Email */}
                  <div className="grid sm:grid-cols-2 gap-4">
                    <div>
                      <label className="block text-xs font-semibold text-gray-600 uppercase tracking-wide mb-1.5" htmlFor="hc-phone">Phone Number *</label>
                      <input
                        id="hc-phone"
                        name="phone"
                        type="tel"
                        required
                        value={form.phone}
                        onChange={change}
                        className="form-input"
                        placeholder="+234 800 000 0000"
                      />
                    </div>
                    <div>
                      <label className="block text-xs font-semibold text-gray-600 uppercase tracking-wide mb-1.5" htmlFor="hc-email">Email Address *</label>
                      <input
                        id="hc-email"
                        name="email"
                        type="email"
                        required
                        value={form.email}
                        onChange={change}
                        className="form-input"
                        placeholder="you@example.com"
                      />
                    </div>
                  </div>

                  {/* Patient Location */}
                  <div>
                    <label className="block text-xs font-semibold text-gray-600 uppercase tracking-wide mb-1.5" htmlFor="hc-patient_location">Patient Location *</label>
                    <input
                      id="hc-patient_location"
                      name="patient_location"
                      type="text"
                      required
                      value={form.patient_location}
                      onChange={change}
                      className="form-input"
                      placeholder="City, state (e.g. Lagos, Lagos State)"
                    />
                  </div>

                  {/* Type of Support */}
                  <div>
                    <label className="block text-xs font-semibold text-gray-600 uppercase tracking-wide mb-1.5" htmlFor="hc-support_type">Type of Support Needed *</label>
                    <select
                      id="hc-support_type"
                      name="support_type"
                      required
                      value={form.support_type}
                      onChange={change}
                      className="form-input"
                    >
                      <option value="">Select support type</option>
                      {supportOptions.map((o) => (
                        <option key={o} value={o}>{o}</option>
                      ))}
                    </select>
                  </div>

                  {/* Start Date + Duration */}
                  <div className="grid sm:grid-cols-2 gap-4">
                    <div>
                      <label className="block text-xs font-semibold text-gray-600 uppercase tracking-wide mb-1.5" htmlFor="hc-preferred_start_date">Preferred Start Date *</label>
                      <input
                        id="hc-preferred_start_date"
                        name="preferred_start_date"
                        type="date"
                        required
                        value={form.preferred_start_date}
                        onChange={change}
                        className="form-input"
                      />
                    </div>
                    <div>
                      <label className="block text-xs font-semibold text-gray-600 uppercase tracking-wide mb-1.5" htmlFor="hc-duration">Duration of Support *</label>
                      <select
                        id="hc-duration"
                        name="duration"
                        required
                        value={form.duration}
                        onChange={change}
                        className="form-input"
                      >
                        <option value="">Select duration</option>
                        {durationOptions.map((d) => (
                          <option key={d} value={d}>{d}</option>
                        ))}
                      </select>
                    </div>
                  </div>

                  {/* Setting */}
                  <div>
                    <p className="block text-xs font-semibold text-gray-600 uppercase tracking-wide mb-2">Care Setting *</p>
                    <div className="grid grid-cols-2 gap-3">
                      {(['home', 'hospital'] as const).map((val) => (
                        <label
                          key={val}
                          className={`flex items-center gap-3 p-3.5 rounded-xl border cursor-pointer transition-all duration-150 ${
                            form.setting === val
                              ? 'border-teal bg-teal/5 text-navy font-semibold'
                              : 'border-gray-200 text-gray-600 hover:border-gray-300'
                          }`}
                        >
                          <input
                            type="radio"
                            name="setting"
                            value={val}
                            checked={form.setting === val}
                            onChange={change}
                            className="sr-only"
                            required
                          />
                          <span className={`w-4 h-4 rounded-full border-2 flex-shrink-0 ${
                            form.setting === val ? 'border-teal bg-teal' : 'border-gray-300'
                          }`} />
                          <span className="text-sm capitalize">{val} support</span>
                        </label>
                      ))}
                    </div>
                  </div>

                  {/* Description */}
                  <div>
                    <label className="block text-xs font-semibold text-gray-600 uppercase tracking-wide mb-1.5" htmlFor="hc-description">Brief Description of Care Needs *</label>
                    <textarea
                      id="hc-description"
                      name="description"
                      required
                      rows={4}
                      value={form.description}
                      onChange={change}
                      className="form-input resize-none"
                      placeholder="Please briefly describe the patient's condition and what care is needed..."
                    />
                  </div>

                  {/* Error */}
                  {error && (
                    <p className="text-sm text-red-600 bg-red-50 border border-red-200 rounded-xl px-4 py-3">
                      {error}
                    </p>
                  )}

                  {/* Submit */}
                  <button
                    type="submit"
                    disabled={loading}
                    className="btn-primary w-full justify-center disabled:opacity-60 disabled:cursor-not-allowed"
                  >
                    {loading ? 'Sending request…' : <>Request Assessment <ArrowRight size={16} /></>}
                  </button>

                  <p className="text-xs text-gray-400 text-center leading-relaxed">
                    Our clinical team will review your request and contact you to discuss your care
                    needs and provide a personalised quote.
                  </p>
                </form>
              )}
            </div>
          </div>
        </div>
      )}
    </>
  )
}
