import type { Metadata } from 'next'
import Link from 'next/link'
import AnimatedSection from '@/components/ui/AnimatedSection'
import FAQAccordion from '@/components/sections/FAQAccordion'
import { ArrowRight } from 'lucide-react'

export const metadata: Metadata = {
  title: 'FAQ — Frequently Asked Questions',
  description:
    'Find answers to common questions about Care Access Nigeria membership plans, consultations, data privacy, and corporate packages.',
  alternates: { canonical: 'https://careaccess.ng/faq' },
}

export default function FAQPage() {
  return (
    <>
      {/* Hero */}
      <section className="relative pt-28 pb-28 md:pt-36 md:pb-36 overflow-hidden hero-gradient" aria-label="FAQ hero">
        <div className="absolute inset-0 bg-navy-mesh" />
        <div className="absolute bottom-0 left-0 right-0">
          <svg viewBox="0 0 1440 90" fill="none" preserveAspectRatio="none">
            <path d="M0 90L1440 90L1440 40C1200 90 900 0 720 0C540 0 240 90 0 40L0 90Z" fill="white" />
          </svg>
        </div>
        <div className="relative z-10 container-max text-center">
          <AnimatedSection>
            <div className="section-tag bg-teal/20 text-teal-200 mx-auto mb-5">
              FAQ
            </div>
            <h1 className="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-6 max-w-3xl mx-auto">
              Frequently Asked{' '}
              <span className="text-teal-300">Questions</span>
            </h1>
            <p className="text-base md:text-xl text-white/70 max-w-2xl mx-auto leading-relaxed">
              Everything you need to know about Care Access Nigeria.
              Can&apos;t find your answer? Reach out and we&apos;ll help.
            </p>
          </AnimatedSection>
        </div>
      </section>

      {/* FAQ content */}
      <section className="section-padding bg-white relative -mt-px" aria-label="FAQ list">
        <div className="container-max max-w-4xl">
          <FAQAccordion />

          {/* Still have questions */}
          <AnimatedSection delay={400} animation="fade-up">
            <div className="rounded-3xl bg-navy p-10 text-center">
              <h3 className="text-2xl font-extrabold text-white mb-3">Still have questions?</h3>
              <p className="text-white/70 mb-7 max-w-md mx-auto text-sm leading-relaxed">
                Our team is always happy to help. Reach out and we&apos;ll get back to you within one business day.
              </p>
              <Link
                href="/contact"
                className="inline-flex items-center gap-2 px-7 py-3.5 bg-teal text-white font-semibold rounded-xl text-sm hover:bg-teal-600 transition-all duration-200 hover:-translate-y-0.5"
              >
                Contact Us <ArrowRight size={16} />
              </Link>
            </div>
          </AnimatedSection>
        </div>
      </section>
    </>
  )
}
