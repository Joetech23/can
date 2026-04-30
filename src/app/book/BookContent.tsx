'use client'

import { useState, useRef } from 'react'
import Link from 'next/link'
import { ArrowLeft, ArrowRight, CheckCircle2, Calendar, Clock, User, Phone, Mail, ChevronLeft, ChevronRight } from 'lucide-react'
import { usePaystackPayment } from 'react-paystack'
import { createBooking, verifyBookingPayment } from '@/lib/bookings'

// ── Helpers ──────────────────────────────────────────────────────────────────

const DAYS = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']
const MONTHS = ['January','February','March','April','May','June','July','August','September','October','November','December']

const TIME_SLOTS = [
  '9:00 AM','9:30 AM','10:00 AM','10:30 AM','11:00 AM','11:30 AM',
  '12:00 PM','12:30 PM','1:00 PM','1:30 PM','2:00 PM','2:30 PM',
  '3:00 PM','3:30 PM','4:00 PM','4:30 PM','5:00 PM',
]

function getDaysInMonth(year: number, month: number) {
  return new Date(year, month + 1, 0).getDate()
}
function getFirstDayOfMonth(year: number, month: number) {
  return new Date(year, month, 1).getDay()
}
function isSunday(year: number, month: number, day: number) {
  return new Date(year, month, day).getDay() === 0
}
function isPast(year: number, month: number, day: number) {
  const today = new Date(); today.setHours(0,0,0,0)
  return new Date(year, month, day) < today
}

// ── Component ────────────────────────────────────────────────────────────────

type Step = 'datetime' | 'details' | 'payment' | 'confirmed'

interface FormData {
  date: { year: number; month: number; day: number } | null
  time: string
  name: string
  phone: string
  email: string
}

export default function BookConsultationPage() {
  const today = new Date()
  const [step, setStep] = useState<Step>('datetime')
  const [calYear, setCalYear]   = useState(today.getFullYear())
  const [calMonth, setCalMonth] = useState(today.getMonth())
  const [form, setForm] = useState<FormData>({
    date: null, time: '', name: '', phone: '', email: '',
  })
  const [errors, setErrors] = useState<Partial<Record<keyof FormData, string>>>({})
  const [paying, setPaying] = useState(false)
  const [payError, setPayError] = useState('')
  const [confirmedRef, setConfirmedRef] = useState('')

  // Stable reference — generated once per mount, not on every render
  const paystackRef = useRef(`CAN-CONSULT-${Date.now()}`).current

  // Helper defined before use in paystackConfig
  const getDateLabel = (d = form.date) => d
    ? `${DAYS[new Date(d.year, d.month, d.day).getDay()]}, ${d.day} ${MONTHS[d.month]} ${d.year}`
    : ''

  const paystackConfig = {
    reference: paystackRef,
    email: form.email || 'placeholder@careaccess.ng',
    amount: 800000, // ₦8,000 in kobo
    publicKey: process.env.NEXT_PUBLIC_PAYSTACK_PUBLIC_KEY!,
    metadata: {
      custom_fields: [
        { display_name: 'Patient Name', variable_name: 'patient_name', value: form.name },
        { display_name: 'Phone', variable_name: 'phone', value: form.phone },
        { display_name: 'Appointment Date', variable_name: 'appointment_date', value: getDateLabel() },
        { display_name: 'Appointment Time', variable_name: 'appointment_time', value: form.time },
      ],
    },
  }

  const initializePayment = usePaystackPayment(paystackConfig)

  // Calendar nav
  const prevMonth = () => {
    if (calMonth === 0) { setCalMonth(11); setCalYear(y => y - 1) }
    else setCalMonth(m => m - 1)
  }
  const nextMonth = () => {
    if (calMonth === 11) { setCalMonth(0); setCalYear(y => y + 1) }
    else setCalMonth(m => m + 1)
  }

  const daysInMonth   = getDaysInMonth(calYear, calMonth)
  const firstDaySlots = getFirstDayOfMonth(calYear, calMonth)

  // Validation
  const validateDetails = () => {
    const e: typeof errors = {}
    if (!form.name.trim())  e.name  = 'Please enter your full name'
    if (!form.phone.trim()) e.phone = 'Please enter your phone number'
    if (!form.email.trim() || !/\S+@\S+\.\S+/.test(form.email)) e.email = 'Please enter a valid email'
    setErrors(e)
    return Object.keys(e).length === 0
  }

  const handleDatetimeContinue = () => {
    if (!form.date) { alert('Please select a date'); return }
    if (!form.time) { alert('Please select a time slot'); return }
    setStep('details')
  }

  const handleDetailsContinue = () => {
    if (validateDetails()) setStep('payment')
  }

  const handlePay = async () => {
    setPaying(true)
    setPayError('')

    // 1. Save pending booking via backend API before opening Paystack
    const preferredDate = form.date
      ? `${form.date.year}-${String(form.date.month + 1).padStart(2, '0')}-${String(form.date.day).padStart(2, '0')}`
      : ''

    try {
      await createBooking({
        full_name: form.name,
        email: form.email,
        phone: form.phone,
        preferred_date: preferredDate,
        preferred_time: form.time,
        paystack_reference: paystackRef,
      })
    } catch {
      setPayError('Could not save your booking. Please try again.')
      setPaying(false)
      return
    }

    // 2. Open Paystack popup
    initializePayment({
      onSuccess: async () => {
        // 3. Backend verifies transaction server-side with Paystack, then confirms booking
        try {
          await verifyBookingPayment(paystackRef)
          setConfirmedRef(paystackRef)
          setStep('confirmed')
        } catch {
          setPayError('Payment received but confirmation failed. Please contact support with reference: ' + paystackRef)
        } finally {
          setPaying(false)
        }
      },
      onClose: () => {
        // User closed popup without paying
        setPaying(false)
      },
    })
  }

  // ── Step indicators ───────────────────────────────────────────────────────
  const steps: { key: Step; label: string }[] = [
    { key: 'datetime', label: 'Date & Time' },
    { key: 'details',  label: 'Your Details' },
    { key: 'payment',  label: 'Payment' },
  ]
  const stepIndex = steps.findIndex(s => s.key === step)

  return (
    <div className="min-h-screen bg-gray-50 pt-20">
      <div className="container-max max-w-2xl py-12">

        {/* Back link */}
        {step !== 'confirmed' && (
          <Link href="/become-a-member" className="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-navy mb-8 transition-colors">
            <ArrowLeft size={16} /> Back
          </Link>
        )}

        {/* Progress bar */}
        {step !== 'confirmed' && (
          <div className="flex items-center gap-2 mb-10">
            {steps.map((s, i) => (
              <div key={s.key} className="flex items-center gap-2 flex-1">
                <div className={`w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0 transition-all duration-300 ${
                  i < stepIndex ? 'bg-teal text-white' :
                  i === stepIndex ? 'bg-navy text-white' :
                  'bg-gray-200 text-gray-400'
                }`}>
                  {i < stepIndex ? <CheckCircle2 size={14} /> : i + 1}
                </div>
                <span className={`text-xs font-semibold hidden sm:block ${i === stepIndex ? 'text-navy' : 'text-gray-400'}`}>
                  {s.label}
                </span>
                {i < steps.length - 1 && (
                  <div className={`flex-1 h-0.5 rounded-full ${i < stepIndex ? 'bg-teal' : 'bg-gray-200'}`} />
                )}
              </div>
            ))}
          </div>
        )}

        <div className="bg-white rounded-3xl shadow-soft border border-gray-100 overflow-hidden">

          {/* ── STEP 1: Date & Time ───────────────────────────────────────── */}
          {step === 'datetime' && (
            <div className="p-8">
              <div className="mb-7">
                <div className="section-tag bg-teal/10 text-teal mb-3">Step 1 of 3</div>
                <h1 className="text-2xl font-extrabold text-navy">Book a Consultation</h1>
                <p className="text-sm text-gray-500 mt-1">Select a date and time that works for you.</p>
              </div>

              {/* Calendar header */}
              <div className="flex items-center justify-between mb-4">
                <button onClick={prevMonth} className="w-9 h-9 rounded-xl flex items-center justify-center hover:bg-gray-100 transition-colors">
                  <ChevronLeft size={18} className="text-gray-600" />
                </button>
                <span className="font-bold text-navy text-sm">{MONTHS[calMonth]} {calYear}</span>
                <button onClick={nextMonth} className="w-9 h-9 rounded-xl flex items-center justify-center hover:bg-gray-100 transition-colors">
                  <ChevronRight size={18} className="text-gray-600" />
                </button>
              </div>

              {/* Day labels */}
              <div className="grid grid-cols-7 mb-2">
                {DAYS.map(d => (
                  <div key={d} className="text-center text-xs font-semibold text-gray-400 py-1">{d}</div>
                ))}
              </div>

              {/* Calendar grid */}
              <div className="grid grid-cols-7 gap-1 mb-8">
                {Array.from({ length: firstDaySlots }).map((_, i) => <div key={`e-${i}`} />)}
                {Array.from({ length: daysInMonth }).map((_, i) => {
                  const day = i + 1
                  const disabled = isPast(calYear, calMonth, day) || isSunday(calYear, calMonth, day)
                  const selected = form.date?.year === calYear && form.date?.month === calMonth && form.date?.day === day
                  return (
                    <button
                      key={day}
                      disabled={disabled}
                      onClick={() => setForm(f => ({ ...f, date: { year: calYear, month: calMonth, day } }))}
                      className={`aspect-square rounded-xl text-sm font-semibold transition-all duration-200 ${
                        disabled ? 'text-gray-200 cursor-not-allowed' :
                        selected ? 'bg-navy text-white shadow-navy/20 shadow-md' :
                        'text-gray-700 hover:bg-teal/10 hover:text-teal'
                      }`}
                    >
                      {day}
                    </button>
                  )
                })}
              </div>

              {/* Time slots */}
              <div className="mb-8">
                <div className="flex items-center gap-2 mb-3">
                  <Clock size={15} className="text-teal" />
                  <span className="text-sm font-semibold text-navy">
                    {form.date ? `Available times — ${ getDateLabel() }` : 'Select a date first'}
                  </span>
                </div>
                <div className="flex flex-wrap gap-2">
                  {TIME_SLOTS.map(t => {
                    const active = form.time === t
                    const disabled = !form.date
                    return (
                      <button
                        key={t}
                        disabled={disabled}
                        onClick={() => setForm(f => ({ ...f, time: t }))}
                        className={`px-3.5 py-2 rounded-xl text-xs font-semibold border-2 transition-all duration-200 ${
                          disabled ? 'border-gray-100 text-gray-300 cursor-not-allowed' :
                          active ? 'border-navy bg-navy text-white' :
                          'border-gray-200 text-gray-600 hover:border-teal hover:text-teal'
                        }`}
                      >
                        {t}
                      </button>
                    )
                  })}
                </div>
              </div>

              <button
                onClick={handleDatetimeContinue}
                className="w-full flex items-center justify-center gap-2 py-4 bg-navy text-white rounded-xl font-bold text-sm hover:bg-navy-600 transition-all duration-200 hover:-translate-y-0.5"
              >
                Continue <ArrowRight size={16} />
              </button>
            </div>
          )}

          {/* ── STEP 2: Details ───────────────────────────────────────────── */}
          {step === 'details' && (
            <div className="p-8">
              <div className="mb-7">
                <div className="section-tag bg-teal/10 text-teal mb-3">Step 2 of 3</div>
                <h1 className="text-2xl font-extrabold text-navy">Your Details</h1>
                <p className="text-sm text-gray-500 mt-1">Tell us how to reach you for your consultation.</p>
              </div>

              {/* Summary pill */}
              <div className="flex items-center gap-3 bg-navy/5 rounded-2xl p-4 mb-8">
                <Calendar size={16} className="text-navy flex-shrink-0" />
                <span className="text-sm font-semibold text-navy">{ getDateLabel() }</span>
                <span className="w-1 h-1 rounded-full bg-gray-300" />
                <Clock size={16} className="text-teal flex-shrink-0" />
                <span className="text-sm font-semibold text-teal">{form.time}</span>
                <button onClick={() => setStep('datetime')} className="ml-auto text-xs text-gray-400 hover:text-navy underline">Change</button>
              </div>

              <div className="space-y-5">
                <div>
                  <label className="block text-sm font-semibold text-navy mb-2">Full Name</label>
                  <div className="relative">
                    <User size={15} className="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400" />
                    <input
                      type="text"
                      value={form.name}
                      onChange={e => { setForm(f => ({ ...f, name: e.target.value })); setErrors(er => ({ ...er, name: '' })) }}
                      placeholder="e.g. Adaeze Okafor"
                      className={`form-input pl-10 ${errors.name ? 'border-red-400 focus:ring-red-400' : ''}`}
                    />
                  </div>
                  {errors.name && <p className="text-xs text-red-500 mt-1">{errors.name}</p>}
                </div>

                <div>
                  <label className="block text-sm font-semibold text-navy mb-2">Phone Number</label>
                  <div className="relative">
                    <Phone size={15} className="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400" />
                    <input
                      type="tel"
                      value={form.phone}
                      onChange={e => { setForm(f => ({ ...f, phone: e.target.value })); setErrors(er => ({ ...er, phone: '' })) }}
                      placeholder="e.g. 08012345678"
                      className={`form-input pl-10 ${errors.phone ? 'border-red-400 focus:ring-red-400' : ''}`}
                    />
                  </div>
                  {errors.phone && <p className="text-xs text-red-500 mt-1">{errors.phone}</p>}
                </div>

                <div>
                  <label className="block text-sm font-semibold text-navy mb-2">Email Address</label>
                  <div className="relative">
                    <Mail size={15} className="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400" />
                    <input
                      type="email"
                      value={form.email}
                      onChange={e => { setForm(f => ({ ...f, email: e.target.value })); setErrors(er => ({ ...er, email: '' })) }}
                      placeholder="e.g. adaeze@email.com"
                      className={`form-input pl-10 ${errors.email ? 'border-red-400 focus:ring-red-400' : ''}`}
                    />
                  </div>
                  {errors.email && <p className="text-xs text-red-500 mt-1">{errors.email}</p>}
                </div>
              </div>

              <div className="flex gap-3 mt-8">
                <button onClick={() => setStep('datetime')} className="flex items-center gap-2 px-5 py-4 rounded-xl border-2 border-gray-200 text-gray-600 font-semibold text-sm hover:border-navy hover:text-navy transition-all duration-200">
                  <ArrowLeft size={15} /> Back
                </button>
                <button
                  onClick={handleDetailsContinue}
                  className="flex-1 flex items-center justify-center gap-2 py-4 bg-navy text-white rounded-xl font-bold text-sm hover:bg-navy-600 transition-all duration-200 hover:-translate-y-0.5"
                >
                  Continue to Payment <ArrowRight size={16} />
                </button>
              </div>
            </div>
          )}

          {/* ── STEP 3: Payment ───────────────────────────────────────────── */}
          {step === 'payment' && (
            <div className="p-8">
              <div className="mb-7">
                <div className="section-tag bg-teal/10 text-teal mb-3">Step 3 of 3</div>
                <h1 className="text-2xl font-extrabold text-navy">Complete Payment</h1>
                <p className="text-sm text-gray-500 mt-1">Your booking is reserved. Complete payment to confirm.</p>
              </div>

              {/* Summary card */}
              <div className="bg-gray-50 rounded-2xl border border-gray-100 p-6 mb-8 space-y-3">
                <div className="flex justify-between items-center">
                  <span className="text-sm text-gray-500">Service</span>
                  <span className="text-sm font-semibold text-navy">Single Teleconsultation</span>
                </div>
                <div className="flex justify-between items-center">
                  <span className="text-sm text-gray-500">Date</span>
                  <span className="text-sm font-semibold text-navy">{ getDateLabel() }</span>
                </div>
                <div className="flex justify-between items-center">
                  <span className="text-sm text-gray-500">Time</span>
                  <span className="text-sm font-semibold text-navy">{form.time}</span>
                </div>
                <div className="flex justify-between items-center">
                  <span className="text-sm text-gray-500">Name</span>
                  <span className="text-sm font-semibold text-navy">{form.name}</span>
                </div>
                <div className="h-px bg-gray-200" />
                <div className="flex justify-between items-center">
                  <span className="text-base font-bold text-navy">Total</span>
                  <span className="text-2xl font-extrabold text-navy">₦8,000</span>
                </div>
              </div>

              <div className="flex items-center gap-2 bg-teal/5 border border-teal/20 rounded-xl p-4 mb-8">
                <div className="w-2 h-2 rounded-full bg-teal flex-shrink-0" />
                <p className="text-xs text-gray-600 leading-relaxed">
                  Secured by <span className="font-bold text-navy">Paystack</span>. Your card details are never stored on our servers.
                </p>
              </div>

              {payError && (
                <div className="mb-4 p-4 bg-red-50 border border-red-100 rounded-xl text-sm text-red-600">
                  {payError}
                </div>
              )}

              <div className="flex gap-3">
                <button onClick={() => setStep('details')} className="flex items-center gap-2 px-5 py-4 rounded-xl border-2 border-gray-200 text-gray-600 font-semibold text-sm hover:border-navy hover:text-navy transition-all duration-200">
                  <ArrowLeft size={15} /> Back
                </button>
                <button
                  onClick={handlePay}
                  disabled={paying}
                  className="flex-1 flex items-center justify-center gap-2 py-4 bg-teal text-white rounded-xl font-bold text-sm hover:bg-teal-600 transition-all duration-200 hover:-translate-y-0.5 disabled:opacity-70 disabled:cursor-not-allowed"
                >
                  {paying ? (
                    <><span className="w-4 h-4 border-2 border-white/40 border-t-white rounded-full animate-spin" /> Processing…</>
                  ) : (
                    <>Pay ₦8,000 <ArrowRight size={16} /></>
                  )}
                </button>
              </div>
            </div>
          )}

          {/* ── CONFIRMED ─────────────────────────────────────────────────── */}
          {step === 'confirmed' && (
            <div className="p-10 text-center">
              <div className="w-20 h-20 rounded-full bg-teal/10 flex items-center justify-center mx-auto mb-6">
                <CheckCircle2 size={40} className="text-teal" />
              </div>
              <h1 className="text-2xl font-extrabold text-navy mb-3">Booking Confirmed!</h1>
              <p className="text-gray-500 text-sm leading-relaxed max-w-sm mx-auto mb-2">
                Your consultation is scheduled for
              </p>
              <p className="font-bold text-navy mb-1">{ getDateLabel() } at {form.time}</p>
              <p className="text-gray-400 text-xs mb-8">
                We will send your consultation link or contact you at <span className="font-semibold text-navy">{form.email}</span>
              </p>

              <div className="bg-gray-50 rounded-2xl p-5 mb-8 text-left space-y-2">
                <p className="text-xs font-bold text-gray-400 uppercase tracking-wide mb-3">Booking Summary</p>
                <div className="flex justify-between text-sm">
                  <span className="text-gray-500">Reference</span>
                  <span className="font-mono font-semibold text-navy text-xs">{confirmedRef}</span>
                </div>
                <div className="flex justify-between text-sm">
                  <span className="text-gray-500">Amount Paid</span>
                  <span className="font-bold text-navy">₦8,000</span>
                </div>
              </div>

              <div className="flex flex-col sm:flex-row gap-3 justify-center">
                <Link href="/" className="btn-secondary text-sm px-6 py-3">
                  Back to Home
                </Link>
                <Link href="/become-a-member" className="btn-primary text-sm px-6 py-3">
                  Explore Membership
                </Link>
              </div>
            </div>
          )}
        </div>

        {/* Consultation fee note */}
        {step !== 'confirmed' && (
          <p className="text-center text-xs text-gray-400 mt-6">
            Consultation fee: <span className="font-semibold text-gray-500">₦8,000</span> · Paid securely via Paystack
          </p>
        )}
      </div>
    </div>
  )
}
