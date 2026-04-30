'use client'

import { useState, useEffect, useCallback } from 'react'
import Link from 'next/link'
import { useRouter } from 'next/navigation'
import {
  User, Heart, Pill, AlertTriangle, Phone, ArrowLeft,
  CheckCircle2, Loader2, Save,
} from 'lucide-react'
import { submitOnboarding, getMyPatientProfile, type OnboardingPayload } from '@/lib/patients'
import { getToken, clearSession } from '@/lib/session'

// ── Blood type options ─────────────────────────────────────────────────────────

const BLOOD_TYPES = ['A+', 'A−', 'B+', 'B−', 'AB+', 'AB−', 'O+', 'O−', "Don't know"]

// ── Page ──────────────────────────────────────────────────────────────────────

export default function ProfilePage() {
  const router = useRouter()
  const token  = getToken()

  const [loading,  setLoading]  = useState(true)
  const [saving,   setSaving]   = useState(false)
  const [saved,    setSaved]    = useState(false)
  const [error,    setError]    = useState('')

  const [form, setForm] = useState<OnboardingPayload>({
    allergies:               '',
    current_medications:     '',
    chronic_conditions:      '',
    blood_type:              '',
    emergency_contact_name:  '',
    emergency_contact_phone: '',
  })

  // ── Load existing profile ──────────────────────────────────────────────────

  const loadProfile = useCallback(async () => {
    if (!token) { router.replace('/login'); return }
    try {
      const res = await getMyPatientProfile(token)
      const p   = res.patient
      setForm({
        allergies:               p.allergies               ?? '',
        current_medications:     p.current_medications     ?? '',
        chronic_conditions:      p.chronic_conditions      ?? '',
        blood_type:              p.blood_type              ?? '',
        emergency_contact_name:  p.emergency_contact_name  ?? '',
        emergency_contact_phone: p.emergency_contact_phone ?? '',
      })
    } catch (err: unknown) {
      // 404 with ONBOARDING_REQUIRED means no profile yet — that's fine, form stays empty
      const message = err instanceof Error ? err.message : ''
      if (!message.includes('ONBOARDING_REQUIRED') && !message.includes('404')) {
        setError('Could not load your profile. Please try again.')
      }
    } finally {
      setLoading(false)
    }
  }, [token, router])

  useEffect(() => { loadProfile() }, [loadProfile])

  // ── Save ──────────────────────────────────────────────────────────────────

  const handleSave = async (e: React.FormEvent) => {
    e.preventDefault()
    if (!token) { clearSession(); router.replace('/login'); return }

    setSaving(true)
    setError('')
    setSaved(false)

    try {
      // Strip empty strings so backend doesn't overwrite with blanks
      const payload: OnboardingPayload = {}
      if (form.allergies?.trim())               payload.allergies               = form.allergies.trim()
      if (form.current_medications?.trim())      payload.current_medications     = form.current_medications.trim()
      if (form.chronic_conditions?.trim())       payload.chronic_conditions      = form.chronic_conditions.trim()
      if (form.blood_type?.trim())               payload.blood_type              = form.blood_type.trim()
      if (form.emergency_contact_name?.trim())   payload.emergency_contact_name  = form.emergency_contact_name.trim()
      if (form.emergency_contact_phone?.trim())  payload.emergency_contact_phone = form.emergency_contact_phone.trim()

      await submitOnboarding(payload, token)
      setSaved(true)
      setTimeout(() => setSaved(false), 3000)
    } catch (err: unknown) {
      setError(err instanceof Error ? err.message : 'Save failed. Please try again.')
    } finally {
      setSaving(false)
    }
  }

  const set = (field: keyof OnboardingPayload, val: string) =>
    setForm(f => ({ ...f, [field]: val }))

  // ── Loading ────────────────────────────────────────────────────────────────

  if (loading) {
    return (
      <div className="min-h-screen bg-gray-50 pt-20 flex items-center justify-center">
        <div className="text-center">
          <div className="w-10 h-10 border-4 border-navy/20 border-t-navy rounded-full animate-spin mx-auto mb-4" />
          <p className="text-sm text-gray-500">Loading your profile…</p>
        </div>
      </div>
    )
  }

  // ── Render ─────────────────────────────────────────────────────────────────

  return (
    <div className="min-h-screen bg-gray-50 pt-20">
      <div className="container-max max-w-2xl py-10">

        {/* Back */}
        <Link
          href="/dashboard"
          className="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-navy mb-8 transition-colors"
        >
          <ArrowLeft size={16} /> Back to Dashboard
        </Link>

        {/* Page header */}
        <div className="mb-8">
          <h1 className="text-2xl font-extrabold text-navy">My Health Profile</h1>
          <p className="text-sm text-gray-500 mt-1">
            This information helps your doctor provide better care. All fields are optional.
          </p>
        </div>

        <form onSubmit={handleSave} className="space-y-6">

          {/* ── Medical info ─────────────────────────────────────── */}
          <div className="bg-white rounded-3xl border border-gray-100 shadow-soft p-6">
            <h2 className="font-bold text-navy mb-5 flex items-center gap-2">
              <Heart size={16} className="text-red-400" /> Medical Information
            </h2>

            <div className="space-y-5">
              {/* Blood type */}
              <div>
                <label className="block text-sm font-semibold text-navy mb-2">Blood Type</label>
                <div className="flex flex-wrap gap-2">
                  {BLOOD_TYPES.map(bt => (
                    <button
                      key={bt}
                      type="button"
                      onClick={() => set('blood_type', form.blood_type === bt ? '' : bt)}
                      className={`px-3 py-1.5 rounded-lg border text-xs font-semibold transition-all duration-150 ${
                        form.blood_type === bt
                          ? 'bg-navy text-white border-navy'
                          : 'border-gray-200 text-gray-600 hover:border-navy hover:text-navy'
                      }`}
                    >
                      {bt}
                    </button>
                  ))}
                </div>
              </div>

              {/* Allergies */}
              <div>
                <label className="block text-sm font-semibold text-navy mb-2 flex items-center gap-1.5">
                  <AlertTriangle size={13} className="text-orange" /> Allergies
                </label>
                <textarea
                  value={form.allergies}
                  onChange={e => set('allergies', e.target.value)}
                  rows={2}
                  placeholder="e.g. Penicillin, peanuts, latex — or 'None known'"
                  className="form-input resize-none"
                />
              </div>

              {/* Medications */}
              <div>
                <label className="block text-sm font-semibold text-navy mb-2 flex items-center gap-1.5">
                  <Pill size={13} className="text-teal" /> Current Medications
                </label>
                <textarea
                  value={form.current_medications}
                  onChange={e => set('current_medications', e.target.value)}
                  rows={2}
                  placeholder="e.g. Amlodipine 5mg daily — or 'None'"
                  className="form-input resize-none"
                />
              </div>

              {/* Conditions */}
              <div>
                <label className="block text-sm font-semibold text-navy mb-2 flex items-center gap-1.5">
                  <Heart size={13} className="text-red-400" /> Chronic Conditions
                </label>
                <textarea
                  value={form.chronic_conditions}
                  onChange={e => set('chronic_conditions', e.target.value)}
                  rows={2}
                  placeholder="e.g. Hypertension, Type 2 Diabetes — or 'None'"
                  className="form-input resize-none"
                />
              </div>
            </div>
          </div>

          {/* ── Emergency contact ────────────────────────────────── */}
          <div className="bg-white rounded-3xl border border-gray-100 shadow-soft p-6">
            <h2 className="font-bold text-navy mb-5 flex items-center gap-2">
              <Phone size={16} className="text-teal" /> Emergency Contact
            </h2>

            <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div>
                <label className="block text-sm font-semibold text-navy mb-2">Full Name</label>
                <div className="relative">
                  <User size={14} className="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400" />
                  <input
                    type="text"
                    value={form.emergency_contact_name}
                    onChange={e => set('emergency_contact_name', e.target.value)}
                    placeholder="e.g. Emeka Okafor"
                    className="form-input pl-9"
                  />
                </div>
              </div>
              <div>
                <label className="block text-sm font-semibold text-navy mb-2">Phone Number</label>
                <div className="relative">
                  <Phone size={14} className="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400" />
                  <input
                    type="tel"
                    value={form.emergency_contact_phone}
                    onChange={e => set('emergency_contact_phone', e.target.value)}
                    placeholder="e.g. 08087654321"
                    className="form-input pl-9"
                  />
                </div>
              </div>
            </div>
          </div>

          {/* ── Error ──────────────────────────────────────────────── */}
          {error && (
            <div className="p-4 bg-red-50 border border-red-100 rounded-2xl text-sm text-red-600">
              {error}
            </div>
          )}

          {/* ── Actions ────────────────────────────────────────────── */}
          <div className="flex items-center justify-between gap-4">
            <Link
              href="/dashboard"
              className="flex items-center gap-2 px-5 py-3 rounded-xl border-2 border-gray-200 text-gray-600 font-semibold text-sm hover:border-navy hover:text-navy transition-all duration-200"
            >
              <ArrowLeft size={15} /> Dashboard
            </Link>

            <button
              type="submit"
              disabled={saving}
              className="flex items-center gap-2 px-8 py-3 bg-navy text-white rounded-xl font-bold text-sm hover:bg-navy-600 transition-all duration-200 hover:-translate-y-0.5 disabled:opacity-70 disabled:translate-y-0"
            >
              {saving ? (
                <><Loader2 size={15} className="animate-spin" /> Saving…</>
              ) : saved ? (
                <><CheckCircle2 size={15} className="text-teal-300" /> Saved!</>
              ) : (
                <><Save size={15} /> Save Profile</>
              )}
            </button>
          </div>

        </form>
      </div>
    </div>
  )
}
