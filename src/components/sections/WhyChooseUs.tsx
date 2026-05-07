import AnimatedSection from '@/components/ui/AnimatedSection'
import { CheckCircle2 } from 'lucide-react'

const reasons = [
  'Avoid long hospital queues and delays',
  'Stop guessing medication or self-treating',
  'Get clear advice during urgent situations',
  'Manage long-term conditions with consistent support',
  'Have a trusted medical team available when you need it',
]

const offerings = [
  'Access to doctor consultations when needed',
  '24/7 nurse-led clinical advice',
  'A complete, secure medical record',
  'Follow-ups when clinically required',
  'Prescription and medication guidance',
  'Lab test coordination and result interpretation',
  'Specialist referrals and care navigation',
]

export default function WhyChooseUs() {
  return (
    <section className="section-padding bg-white overflow-hidden" aria-labelledby="why-heading">
      <div className="container-max">
        <div className="grid lg:grid-cols-2 gap-8">

          {/* Card 1 — Why People Choose */}
          <AnimatedSection animation="fade-right">
            <div className="bg-navy rounded-3xl p-8 md:p-10 h-full flex flex-col">
              <div className="section-tag bg-white/10 text-teal-300 mb-5 self-start">
                Why People Choose Care Access
              </div>
              <h2 id="why-heading" className="text-2xl md:text-3xl font-extrabold text-white leading-tight mb-3">
                Healthcare should not be stressful.
              </h2>
              <p className="text-white/60 text-sm mb-8">We make it simple.</p>

              <ul className="space-y-4 flex-1">
                {reasons.map((reason) => (
                  <li key={reason} className="flex items-start gap-3">
                    <CheckCircle2 size={17} className="text-teal-300 flex-shrink-0 mt-0.5" />
                    <span className="text-sm text-white/80 leading-snug">{reason}</span>
                  </li>
                ))}
              </ul>
            </div>
          </AnimatedSection>

          {/* Card 2 — What You Get */}
          <AnimatedSection animation="fade-left">
            <div className="bg-[#F5F8FC] rounded-3xl p-8 md:p-10 h-full flex flex-col border border-gray-100">
              <div className="section-tag bg-teal/10 text-teal mb-5 self-start">
                What You Get
              </div>
              <h2 className="text-2xl md:text-3xl font-extrabold text-navy leading-tight mb-3">
                Continuous care,
              </h2>
              <p className="text-gray-500 text-sm mb-8">not just consultations.</p>

              <ul className="space-y-4 flex-1">
                {offerings.map((item) => (
                  <li key={item} className="flex items-start gap-3">
                    <CheckCircle2 size={17} className="text-teal flex-shrink-0 mt-0.5" />
                    <span className="text-sm text-gray-600 leading-snug">{item}</span>
                  </li>
                ))}
              </ul>

              <p className="mt-8 text-sm text-teal font-semibold border-t border-gray-200 pt-5">
                You are supported at every step — not just when you&apos;re unwell.
              </p>
            </div>
          </AnimatedSection>

        </div>
      </div>
    </section>
  )
}
