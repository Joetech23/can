'use client'

import { useState } from 'react'
import { ArrowRight, CheckCircle2 } from 'lucide-react'
import { submitHomeCareRequest, type HomeCareRequest } from '@/lib/homeCare'
import { homeCareSupportOptions } from '@/lib/content'

const durationOptions = [
  'Less than 1 week',
  '1 to 2 weeks',
  '1 month',
  '2 to 3 months',
  '3 to 6 months',
  '6 months or more',
  'Ongoing or not yet known',
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

interface HomeCareRequestFormProps {
  onClose?: () => void
}

export default function HomeCareRequestForm({ onClose }: HomeCareRequestFormProps) {
  const [form, setForm]       = useState<HomeCareRequest>(EMPTY)
  const [loading, setLoading] = useState(false)
  const [done, setDone]       = useState(false)
  const [error, setError]     = useState<string | null>(null)

  function change(e: React.ChangeEvent<HTMLInputElement | HTMLSelectElement | HTMLTextAreaElement>) {
    setForm(f => ({ ...f, [e.target.name]: e.target.value }))
  }

  function reset() {
    setForm(EMPTY)
    setDone(false)
    setError(null)
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
          type="button"
          onClick={onClose ?? reset}
          className="mt-8 btn-primary"
        >
          {onClose ? 'Close' : 'Send another request'}
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
            {homeCareSupportOptions.map((o) => (
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
            placeholder="Briefly describe the person's condition and the care they need"
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
          {loading ? 'Sending request…' : <>Request Home Care <ArrowRight size={16} /></>}
        </button>

        <p className="text-xs text-gray-400 text-center leading-relaxed">
          Our clinical team will review your request and contact you to discuss your care
          needs and provide a personalised quote.
        </p>
      </form>
    )}
    </>
  )
}
