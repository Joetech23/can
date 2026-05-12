import type { Metadata } from 'next'
import Image from 'next/image'
import Link from 'next/link'
import AnimatedSection from '@/components/ui/AnimatedSection'
import { images } from '@/lib/utils'
import {
  UserCheck, Video, Phone, Home, GitBranch,
  CheckCircle2, ArrowRight, Star, Building2, Users
} from 'lucide-react'

export const metadata: Metadata = {
  title: 'Our Services',
  description:
    'Explore the full range of Care Access Nigeria services: personal doctor, teleconsultation, 24/7 clinical advice, home visits, and care coordination. Plans from ₦25,000/month.',
  alternates: {
    canonical: 'https://careaccess.ng/services',
  },
}

const coreServices = [
  {
    id: 'personal-doctor',
    icon: UserCheck,
    title: 'Dedicated Care Team',
    image: images.maleDoctorExplaining,
    description: 'Every member gets a dedicated in-house doctor. Your doctor learns your medical history, manages your family\'s health profile, and is your permanent point of contact for all health decisions. You never start from scratch with a new face.',
    highlights: [
      'Full medical history on file',
      'Family health profile management',
      'First contact for all health decisions',
      'Referral coordination to specialists',
    ],
    memberOnly: false,
  },
  {
    id: 'teleconsultation',
    icon: Video,
    title: 'Teleconsultation',
    image: images.maleDoctorVirtual,
    description: 'Speak directly with a licensed doctor from wherever you are. Available via phone or video call.',
    highlights: [
      'Phone and video consultation available',
      'Licensed, verified doctors',
      'Available to members and non-members',
    ],
    memberOnly: false,
  },
  {
    id: 'nurse-on-call',
    icon: Phone,
    title: '24/7 Nurse on Call',
    image: images.nursePhoneCall,
    description: 'Members have round-the-clock access to a clinical nurse for immediate advice. Get guidance on symptoms, medication, and next steps at any time of day or night. This service is exclusively for members.',
    highlights: [
      'Available 24 hours, 7 days a week',
      'Symptom guidance and triage',
      'Medication and next-steps advice',
      'Members only — not available without a plan',
    ],
    memberOnly: true,
  },
  {
    id: 'home-visits',
    icon: Home,
    title: 'Home Visits',
    image: images.femaleNurseCall,
    description: 'Arrange an in-person nurse visit for yourself or a family member anywhere in Nigeria. Ideal for elderly relatives, post-procedure recovery, or routine check-ups for family members in other cities.',
    highlights: [
      'Available across Nigeria',
      'Elderly care and post-procedure support',
      'In-home health assessments',
      'Coordinated by your personal doctor',
    ],
    memberOnly: false,
  },
  {
    id: 'care-coordination',
    icon: GitBranch,
    title: 'Care Coordination',
    image: images.virtualMaleSession,
    description: 'When you need a specialist, lab test, pharmacy, or hospital admission, we handle the navigation. We work with a vetted network of partners and share your records (with consent) so your care is always connected.',
    highlights: [
      'Specialist referral management',
      'Lab and pharmacy coordination',
      'Hospital admissions with your records shared',
      'Always with your informed consent',
    ],
    memberOnly: false,
  },
]

const plans = [
  {
    name: 'Personal Care',
    price: '25,000',
    highlight: false,
    colorClass: 'border-gray-100',
    description: 'Reliable, continuous care for individuals who want a dedicated team.',
    features: [
      { text: 'Speak to a doctor when you need to', included: true },
      { text: '24/7 clinical advice', included: true },
      { text: 'Same-day or next-day appointments', included: true },
      { text: 'Full medical record & continuity of care', included: true },
      { text: 'Prescription & medication support', included: true },
      { text: 'Specialist referrals & care guidance', included: true },
      { text: 'Family member coverage', included: false },
    ],
    cta: 'Choose Personal Care',
    href: '/become-a-member',
  },
  {
    name: 'Extended Care',
    price: '45,000',
    highlight: true,
    colorClass: 'border-teal',
    description: 'For those who need more frequent support or are managing ongoing conditions.',
    features: [
      { text: 'Everything in Personal Care', included: true },
      { text: 'More frequent doctor consultations', included: true },
      { text: 'Ongoing chronic condition management', included: true },
      { text: 'Proactive clinical check-ins', included: true },
      { text: '1 home nurse visit per month', included: true },
      { text: 'Priority response', included: true },
      { text: 'Family member coverage', included: false },
    ],
    cta: 'Choose Extended Care',
    href: '/become-a-member',
  },
  {
    name: 'Family Care',
    price: '85,000',
    highlight: false,
    colorClass: 'border-navy',
    description: 'One trusted care team for your whole household — up to 4 people.',
    features: [
      { text: 'Covers up to 4 family members', included: true },
      { text: 'Shared doctor access for all members', included: true },
      { text: '24/7 clinical advice for the family', included: true },
      { text: 'Family medical records', included: true },
      { text: 'Adult and children\'s care', included: true },
      { text: '1 home nurse visit per month', included: true },
      { text: 'Specialist referrals for all members', included: true },
    ],
    cta: 'Choose Family Care',
    href: '/become-a-member',
  },
]

export default function ServicesPage() {
  return (
    <>
      {/* Hero */}
      <section className="relative pt-28 pb-20 md:pt-36 md:pb-28 overflow-hidden hero-gradient" aria-label="Services hero">
        <div className="absolute inset-0 bg-navy-mesh" />
        <div className="absolute bottom-0 left-0 right-0">
          <svg viewBox="0 0 1440 60" fill="none" preserveAspectRatio="none">
            <path d="M0 60L1440 60L1440 20C1200 60 900 0 720 0C540 0 240 60 0 20L0 60Z" fill="white" />
          </svg>
        </div>
        <div className="relative z-10 container-max text-center">
          <AnimatedSection>
            <div className="section-tag bg-teal/20 text-teal-200 mx-auto mb-5">Our Services</div>
            <h1 className="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-6 max-w-4xl mx-auto">
              Everything you need to access care and{' '}
              <span className="text-teal-300">stay ahead of your health</span>
            </h1>
            <p className="text-base md:text-xl text-white/70 max-w-2xl mx-auto leading-relaxed">
              A complete range of healthcare access services for individuals, families, and organisations. Whether you need immediate guidance or long-term health management, we have a service for you.
            </p>
          </AnimatedSection>
        </div>
      </section>

      {/* Core Services */}
      <section className="section-padding bg-white relative -mt-px" aria-labelledby="services-list-heading">
        <div className="container-max">
          <AnimatedSection className="text-center mb-14">
            <div className="section-tag bg-teal/10 text-teal mx-auto mb-4">Core Services</div>
            <h2 id="services-list-heading" className="text-3xl md:text-4xl font-extrabold text-navy mb-4">
              What every membership includes
            </h2>
            <p className="text-base text-gray-500 max-w-xl mx-auto">
              Our services are designed to work together. Each piece connects to give you complete, continuous care.
            </p>
          </AnimatedSection>

          <div className="space-y-16">
            {coreServices.map(({ id, icon: Icon, title, image, description, highlights, memberOnly }, i) => (
              <AnimatedSection key={id} animation={i % 2 === 0 ? 'fade-right' : 'fade-left'} delay={100}>
                <div id={id} className={`grid lg:grid-cols-2 gap-12 items-center ${i % 2 !== 0 ? 'lg:flex-row-reverse' : ''}`}>
                  <div className={i % 2 !== 0 ? 'lg:order-2' : ''}>
                    <div className="relative rounded-3xl overflow-hidden aspect-[16/10] shadow-large">
                      <Image src={image} alt={title} fill className="object-cover" sizes="50vw" />
                      <div className="absolute inset-0 bg-gradient-to-t from-navy/30 to-transparent" />
                      {memberOnly && (
                        <div className="absolute top-4 right-4 bg-orange text-white text-xs font-bold px-3 py-1.5 rounded-full">
                          Members Only
                        </div>
                      )}
                    </div>
                  </div>

                  <div className={i % 2 !== 0 ? 'lg:order-1' : ''}>
                    <div className="flex items-center gap-3 mb-4">
                      <div className="w-10 h-10 rounded-xl bg-teal/10 flex items-center justify-center">
                        <Icon size={20} className="text-teal" />
                      </div>
                      <span className="text-xs font-bold text-teal uppercase tracking-widest">{title}</span>
                    </div>
                    <h3 className="text-2xl md:text-3xl font-extrabold text-navy mb-4">{title}</h3>
                    <p className="text-base text-gray-600 leading-relaxed mb-6">{description}</p>

                    <ul className="space-y-3">
                      {highlights.map((h) => (
                        <li key={h} className="flex items-start gap-2.5">
                          <CheckCircle2 size={16} className="text-teal flex-shrink-0 mt-0.5" />
                          <span className="text-sm text-gray-700">{h}</span>
                        </li>
                      ))}
                    </ul>
                  </div>
                </div>
              </AnimatedSection>
            ))}
          </div>
        </div>
      </section>

      {/* Membership Plans */}
      {/* <section className="section-padding section-bg-alt" aria-labelledby="plans-heading">
        <div className="container-max">
          <AnimatedSection className="text-center mb-14">
            <div className="section-tag bg-navy/10 text-navy mx-auto mb-4">Membership Plans</div>
            <h2 id="plans-heading" className="text-3xl md:text-4xl font-extrabold text-navy mb-4">
              Full plan comparison
            </h2>
            <p className="text-base text-gray-500 max-w-xl mx-auto">
              Simple, transparent pricing. No hidden fees, no lock-in commitments. Cancel before your next billing date.
            </p>
          </AnimatedSection>

          <div className="grid md:grid-cols-3 gap-6 lg:gap-8 mb-8">
            {plans.map(({ name, price, highlight, colorClass, description, features, cta, href }, i) => (
              <AnimatedSection key={name} delay={i * 100} animation="fade-up">
                <div
                  className={`relative bg-white rounded-2xl border-2 p-7 h-full flex flex-col shadow-soft hover:shadow-medium transition-all duration-300 hover:-translate-y-1 ${
                    highlight ? 'border-teal shadow-teal' : colorClass
                  }`}
                >
                  {highlight && (
                    <div className="absolute -top-3.5 left-1/2 -translate-x-1/2">
                      <div className="flex items-center gap-1.5 px-4 py-1.5 bg-teal text-white text-xs font-bold rounded-full shadow-lg">
                        <Star size={11} fill="currentColor" />
                        Most Popular
                      </div>
                    </div>
                  )}

                  <div className="mb-5">
                    <h3 className="text-lg font-bold text-navy mb-1">{name}</h3>
                    <p className="text-sm text-gray-500 leading-relaxed">{description}</p>
                  </div>

                  <div className="mb-6 pb-6 border-b border-gray-100">
                    <div className="flex items-end gap-1">
                      <span className="text-sm text-gray-400 mb-1.5">₦</span>
                      <span className="text-4xl font-extrabold text-navy">{price}</span>
                      <span className="text-sm text-gray-400 mb-1.5">/month</span>
                    </div>
                    <p className="text-xs text-gray-400 mt-1">No lock-in. Cancel anytime.</p>
                  </div>

                  <ul className="space-y-3 flex-1 mb-7">
                    {features.map(({ text, included }) => (
                      <li key={text} className="flex items-start gap-2.5">
                        <span className={`flex-shrink-0 mt-0.5 w-4 h-4 rounded-full flex items-center justify-center ${
                          included ? 'bg-teal/10' : 'bg-gray-100'
                        }`}>
                          {included ? (
                            <CheckCircle2 size={12} className="text-teal" />
                          ) : (
                            <span className="w-1.5 h-0.5 rounded-full bg-gray-300" />
                          )}
                        </span>
                        <span className={`text-sm ${included ? 'text-gray-700' : 'text-gray-400 line-through'}`}>
                          {text}
                        </span>
                      </li>
                    ))}
                  </ul>

                  <a
                    href={href}
                    className={`w-full py-3.5 rounded-xl font-semibold text-sm text-center transition-all duration-200 ${
                      highlight
                        ? 'bg-teal text-white hover:bg-teal-600'
                        : 'bg-navy text-white hover:bg-navy-600'
                    }`}
                  >
                    {cta}
                  </a>
                </div>
              </AnimatedSection>
            ))}
          </div>

          <p className="text-center text-xs text-gray-400">
            Plans start from ₦25,000/month. No lock-in — cancel before your next billing date.
          </p>
        </div>
      </section> */}

      {/* Non-member Access */}
    
    </>
  )
}
