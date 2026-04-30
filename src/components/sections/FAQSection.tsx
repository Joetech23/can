'use client'

import { useState } from 'react'
import AnimatedSection from '@/components/ui/AnimatedSection'
import { Plus, Minus } from 'lucide-react'

const faqs = [
  {
    question: 'Is this a hospital?',
    answer: 'No. We are a virtual clinic providing guidance, consultation, and care coordination. We work alongside hospitals, not as a replacement. Think of us as your healthcare guide who ensures you reach the right place, fully informed.',
  },
  {
    question: 'Can I use this instead of my HMO?',
    answer: 'We are a strong complement to your HMO. Care Access gives you immediate access and ongoing personal guidance that most HMOs do not provide. Many of our members use both side by side.',
  },
  {
    question: 'What happens in an urgent health situation?',
    answer: 'For any life-threatening situation, go to the nearest hospital immediately. We will guide you on where to go and what to tell them, and we share your records with our vetted partner hospitals (with your consent) so they are prepared for your arrival.',
  },
  {
    question: 'Can I cancel my membership anytime?',
    answer: 'Yes. Cancel before your next billing date and you will not be charged again. There is no lock-in, no penalty, and no complicated process.',
  },
  {
    question: 'Can non-members use the service?',
    answer: 'Yes. Non-members can request a consultation by filling out a form. A nurse or admin will contact you, confirm pricing, and arrange payment before your session. Note: 24/7 nurse on call advice is exclusively available to subscribed members.',
  },
  {
    question: 'What is included in a personal doctor?',
    answer: 'Your personal doctor is a dedicated in-house licensed doctor assigned specifically to you. They learn your full medical history, manage your family health profile, and serve as your first point of contact for all health decisions, referrals, and follow-ups.',
  },
  {
    question: 'Are all doctors and nurses licensed?',
    answer: 'Yes. Every doctor and nurse on our team is fully licensed and verified. We maintain strict standards for all our medical professionals to ensure you always receive trusted, qualified care.',
  },
]

export default function FAQSection() {
  const [openIndex, setOpenIndex] = useState<number | null>(0)

  return (
    <section className="section-padding bg-white" aria-labelledby="faq-heading">
      <div className="container-max">
        <div className="grid lg:grid-cols-5 gap-16 items-start">
          {/* Left sticky heading */}
          <AnimatedSection className="lg:col-span-2 lg:sticky lg:top-28">
            <div className="section-tag bg-teal/10 text-teal mb-4">
              FAQ
            </div>
            <h2 id="faq-heading" className="text-3xl md:text-4xl lg:text-5xl font-extrabold text-navy leading-tight mb-6">
              Questions you might have
            </h2>
            <p className="text-base text-gray-500 leading-relaxed mb-8">
              We believe in full transparency. If you have a question not answered here, we&apos;re just a message away.
            </p>
            <a
              href="/contact"
              className="btn-primary inline-flex"
            >
              Ask Us Directly
            </a>
          </AnimatedSection>

          {/* FAQ accordion */}
          <div className="lg:col-span-3 space-y-3">
            {faqs.map(({ question, answer }, i) => (
              <AnimatedSection key={question} delay={i * 60} animation="fade-left">
                <div
                  className={`rounded-2xl border transition-all duration-300 overflow-hidden ${
                    openIndex === i
                      ? 'border-teal/30 bg-teal/5 shadow-soft'
                      : 'border-gray-100 bg-white hover:border-gray-200 hover:shadow-soft'
                  }`}
                >
                  <button
                    className="flex items-center justify-between w-full px-6 py-5 text-left"
                    onClick={() => setOpenIndex(openIndex === i ? null : i)}
                    aria-expanded={openIndex === i}
                  >
                    <span className={`font-semibold text-sm md:text-base pr-4 ${openIndex === i ? 'text-teal' : 'text-navy'}`}>
                      {question}
                    </span>
                    <div className={`w-7 h-7 rounded-full flex items-center justify-center flex-shrink-0 transition-colors duration-200 ${
                      openIndex === i ? 'bg-teal text-white' : 'bg-gray-100 text-gray-500'
                    }`}>
                      {openIndex === i ? <Minus size={14} /> : <Plus size={14} />}
                    </div>
                  </button>

                  <div
                    className="overflow-hidden transition-all duration-400 ease-in-out"
                    style={{
                      maxHeight: openIndex === i ? '400px' : '0px',
                    }}
                  >
                    <div className="px-6 pb-5">
                      <p className="text-sm md:text-base text-gray-600 leading-relaxed">
                        {answer}
                      </p>
                    </div>
                  </div>
                </div>
              </AnimatedSection>
            ))}
          </div>
        </div>
      </div>
    </section>
  )
}
