'use client'

import { useState, useEffect, useCallback } from 'react'
import Link from 'next/link'
import { useRouter } from 'next/navigation'
import {
  User, Heart, Stethoscope, FileText, Clock, LogOut,
  ChevronRight, AlertCircle, CheckCircle2, Activity,
} from 'lucide-react'
import { getMe, type ProfileResponse } from '@/lib/auth'
import { getMyPatientProfile, listMyRequests, type PatientProfile, type ClinicalRequest } from '@/lib/patients'
import { getToken, getSessionUser, clearSession } from '@/lib/session'

// ── Helpers ───────────────────────────────────────────────────────────────────

function statusBadge(status: string) {
  const map: Record<string, string> = {
    open:           'bg-blue-50 text-blue-700 border-blue-200',
    triaged:        'bg-yellow-50 text-yellow-700 border-yellow-200',
    in_consultation:'bg-purple-50 text-purple-700 border-purple-200',
    completed:      'bg-green-50 text-green-700 border-green-200',
    cancelled:      'bg-gray-100 text-gray-500 border-gray-200',
  }
  return map[status] ?? 'bg-gray-100 text-gray-500 border-gray-200'
}

function membershipBadge(status: string) {
  if (status === 'active') return 'bg-teal/10 text-teal border-teal/20'
  if (status === 'pending') return 'bg-yellow-50 text-yellow-700 border-yellow-200'
  return 'bg-red-50 text-red-600 border-red-200'
}

function fmt(iso: string) {
  return new Date(iso).toLocaleDateString('en-NG', { day: 'numeric', month: 'short', year: 'numeric' })
}

// ── Page ──────────────────────────────────────────────────────────────────────

export default function DashboardPage() {
  const router  = useRouter()
  const token   = getToken()
  const user    = getSessionUser()

  const [profile,   setProfile]   = useState<ProfileResponse['profile'] | null>(null)
  const [patient,   setPatient]   = useState<PatientProfile | null>(null)
  const [requests,  setRequests]  = useState<ClinicalRequest[]>([])
  const [loading,   setLoading]   = useState(true)
  const [error,     setError]     = useState('')

  const loadData = useCallback(async () => {
    if (!token) { router.replace('/login'); return }

    try {
      const [meRes, patRes, reqRes] = await Promise.allSettled([
        getMe(token),
        getMyPatientProfile(token),
        listMyRequests(token),
      ])

      if (meRes.status === 'fulfilled')  setProfile(meRes.value.profile)
      if (patRes.status === 'fulfilled') setPatient(patRes.value.patient)
      if (reqRes.status === 'fulfilled') setRequests(reqRes.value.requests)

      // If getMe failed with 401, session is expired
      if (meRes.status === 'rejected') {
        clearSession()
        router.replace('/login')
      }
    } catch {
      setError('Failed to load dashboard data. Please refresh.')
    } finally {
      setLoading(false)
    }
  }, [token, router])

  useEffect(() => {
    loadData()
  }, [loadData])

  const handleLogout = () => {
    clearSession()
    router.push('/login')
  }

  // ── Loading ────────────────────────────────────────────────────────────────

  if (loading) {
    return (
      <div className="min-h-screen bg-gray-50 pt-20 flex items-center justify-center">
        <div className="text-center">
          <div className="w-10 h-10 border-4 border-navy/20 border-t-navy rounded-full animate-spin mx-auto mb-4" />
          <p className="text-sm text-gray-500">Loading your dashboard…</p>
        </div>
      </div>
    )
  }

  // ── Error ──────────────────────────────────────────────────────────────────

  if (error) {
    return (
      <div className="min-h-screen bg-gray-50 pt-20 flex items-center justify-center px-4">
        <div className="bg-white rounded-2xl shadow-soft border border-gray-100 p-8 text-center max-w-sm">
          <AlertCircle size={40} className="text-red-400 mx-auto mb-4" />
          <p className="text-sm text-gray-600 mb-4">{error}</p>
          <button onClick={loadData} className="btn-primary text-sm">Try Again</button>
        </div>
      </div>
    )
  }

  const membership = profile?.memberships?.[0]
  const recentRequests = requests.slice(0, 3)

  // ── Render ─────────────────────────────────────────────────────────────────

  return (
    <div className="min-h-screen bg-gray-50 pt-20">
      <div className="container-max max-w-4xl py-10">

        {/* ── Header ─────────────────────────────────────────────── */}
        <div className="flex items-start justify-between mb-8 gap-4 flex-wrap">
          <div>
            <h1 className="text-2xl font-extrabold text-navy">
              Hello, {profile?.full_name?.split(' ')[0] ?? user?.email ?? 'there'} 👋
            </h1>
            <p className="text-sm text-gray-500 mt-0.5">Welcome to your Care Access dashboard</p>
          </div>
          <button
            onClick={handleLogout}
            className="flex items-center gap-2 text-sm text-gray-500 hover:text-red-500 border border-gray-200 rounded-xl px-4 py-2 transition-colors"
          >
            <LogOut size={15} /> Sign out
          </button>
        </div>

        {/* ── Membership card ─────────────────────────────────────── */}
        <div className="bg-navy rounded-3xl p-6 mb-6 text-white relative overflow-hidden">
          <div className="absolute top-0 right-0 w-48 h-48 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/4 pointer-events-none" />
          <div className="absolute bottom-0 left-0 w-32 h-32 bg-white/5 rounded-full translate-y-1/2 -translate-x-1/4 pointer-events-none" />
          <div className="relative z-10">
            <div className="flex items-start justify-between gap-4 mb-4">
              <div>
                <p className="text-white/60 text-xs uppercase tracking-wider mb-1">Membership Plan</p>
                <p className="text-xl font-extrabold capitalize">
                  {membership?.plan ?? 'No plan'} Care
                </p>
                <p className="text-white/60 text-xs mt-0.5 capitalize">
                  {membership?.billing_cycle ?? ''} billing
                </p>
              </div>
              {membership && (
                <span className={`text-xs font-bold px-3 py-1.5 rounded-full border capitalize ${membershipBadge(membership.status)}`}>
                  {membership.status}
                </span>
              )}
            </div>
            {membership?.next_billing_date && (
              <p className="text-white/50 text-xs">
                Next billing: {fmt(membership.next_billing_date)}
              </p>
            )}
            {!membership && (
              <Link href="/become-a-member" className="inline-flex items-center gap-2 mt-2 text-teal text-sm font-semibold hover:underline">
                Activate a membership <ChevronRight size={14} />
              </Link>
            )}
          </div>
        </div>

        {/* ── Quick actions ───────────────────────────────────────── */}
        <div className="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-6">
          {[
            { label: 'My Profile',         href: '/profile',       icon: User,        color: 'bg-blue-50 text-blue-600' },
            { label: 'Request Care',        href: '/request-care',  icon: Heart,        color: 'bg-red-50 text-red-500' },
            { label: 'Book Consultation',   href: '/book',          icon: Stethoscope,  color: 'bg-teal/10 text-teal' },
            { label: 'My Requests',         href: '#requests',      icon: FileText,     color: 'bg-purple-50 text-purple-600' },
          ].map(({ label, href, icon: Icon, color }) => (
            <Link
              key={label}
              href={href}
              className="flex flex-col items-center gap-2 p-4 bg-white rounded-2xl border border-gray-100 shadow-soft hover:border-teal/30 hover:shadow-md transition-all duration-200 group"
            >
              <div className={`w-10 h-10 rounded-xl flex items-center justify-center ${color} group-hover:scale-110 transition-transform`}>
                <Icon size={18} />
              </div>
              <span className="text-xs font-semibold text-navy text-center leading-snug">{label}</span>
            </Link>
          ))}
        </div>

        <div className="grid grid-cols-1 lg:grid-cols-3 gap-6">

          {/* ── Health summary ──────────────────────────────────────── */}
          <div className="lg:col-span-1 bg-white rounded-2xl border border-gray-100 shadow-soft p-6">
            <div className="flex items-center justify-between mb-4">
              <h2 className="font-bold text-navy text-sm">Health Summary</h2>
              <Link href="/profile" className="text-xs text-teal hover:underline font-medium">Edit</Link>
            </div>

            {patient ? (
              <div className="space-y-3">
                {[
                  { label: 'Blood Type',   value: patient.blood_type },
                  { label: 'Allergies',    value: patient.allergies },
                  { label: 'Medications',  value: patient.current_medications },
                  { label: 'Conditions',   value: patient.chronic_conditions },
                ].map(({ label, value }) => (
                  <div key={label} className="flex flex-col gap-0.5">
                    <span className="text-xs text-gray-400 font-medium">{label}</span>
                    <span className="text-xs text-gray-700 font-semibold">
                      {value?.trim() || <span className="text-gray-300 font-normal">Not set</span>}
                    </span>
                  </div>
                ))}

                {patient.emergency_contact_name && (
                  <div className="mt-4 pt-4 border-t border-gray-100">
                    <p className="text-xs text-gray-400 font-medium mb-1">Emergency Contact</p>
                    <p className="text-xs font-semibold text-gray-700">{patient.emergency_contact_name}</p>
                    <p className="text-xs text-gray-500">{patient.emergency_contact_phone}</p>
                  </div>
                )}
              </div>
            ) : (
              <div className="text-center py-6">
                <Activity size={28} className="text-gray-300 mx-auto mb-3" />
                <p className="text-xs text-gray-400 mb-3 leading-relaxed">
                  Complete your health profile so your doctor knows your medical history.
                </p>
                <Link href="/profile" className="text-xs font-bold text-teal hover:underline">
                  Complete profile →
                </Link>
              </div>
            )}
          </div>

          {/* ── Recent requests ─────────────────────────────────────── */}
          <div id="requests" className="lg:col-span-2 bg-white rounded-2xl border border-gray-100 shadow-soft p-6">
            <div className="flex items-center justify-between mb-4">
              <h2 className="font-bold text-navy text-sm">My Clinical Requests</h2>
              <Link href="/request-care" className="text-xs text-teal hover:underline font-medium">
                + New Request
              </Link>
            </div>

            {recentRequests.length === 0 ? (
              <div className="text-center py-10">
                <FileText size={28} className="text-gray-300 mx-auto mb-3" />
                <p className="text-sm text-gray-400 mb-4">No requests yet.</p>
                <Link href="/request-care" className="btn-primary text-xs px-5 py-2.5">
                  Request a service
                </Link>
              </div>
            ) : (
              <div className="space-y-3">
                {recentRequests.map(req => (
                  <div key={req.id} className="flex items-start gap-4 p-4 rounded-xl border border-gray-100 hover:border-gray-200 transition-colors">
                    <div className="w-8 h-8 rounded-lg bg-navy/5 flex items-center justify-center flex-shrink-0">
                      <FileText size={14} className="text-navy/60" />
                    </div>
                    <div className="flex-1 min-w-0">
                      <div className="flex items-center gap-2 flex-wrap mb-1">
                        <span className="text-xs font-bold text-navy capitalize">
                          {req.type?.replace(/_/g, ' ')}
                        </span>
                        <span className={`text-xs font-semibold px-2 py-0.5 rounded-full border capitalize ${statusBadge(req.status)}`}>
                          {req.status?.replace(/_/g, ' ')}
                        </span>
                      </div>
                      <p className="text-xs text-gray-500 truncate">{req.description}</p>
                      <p className="text-xs text-gray-300 mt-1">{fmt(req.created_at)}</p>
                    </div>
                    {req.status === 'completed' && (
                      <CheckCircle2 size={16} className="text-teal flex-shrink-0 mt-0.5" />
                    )}
                  </div>
                ))}

                {requests.length > 3 && (
                  <p className="text-xs text-center text-gray-400 pt-1">
                    +{requests.length - 3} more requests
                  </p>
                )}
              </div>
            )}
          </div>

        </div>

        {/* ── Footer links ────────────────────────────────────────── */}
        <div className="flex flex-wrap items-center justify-center gap-4 mt-10">
          {[
            { label: 'Contact Support', href: '/contact' },
            { label: 'Book Consultation', href: '/book' },
            { label: 'Request Care', href: '/request-care' },
          ].map(({ label, href }) => (
            <Link key={label} href={href} className="flex items-center gap-1.5 text-xs text-gray-400 hover:text-navy transition-colors">
              <Clock size={12} /> {label}
            </Link>
          ))}
        </div>

      </div>
    </div>
  )
}
