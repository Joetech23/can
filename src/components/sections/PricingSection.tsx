'use client'

import { useState } from 'react'
import Link from 'next/link'
import AnimatedSection from '@/components/ui/AnimatedSection'
import { CheckCircle2, ArrowRight, Info, Stethoscope, User, Users } from 'lucide-react'

type Billing = 'monthly' | 'yearly'

const plans = [
  {
    id:              'consultation',
    icon:            Stethoscope,
    name:            'Book a Consultation',
    tag:             null,
    tagline:         'Access care on your own terms',
    priceMonthly:    null,
    priceYearly:     null,
    fixedAmount:     '8,000',
    fixedUnit:       'per visit',
    hasBillingToggle: false,
    theme:           'white' as const,
    features: [
      'One-time doctor consultation',
      'Diagnosis & treatment',
      'Prescription & referral',
    ],
  },
  {
    id:              'personal',
    icon:            User,
    name:            'Personal Care',
    tag:             'Most Popular',
    tagline:         'Your dedicated doctor, always on call',
    priceMonthly:    '25,000',
    priceYearly:     '270,000',
    yearlySaving:    'Save ₦30,000',
    fixedAmount:     null,
    fixedUnit:       null,
    hasBillingToggle: true,
    theme:           'navy' as const,
    features: [
      'Speak to a doctor when needed',
      '24/7 clinical advice',
      'Continuous care & records',
      'Follow-ups included',
      'Care coordination',
    ],
  },
  {
    id:              'family',
    icon:            Users,
    name:            'Family Care',
    tag:             null,
    tagline:         'Complete coverage for your household',
    priceMonthly:    '85,000',
    priceYearly:     '920,000',
    yearlySaving:    'Save ₦100,000',
    fixedAmount:     null,
    fixedUnit:       null,
    hasBillingToggle: true,
    theme:           'teal' as const,
    features: [
      'Shared doctor access',
      '24/7 support for your household',
      'Family health records',
      'Ongoing care for all members',
    ],
  },
]

// ── Per-theme style maps ──────────────────────────────────────────────────────

const themeStyles = {
  white: {
    card:       'bg-white border-gray-200',
    icon:       'bg-teal/10',
    iconColor:  'text-teal',
    heading:    'text-navy',
    tagline:    'text-gray-500',
    currency:   'text-teal',
    price:      'text-navy',
    unit:       'text-gray-400',
    saving:     'text-teal',
    check:      'text-teal',
    feature:    'text-gray-600',
    btn:        'bg-navy text-white hover:bg-navy-600',
  },
  navy: {
    card:       'bg-navy border-navy',
    icon:       'bg-white/15',
    iconColor:  'text-teal-300',
    heading:    'text-white',
    tagline:    'text-white/60',
    currency:   'text-teal-300',
    price:      'text-white',
    unit:       'text-white/50',
    saving:     'text-teal-300',
    check:      'text-teal-300',
    feature:    'text-white/80',
    btn:        'bg-teal text-white hover:bg-teal-600',
  },
  teal: {
    card:       'bg-teal border-teal',
    icon:       'bg-white/20',
    iconColor:  'text-white',
    heading:    'text-white',
    tagline:    'text-white/70',
    currency:   'text-white/80',
    price:      'text-white',
    unit:       'text-white/60',
    saving:     'text-white font-bold',
    check:      'text-white',
    feature:    'text-white/85',
    btn:        'bg-white text-teal hover:bg-white/90',
  },
}

export default function PricingSection() {
  const [billing, setBilling] = useState<Billing>('monthly')

  return (
    <section className="section-padding bg-white relative -mt-px" aria-labelledby="pricing-heading">
      <div className="container-max">
        <AnimatedSection className="text-center mb-12">
          <div className="section-tag bg-navy/10 text-navy mx-auto mb-4">
            Our Plans
          </div>
          <h2 id="pricing-heading" className="text-3xl md:text-4xl lg:text-5xl font-extrabold text-navy leading-tight mb-4">
            Simple, transparent pricing
          </h2>
          <p className="text-base md:text-lg text-gray-500 max-w-xl mx-auto mb-8">
            No hidden fees. No lock-in contracts. Just great care.
          </p>

          {/* Billing toggle */}
          <div className="inline-flex items-center gap-1 bg-gray-100 rounded-full p-1.5">
            <button
              onClick={() => setBilling('monthly')}
              className={`px-5 py-2 rounded-full text-sm font-semibold transition-all duration-200 ${
                billing === 'monthly'
                  ? 'bg-white text-navy shadow-soft'
                  : 'text-gray-500 hover:text-navy'
              }`}
            >
              Monthly
            </button>
            <button
              onClick={() => setBilling('yearly')}
              className={`px-5 py-2 rounded-full text-sm font-semibold transition-all duration-200 flex items-center gap-2 ${
                billing === 'yearly'
                  ? 'bg-white text-navy shadow-soft'
                  : 'text-gray-500 hover:text-navy'
              }`}
            >
              Yearly
            </button>
          </div>
        </AnimatedSection>

        {/* Plan cards */}
        <div className="grid md:grid-cols-3 gap-6 items-stretch">
          {plans.map((plan, i) => {
            const Icon = plan.icon
            const s    = themeStyles[plan.theme]

            const amount = plan.hasBillingToggle
              ? (billing === 'monthly' ? plan.priceMonthly : plan.priceYearly)
              : plan.fixedAmount

            const unit = plan.hasBillingToggle
              ? (billing === 'monthly' ? '/month' : '/year')
              : plan.fixedUnit

            return (
              <AnimatedSection key={plan.id} delay={i * 100} animation="fade-up">
                <div className={`relative rounded-3xl border-2 p-8 h-full flex flex-col transition-all duration-300 hover:shadow-large hover:-translate-y-1 ${s.card}`}>

                  {/* Popular tag */}
                  {plan.tag && (
                    <div className="absolute -top-3.5 left-1/2 -translate-x-1/2">
                      <span className="px-4 py-1 rounded-full text-xs font-bold bg-teal text-white shadow-teal">
                        {plan.tag}
                      </span>
                    </div>
                  )}

                  {/* Icon */}
                  <div className={`w-12 h-12 rounded-2xl ${s.icon} flex items-center justify-center mb-5`}>
                    <Icon size={22} className={s.iconColor} />
                  </div>

                  {/* Name + tagline */}
                  <h3 className={`text-xl font-extrabold mb-1 ${s.heading}`}>{plan.name}</h3>
                  <p className={`text-sm mb-6 ${s.tagline}`}>{plan.tagline}</p>

                  {/* Price */}
                  <div className="mb-6">
                    <div className="flex items-start gap-0.5">
                      {/* ₦ — smaller, sits at the top aligned with the number top */}
                      <span className={`text-base font-bold leading-none mt-1.5 ${s.currency}`}>₦</span>
                      <span className={`text-5xl font-black leading-none tracking-tight ${s.price}`}>
                        {amount}
                      </span>
                      <span className={`text-sm self-end mb-1 ml-1 ${s.unit}`}>{unit}</span>
                    </div>
                    {plan.hasBillingToggle && billing === 'yearly' && plan.yearlySaving && (
                      <p className={`text-xs font-semibold mt-1.5 ${s.saving}`}>{plan.yearlySaving}</p>
                    )}
                  </div>

                  {/* Features */}
                  <ul className="space-y-3 flex-1 mb-8">
                    {plan.features.map((f) => (
                      <li key={f} className="flex items-start gap-2.5">
                        <CheckCircle2 size={16} className={`flex-shrink-0 mt-0.5 ${s.check}`} />
                        <span className={`text-sm leading-snug ${s.feature}`}>{f}</span>
                      </li>
                    ))}
                  </ul>

                  {/* CTA */}
                  <Link
                    href={plan.id === 'consultation' ? '/book' : '/signup'}
                    className={`flex items-center justify-center gap-2 w-full py-3.5 rounded-xl text-sm font-bold transition-all duration-200 hover:-translate-y-0.5 ${s.btn}`}
                  >
                    {plan.id === 'consultation' ? 'Book Now' : 'Get Started'}
                    <ArrowRight size={15} />
                  </Link>
                </div>
              </AnimatedSection>
            )
          })}
        </div>

        {/* Additional services */}
        <AnimatedSection delay={400} animation="fade-up" className="mt-16">
          <div className="bg-gray-50 rounded-3xl p-8 md:p-12 border border-gray-100">
            <div className="grid lg:grid-cols-2 gap-10 items-start">
              <div>
                <div className="section-tag bg-teal/10 text-teal mb-4">Add-on Services</div>
                <h3 className="text-2xl md:text-3xl font-extrabold text-navy mb-4">
                  Additional Care Services
                </h3>
                <p className="text-gray-500 text-sm leading-relaxed">
                  We coordinate in-person and supportive care, so you don&apos;t have to manage it yourself.
                </p>
              </div>
              <div className="space-y-5">
                <ul className="grid sm:grid-cols-2 gap-3">
                  {[
                    'Home visits (doctor or nurse)',
                    'Lab tests and diagnostics',
                    'Medication delivery',
                    'Hospital & specialist coordination',
                    'Emergency & ambulance support',
                  ].map((item) => (
                    <li key={item} className="flex items-center gap-2.5 text-sm text-gray-600">
                      <span className="w-1.5 h-1.5 rounded-full bg-teal flex-shrink-0" />
                      {item}
                    </li>
                  ))}
                </ul>
                <div className="rounded-xl border-l-4 border-orange bg-teal/5 px-4 py-3">
                  <p className="text-sm text-gray-700 font-medium">
                    Every service is tailored to your needs and location.
                  </p>
                </div>
                <Link
                  href="/request-care"
                  className="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-teal text-white text-sm font-semibold hover:bg-teal-600 transition-all duration-200 w-full"
                >
                  Request a Service
                </Link>
              </div>
            </div>
          </div>

          <div className="mt-8 rounded-3xl border border-gray-200 bg-white p-6">
            <div className="flex items-start gap-4">
              <Info size={16} className="text-gray-400 flex-shrink-0 mt-0.5" />
              <div>
                <p className="text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Fair Use</p>
                <p className="text-sm text-gray-500 leading-relaxed">
                  Membership provides access to care when needed. Consultations are guided by clinical need to ensure safe, high-quality care for all patients.
                </p>
              </div>
            </div>
          </div>
        </AnimatedSection>
      </div>
    </section>
  )
}
