'use client'

import { useState, useRef } from 'react'
import Link from 'next/link'
import { ArrowLeft, ArrowRight, CheckCircle2, Eye, EyeOff, User, Phone, Mail, Lock, Stethoscope, Users, AlertTriangle, Pill, Heart, Phone as PhoneIcon } from 'lucide-react'
import { usePaystackPayment } from 'react-paystack'
import { signup } from '@/lib/auth'
import { activateMembership } from '@/lib/memberships'
import { setSession } from '@/lib/session'

// ── Types ─────────────────────────────────────────────────────────────────────

type Plan = 'personal' | 'family'
type Billing = 'monthly' | 'yearly'
type Step = 'account' | 'plan' | 'payment' | 'profile' | 'welcome'

interface AccountData {
  fullName: string
  phone: string
  email: string
  password: string
}

interface ProfileData {
  allergies: string
  medications: string
  conditions: string
  emergencyName: string
  emergencyPhone: string
}

const PLANS = {
  personal: {
    name: 'Personal Care',
    icon: Stethoscope,
    description: 'For individuals',
    monthly: 25000,
    yearly: 270000,
    saving: 30000,
    features: ['Dedicated personal doctor','24/7 nurse advice line','Unlimited teleconsultations','Specialist referral coordination'],
  },
  family: {
    name: 'Family Care',
    icon: Users,
    description: 'Up to 4 members',
    monthly: 85000,
    yearly: 920000,
    saving: 100000,
    features: ['Up to 4 family members','Shared family health records','Dedicated family doctor','24/7 nurse advice line','Home nurse visits (2/month)'],
  },
}


// ── Main Component ────────────────────────────────────────────────────────────

export default function SignupPage() {
  const [step, setStep]       = useState<Step>('account')
  const [plan, setPlan]       = useState<Plan>('personal')
  const [billing, setBilling] = useState<Billing>('monthly')
  const [showPw, setShowPw]   = useState(false)
  const [paying, setPaying]   = useState(false)
  const [payError, setPayError] = useState('')

  // Stored after successful signup, used to authenticate the membership activation call
  const [accessToken, setAccessToken] = useState('')

  // Stable reference — generated once per mount
  const paystackRef = useRef(`CAN-MEM-${Date.now()}`).current

  const [account, setAccount] = useState<AccountData>({
    fullName: '', phone: '', email: '', password: '',
  })
  const [profile, setProfile] = useState<ProfileData>({
    allergies: '', medications: '', conditions: '', emergencyName: '', emergencyPhone: '',
  })
  const [errors, setErrors] = useState<Record<string, string>>({})

  const selectedPlan = PLANS[plan]
  const price = billing === 'monthly' ? selectedPlan.monthly : selectedPlan.yearly
  const priceLabel = `₦${price.toLocaleString()}/${billing === 'monthly' ? 'month' : 'year'}`

  // Paystack config — amount in kobo
  const paystackConfig = {
    reference: paystackRef,
    email: account.email || 'placeholder@careaccess.ng',
    amount: price * 100,
    publicKey: process.env.NEXT_PUBLIC_PAYSTACK_PUBLIC_KEY!,
    metadata: {
      custom_fields: [
        { display_name: 'Member Name',    variable_name: 'member_name',    value: account.fullName },
        { display_name: 'Plan',           variable_name: 'plan',           value: `${selectedPlan.name} (${billing})` },
        { display_name: 'Phone',          variable_name: 'phone',          value: account.phone },
      ],
    },
  }

  const initializePayment = usePaystackPayment(paystackConfig)

  // Steps definition
  const steps: { key: Step; label: string }[] = [
    { key: 'account', label: 'Account' },
    { key: 'plan',    label: 'Plan' },
    { key: 'payment', label: 'Payment' },
    { key: 'profile', label: 'Profile' },
  ]
  const stepIndex = steps.findIndex(s => s.key === step)

  // Validate account step
  const validateAccount = () => {
    const e: Record<string,string> = {}
    if (!account.fullName.trim()) e.fullName = 'Required'
    if (!account.phone.trim())    e.phone    = 'Required'
    if (!account.email.trim() || !/\S+@\S+\.\S+/.test(account.email)) e.email = 'Valid email required'
    if (account.password.length < 8) e.password = 'Minimum 8 characters'
    setErrors(e)
    return Object.keys(e).length === 0
  }

  const handleAccountContinue = () => {
    if (validateAccount()) setStep('plan')
  }

  const handlePay = async () => {
    setPaying(true)
    setPayError('')

    try {
      // Step 1 — Create account via backend
      const authResult = await signup({
        email: account.email,
        password: account.password,
        full_name: account.fullName,
        phone: account.phone,
        plan,
        billing_cycle: billing,
      })

      // Persist session so it survives page refreshes
      const token = authResult.session?.access_token || ''
      setSession(token, { id: authResult.user.id, email: authResult.user.email })
      setAccessToken(token)

      // Step 2 — Open Paystack popup
      initializePayment({
        onSuccess: async () => {
          try {
            // Step 3 — Backend verifies payment + activates membership
            await activateMembership({ paystack_reference: paystackRef, plan, billing_cycle: billing }, token)
            setPaying(false)
            setStep('profile')
          } catch (activateErr: unknown) {
            const msg = activateErr instanceof Error ? activateErr.message : 'Unknown error'
            setPayError(
              `Activation failed: ${msg} — Reference: ${paystackRef}. If payment was deducted, please contact support.`
            )
            setPaying(false)
          }
        },
        onClose: () => {
          // Account was created but not paid — user can return and pay later
          setPaying(false)
          setPayError('Payment cancelled. Your account has been created — please complete payment to activate your membership.')
        },
      })
    } catch (err: unknown) {
      const message = err instanceof Error ? err.message : 'Could not create account. Please try again.'
      setPayError(message)
      setPaying(false)
    }
  }

  // Suppress unused variable lint warning — accessToken used indirectly via setAccessToken
  void accessToken

  const handleProfileFinish = () => setStep('welcome')

  const setA = (field: keyof AccountData, val: string) => {
    setAccount(a => ({ ...a, [field]: val }))
    setErrors(e => ({ ...e, [field]: '' }))
  }

  return (
    <div className="min-h-screen bg-gray-50 pt-20">
      <div className="container-max max-w-xl py-12">

        {step !== 'welcome' && (
          <Link href="/become-a-member" className="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-navy mb-8 transition-colors">
            <ArrowLeft size={16} /> Back
          </Link>
        )}

        {/* Progress */}
        {step !== 'welcome' && (
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
                <span className={`text-xs font-semibold hidden sm:block ${i === stepIndex ? 'text-navy' : 'text-gray-400'}`}>{s.label}</span>
                {i < steps.length - 1 && (
                  <div className={`flex-1 h-0.5 rounded-full ${i < stepIndex ? 'bg-teal' : 'bg-gray-200'}`} />
                )}
              </div>
            ))}
          </div>
        )}

        <div className="bg-white rounded-3xl shadow-soft border border-gray-100 overflow-hidden">

          {/* ── STEP 1: Create Account ──────────────────────────────────── */}
          {step === 'account' && (
            <div className="p-8">
              <div className="mb-7">
                <div className="section-tag bg-teal/10 text-teal mb-3">Step 1 of 4</div>
                <h1 className="text-2xl font-extrabold text-navy">Create Your Account</h1>
                <p className="text-sm text-gray-500 mt-1">Let&apos;s start with the basics.</p>
              </div>

              <div className="space-y-5">
                {/* Full Name */}
                <div>
                  <label className="block text-sm font-semibold text-navy mb-2">Full Name</label>
                  <div className="relative">
                    <User size={15} className="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400" />
                    <input type="text" value={account.fullName} onChange={e => setA('fullName', e.target.value)}
                      placeholder="e.g. Adaeze Okafor" className={`form-input pl-10 ${errors.fullName ? 'border-red-400' : ''}`} />
                  </div>
                  {errors.fullName && <p className="text-xs text-red-500 mt-1">{errors.fullName}</p>}
                </div>

                {/* Phone */}
                <div>
                  <label className="block text-sm font-semibold text-navy mb-2">Phone Number</label>
                  <div className="relative">
                    <Phone size={15} className="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400" />
                    <input type="tel" value={account.phone} onChange={e => setA('phone', e.target.value)}
                      placeholder="e.g. 08012345678" className={`form-input pl-10 ${errors.phone ? 'border-red-400' : ''}`} />
                  </div>
                  {errors.phone && <p className="text-xs text-red-500 mt-1">{errors.phone}</p>}
                </div>

                {/* Email */}
                <div>
                  <label className="block text-sm font-semibold text-navy mb-2">Email Address</label>
                  <div className="relative">
                    <Mail size={15} className="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400" />
                    <input type="email" value={account.email} onChange={e => setA('email', e.target.value)}
                      placeholder="e.g. adaeze@email.com" className={`form-input pl-10 ${errors.email ? 'border-red-400' : ''}`} />
                  </div>
                  {errors.email && <p className="text-xs text-red-500 mt-1">{errors.email}</p>}
                </div>

                {/* Password */}
                <div>
                  <label className="block text-sm font-semibold text-navy mb-2">Password</label>
                  <div className="relative">
                    <Lock size={15} className="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400" />
                    <input type={showPw ? 'text' : 'password'} value={account.password} onChange={e => setA('password', e.target.value)}
                      placeholder="Minimum 8 characters" className={`form-input pl-10 pr-10 ${errors.password ? 'border-red-400' : ''}`} />
                    <button type="button" onClick={() => setShowPw(s => !s)} className="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-navy">
                      {showPw ? <EyeOff size={16} /> : <Eye size={16} />}
                    </button>
                  </div>
                  {errors.password && <p className="text-xs text-red-500 mt-1">{errors.password}</p>}
                </div>

              </div>

              <button onClick={handleAccountContinue}
                className="w-full flex items-center justify-center gap-2 py-4 bg-navy text-white rounded-xl font-bold text-sm mt-8 hover:bg-navy-600 transition-all duration-200 hover:-translate-y-0.5">
                Continue <ArrowRight size={16} />
              </button>

              <p className="text-center text-xs text-gray-400 mt-5">
                Already have an account? <Link href="/login" className="text-teal font-semibold hover:underline">Sign in</Link>
              </p>
            </div>
          )}

          {/* ── STEP 2: Choose Plan ─────────────────────────────────────── */}
          {step === 'plan' && (
            <div className="p-8">
              <div className="mb-7">
                <div className="section-tag bg-teal/10 text-teal mb-3">Step 2 of 4</div>
                <h1 className="text-2xl font-extrabold text-navy">Choose Your Plan</h1>
                <p className="text-sm text-gray-500 mt-1">You can upgrade or change anytime.</p>
              </div>

              {/* Billing toggle */}
              <div className="inline-flex items-center gap-1 bg-gray-100 rounded-full p-1.5 mb-6">
                {(['monthly','yearly'] as Billing[]).map(b => (
                  <button key={b} onClick={() => setBilling(b)}
                    className={`px-4 py-2 rounded-full text-xs font-semibold transition-all duration-200 flex items-center gap-2 ${
                      billing === b ? 'bg-white text-navy shadow-soft' : 'text-gray-500 hover:text-navy'
                    }`}>
                    {b.charAt(0).toUpperCase() + b.slice(1)}
                  </button>
                ))}
              </div>

              {/* Plan cards */}
              <div className="space-y-4 mb-8">
                {(Object.entries(PLANS) as [Plan, typeof PLANS.personal][]).map(([key, p]) => {
                  const Icon = p.icon
                  const selected = plan === key
                  const planPrice = billing === 'monthly' ? p.monthly : p.yearly
                  return (
                    <button key={key} onClick={() => setPlan(key)}
                      className={`w-full text-left rounded-2xl border-2 p-5 transition-all duration-200 ${
                        selected ? 'border-navy bg-navy/3' : 'border-gray-200 hover:border-gray-300'
                      }`}>
                      <div className="flex items-start gap-4">
                        <div className={`w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0 ${selected ? 'bg-navy text-white' : 'bg-gray-100 text-gray-500'}`}>
                          <Icon size={18} />
                        </div>
                        <div className="flex-1">
                          <div className="flex items-center justify-between mb-1">
                            <span className={`font-bold text-sm ${selected ? 'text-navy' : 'text-gray-700'}`}>{p.name}</span>
                            <span className={`text-sm font-extrabold ${selected ? 'text-navy' : 'text-gray-600'}`}>
                              ₦{planPrice.toLocaleString()}
                              <span className={`text-xs font-normal ${selected ? 'text-gray-500' : 'text-gray-400'}`}>/{billing === 'monthly' ? 'mo' : 'yr'}</span>
                            </span>
                          </div>
                          <p className="text-xs text-gray-400 mb-3">{p.description}</p>
                          {selected && (
                            <ul className="space-y-1.5">
                              {p.features.map(f => (
                                <li key={f} className="flex items-center gap-2 text-xs text-gray-600">
                                  <CheckCircle2 size={12} className="text-teal flex-shrink-0" /> {f}
                                </li>
                              ))}
                            </ul>
                          )}
                          {billing === 'yearly' && selected && (
                            <p className="text-xs text-teal font-semibold mt-2">Save ₦{p.saving.toLocaleString()} per year</p>
                          )}
                        </div>
                        <div className={`w-5 h-5 rounded-full border-2 flex items-center justify-center flex-shrink-0 mt-0.5 transition-all ${
                          selected ? 'border-navy bg-navy' : 'border-gray-300'
                        }`}>
                          {selected && <div className="w-2 h-2 rounded-full bg-white" />}
                        </div>
                      </div>
                    </button>
                  )
                })}
              </div>

              <div className="flex gap-3">
                <button onClick={() => setStep('account')} className="flex items-center gap-2 px-5 py-4 rounded-xl border-2 border-gray-200 text-gray-600 font-semibold text-sm hover:border-navy hover:text-navy transition-all duration-200">
                  <ArrowLeft size={15} /> Back
                </button>
                <button onClick={() => setStep('payment')}
                  className="flex-1 flex items-center justify-center gap-2 py-4 bg-navy text-white rounded-xl font-bold text-sm hover:bg-navy-600 transition-all duration-200 hover:-translate-y-0.5">
                  Proceed to Payment <ArrowRight size={16} />
                </button>
              </div>
            </div>
          )}

          {/* ── STEP 3: Payment ─────────────────────────────────────────── */}
          {step === 'payment' && (
            <div className="p-8">
              <div className="mb-7">
                <div className="section-tag bg-teal/10 text-teal mb-3">Step 3 of 4</div>
                <h1 className="text-2xl font-extrabold text-navy">Confirm & Pay</h1>
                <p className="text-sm text-gray-500 mt-1">Review your plan and complete payment to activate.</p>
              </div>

              {/* Order summary */}
              <div className="bg-navy rounded-2xl p-6 mb-6 text-white">
                <div className="flex items-start justify-between mb-4">
                  <div>
                    <p className="text-white/60 text-xs uppercase tracking-wider mb-1">Selected Plan</p>
                    <p className="text-lg font-extrabold">{selectedPlan.name}</p>
                    <p className="text-white/60 text-xs mt-0.5">{billing === 'yearly' ? 'Annual billing' : 'Monthly billing'}</p>
                  </div>
                  <div className="text-right">
                    <p className="text-2xl font-extrabold">{priceLabel}</p>
                    {billing === 'yearly' && <p className="text-teal-300 text-xs font-semibold mt-0.5">Save ₦{selectedPlan.saving.toLocaleString()}</p>}
                  </div>
                </div>
                <div className="h-px bg-white/10 mb-4" />
                <ul className="space-y-1.5">
                  {selectedPlan.features.map(f => (
                    <li key={f} className="flex items-center gap-2 text-xs text-white/70">
                      <CheckCircle2 size={12} className="text-teal-300" /> {f}
                    </li>
                  ))}
                </ul>
              </div>

              <div className="flex items-center gap-2 bg-gray-50 rounded-xl p-4 mb-8 border border-gray-100">
                <div className="w-2 h-2 rounded-full bg-teal flex-shrink-0" />
                <p className="text-xs text-gray-500 leading-relaxed">
                  Recurring {billing} subscription. Secured by <span className="font-bold text-navy">Paystack</span>. Cancel anytime before your next billing date.
                </p>
              </div>

              {payError && (
                <div className="mb-4 p-4 bg-red-50 border border-red-100 rounded-xl text-sm text-red-600 leading-relaxed">
                  {payError}
                </div>
              )}

              <div className="flex gap-3">
                <button onClick={() => setStep('plan')} className="flex items-center gap-2 px-5 py-4 rounded-xl border-2 border-gray-200 text-gray-600 font-semibold text-sm hover:border-navy hover:text-navy transition-all duration-200">
                  <ArrowLeft size={15} /> Back
                </button>
                <button onClick={handlePay} disabled={paying}
                  className="flex-1 flex items-center justify-center gap-2 py-4 bg-teal text-white rounded-xl font-bold text-sm hover:bg-teal-600 transition-all duration-200 disabled:opacity-70">
                  {paying ? (
                    <><span className="w-4 h-4 border-2 border-white/40 border-t-white rounded-full animate-spin" /> Processing…</>
                  ) : (
                    <>Pay {priceLabel} <ArrowRight size={16} /></>
                  )}
                </button>
              </div>
            </div>
          )}

          {/* ── STEP 4: Complete Profile ─────────────────────────────────── */}
          {step === 'profile' && (
            <div className="p-8">
              <div className="mb-7">
                <div className="section-tag bg-teal/10 text-teal mb-3">Step 4 of 4</div>
                <h1 className="text-2xl font-extrabold text-navy">Complete Your Profile</h1>
                <p className="text-sm text-gray-500 mt-1">Help your doctor understand your health from day one. You can update this anytime.</p>
              </div>

              <div className="space-y-5">
                <div>
                  <label className="block text-sm font-semibold text-navy mb-1.5">
                    <span className="flex items-center gap-2"><AlertTriangle size={14} className="text-orange" /> Allergies</span>
                  </label>
                  <textarea value={profile.allergies} onChange={e => setProfile(p => ({ ...p, allergies: e.target.value }))}
                    rows={2} placeholder="e.g. Penicillin, nuts, latex — or 'None known'"
                    className="form-input resize-none" />
                </div>

                <div>
                  <label className="block text-sm font-semibold text-navy mb-1.5">
                    <span className="flex items-center gap-2"><Pill size={14} className="text-teal" /> Current Medications</span>
                  </label>
                  <textarea value={profile.medications} onChange={e => setProfile(p => ({ ...p, medications: e.target.value }))}
                    rows={2} placeholder="e.g. Amlodipine 5mg daily — or 'None'"
                    className="form-input resize-none" />
                </div>

                <div>
                  <label className="block text-sm font-semibold text-navy mb-1.5">
                    <span className="flex items-center gap-2"><Heart size={14} className="text-orange" /> Chronic Conditions</span>
                  </label>
                  <textarea value={profile.conditions} onChange={e => setProfile(p => ({ ...p, conditions: e.target.value }))}
                    rows={2} placeholder="e.g. Hypertension, Type 2 Diabetes — or 'None'"
                    className="form-input resize-none" />
                </div>

                <div className="border-t border-gray-100 pt-5">
                  <p className="text-sm font-bold text-navy mb-4">Emergency Contact</p>
                  <div className="space-y-4">
                    <div>
                      <label className="block text-xs font-semibold text-gray-500 mb-2">Contact Name</label>
                      <div className="relative">
                        <User size={15} className="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400" />
                        <input type="text" value={profile.emergencyName} onChange={e => setProfile(p => ({ ...p, emergencyName: e.target.value }))}
                          placeholder="e.g. Emeka Okafor (Husband)" className="form-input pl-10" />
                      </div>
                    </div>
                    <div>
                      <label className="block text-xs font-semibold text-gray-500 mb-2">Contact Phone</label>
                      <div className="relative">
                        <PhoneIcon size={15} className="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400" />
                        <input type="tel" value={profile.emergencyPhone} onChange={e => setProfile(p => ({ ...p, emergencyPhone: e.target.value }))}
                          placeholder="e.g. 08087654321" className="form-input pl-10" />
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <button onClick={handleProfileFinish}
                className="w-full flex items-center justify-center gap-2 py-4 bg-navy text-white rounded-xl font-bold text-sm mt-8 hover:bg-navy-600 transition-all duration-200 hover:-translate-y-0.5">
                Finish Setup <ArrowRight size={16} />
              </button>
              <button onClick={() => setStep('welcome')} className="w-full text-center text-xs text-gray-400 hover:text-navy mt-3 transition-colors">
                Skip for now — I&apos;ll complete this later
              </button>
            </div>
          )}

          {/* ── WELCOME ────────────────────────────────────────────────── */}
          {step === 'welcome' && (
            <div className="p-10 text-center">
              <div className="w-20 h-20 rounded-full bg-teal/10 flex items-center justify-center mx-auto mb-6">
                <CheckCircle2 size={40} className="text-teal" />
              </div>
              <h1 className="text-2xl font-extrabold text-navy mb-2">Welcome to Care Access!</h1>
              <p className="text-sm text-gray-500 mb-1">Your {selectedPlan.name} membership is now active.</p>
              <p className="text-sm font-semibold text-navy mb-8">Your personal doctor will be in touch shortly.</p>

              <div className="grid grid-cols-1 sm:grid-cols-3 gap-3 mb-8">
                {[
                  { label: 'Request Consultation', href: '/dashboard', icon: Stethoscope },
                  { label: 'Request a Service', href: '/request-care', icon: Heart },
                  { label: 'View Medical Record', href: '/dashboard', icon: User },
                ].map(({ label, href, icon: Icon }) => (
                  <Link key={label} href={href}
                    className="flex flex-col items-center gap-2 p-4 rounded-2xl border-2 border-gray-100 hover:border-teal hover:bg-teal/5 transition-all duration-200 group">
                    <div className="w-10 h-10 rounded-xl bg-teal/10 flex items-center justify-center group-hover:bg-teal/20 transition-colors">
                      <Icon size={18} className="text-teal" />
                    </div>
                    <span className="text-xs font-semibold text-navy text-center leading-snug">{label}</span>
                  </Link>
                ))}
              </div>

              <Link href="/dashboard" className="btn-primary w-full justify-center">
                Go to My Dashboard <ArrowRight size={16} />
              </Link>
            </div>
          )}
        </div>
      </div>
    </div>
  )
}
