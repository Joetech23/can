'use client'

import { useState } from 'react'
import AnimatedSection from '@/components/ui/AnimatedSection'
import { ChevronDown } from 'lucide-react'

const faqs = [
  {
    category: 'Membership & Plans',
    questions: [
      {
        q: 'What does a Care Access Nigeria membership include?',
        a: 'Membership gives you a dedicated personal doctor who knows your full health history, access to the 24/7 clinical nurse advice line, unlimited teleconsultations, care coordination, and specialist referrals — all under one plan.',
      },
      {
        q: 'How is this different from a regular telemedicine app?',
        a: 'With most telemedicine apps you speak to a different doctor every time. At Care Access Nigeria, you are assigned one personal doctor who tracks your history, manages your ongoing conditions, and coordinates all your care. Continuity is the core difference.',
      },
      {
        q: 'Can I cancel my membership at any time?',
        a: "Yes. You can cancel before your next billing date with no penalties and no questions asked. We believe you should stay because the care is excellent, not because you're locked in.",
      },
      {
        q: 'Is there a Family plan?',
        a: 'Yes. The Family Care plan covers up to 4 members under one subscription, with shared health records and a dedicated family doctor for ₦85,000/month (or ₦920,000/year).',
      },
      {
        q: 'Can I pay yearly to save money?',
        a: 'Yes. Yearly plans come with one month free and an added discount, making them more cost-effective than monthly payments.',
      },
    ],
  },
  {
    category: 'Consultations & Care',
    questions: [
      {
        q: 'How do I speak with a doctor?',
        a: "Once you're a member, you can reach your personal doctor by phone, video call, or through our platform. For urgent clinical advice at any hour, the 24/7 nurse line is available to all members.",
      },
      {
        q: 'What happens if I need to see a specialist?',
        a: 'Your personal doctor evaluates you first, prepares a referral, and connects you directly to a vetted in-house specialist. Your records are shared (with your consent) so you arrive expected and informed — not starting from scratch.',
      },
      {
        q: 'Can I book a single consultation without a membership?',
        a: 'Yes. Non-members can book a single teleconsultation for ₦8,000 per session. Please note that 24/7 clinical advice and continuous care services are exclusively available to members.',
      },
      {
        q: 'Do you provide home visits?',
        a: 'Yes. Home doctor and nurse visits are available as additional services. Your personal doctor can arrange this when clinically appropriate. Costs are confirmed before any visit takes place.',
      },
    ],
  },
  {
    category: 'Privacy & Data',
    questions: [
      {
        q: 'Is my health information safe?',
        a: 'Your health data is fully confidential and stored securely. We never share your information with third parties without your explicit consent. Your records are only shared with specialists and care providers you are being referred to.',
      },
      {
        q: 'Who has access to my medical records?',
        a: 'Only your assigned Care Access doctors and nurses can access your records. When we refer you to a specialist or partner facility, your records are shared only with your consent as part of that specific referral.',
      },
    ],
  },
  {
    category: 'Organisations',
    questions: [
      {
        q: 'Do you offer plans for businesses and NGOs?',
        a: 'Yes. We provide tailored healthcare access packages for organisations of any size — from small teams to large corporates. These include teleconsultation access, 24/7 clinical advice, dedicated account management, and employee wellness reporting.',
      },
      {
        q: "How do we get started with a corporate plan?",
        a: "Reach out through our Contact page or email info@careaccess.ng. Our team will schedule a call, understand your team's needs, and put together a plan that works for your organisation.",
      },
    ],
  },
]

export default function FAQAccordion() {
  const [openItem, setOpenItem] = useState<string | null>(null)

  const toggle = (key: string) => {
    setOpenItem(openItem === key ? null : key)
  }

  return (
    <>
      {faqs.map((group, gi) => (
        <AnimatedSection key={group.category} delay={gi * 80} animation="fade-up" className="mb-12">
          <h2 className="text-lg font-bold text-teal uppercase tracking-widest mb-6 pb-3 border-b-2 border-teal/20">
            {group.category}
          </h2>

          <div className="space-y-3">
            {group.questions.map((item, qi) => {
              const key = `${gi}-${qi}`
              const isOpen = openItem === key

              return (
                <div
                  key={key}
                  className={`rounded-2xl border-2 transition-all duration-200 overflow-hidden ${
                    isOpen ? 'border-teal/30 shadow-soft' : 'border-gray-100 hover:border-teal/20'
                  }`}
                >
                  <button
                    onClick={() => toggle(key)}
                    className="w-full flex items-start justify-between gap-4 p-6 text-left"
                    aria-expanded={isOpen}
                  >
                    <span className="text-base font-semibold text-navy leading-snug">{item.q}</span>
                    <ChevronDown
                      size={20}
                      className={`flex-shrink-0 text-teal transition-transform duration-300 mt-0.5 ${
                        isOpen ? 'rotate-180' : ''
                      }`}
                    />
                  </button>

                  <div
                    className={`overflow-hidden transition-all duration-300 ${
                      isOpen ? 'max-h-96' : 'max-h-0'
                    }`}
                  >
                    <p className="px-6 pb-6 text-sm md:text-base text-gray-600 leading-relaxed">
                      {item.a}
                    </p>
                  </div>
                </div>
              )
            })}
          </div>
        </AnimatedSection>
      ))}
    </>
  )
}
