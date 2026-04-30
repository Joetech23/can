import Image from 'next/image'
import AnimatedSection from '@/components/ui/AnimatedSection'
import { images } from '@/lib/utils'
import { CheckCircle2 } from 'lucide-react'

const points = [
  'A doctor who knows your full medical history',
  'Manages your family health profile completely',
  'Guides you to the right specialist every time',
  'Continuous care, not one-off consultations',
]

export default function TrustStatement() {
  return (
    <section className="section-padding bg-white" aria-labelledby="trust-heading">
      <div className="container-max">
        <div className="grid lg:grid-cols-2 gap-16 items-center">
          {/* Image side */}
          <AnimatedSection animation="fade-right" className="relative order-2 lg:order-1">
            <div className="relative rounded-3xl overflow-hidden aspect-[4/5] shadow-large">
              <Image
                src={images.personalDoctor}
                alt="Personal doctor — Care Access Nigeria"
                fill
                className="object-cover"
                sizes="(max-width: 1024px) 100vw, 50vw"
              />
              <div className="absolute inset-0 bg-gradient-to-t from-navy/30 to-transparent" />
            </div>

            {/* Floating badge */}
            <div className="absolute -bottom-4 -right-4 bg-white rounded-2xl shadow-large p-4 border border-gray-50">
              <div className="flex items-center gap-3">
                <div className="w-12 h-12 rounded-xl bg-teal/10 flex items-center justify-center">
                  <CheckCircle2 size={24} className="text-teal" />
                </div>
                <div>
                  <p className="font-bold text-navy text-sm">Dedicated to you</p>
                  <p className="text-xs text-gray-500">One doctor, for life</p>
                </div>
              </div>
            </div>

            {/* Top accent */}
            <div className="absolute -top-4 -left-4 bg-navy rounded-2xl shadow-large p-4">
              <p className="text-white text-sm font-bold">Personal Doctor</p>
              <p className="text-teal-300 text-xs mt-0.5">Always assigned to you</p>
            </div>
          </AnimatedSection>

          {/* Text side */}
          <AnimatedSection animation="fade-left" className="order-1 lg:order-2">
            <div className="section-tag bg-teal/10 text-teal mb-4">
              Our Difference
            </div>

            <h2 id="trust-heading" className="text-3xl md:text-4xl lg:text-5xl font-extrabold text-navy leading-tight mb-6">
              Healthcare that{' '}
              <span className="relative">
                knows you
                <svg className="absolute -bottom-1 left-0 w-full" viewBox="0 0 200 8" fill="none">
                  <path d="M0 4 Q50 0 100 4 Q150 8 200 4" stroke="#168ca2" strokeWidth="3" strokeLinecap="round" fill="none" />
                </svg>
              </span>
            </h2>

            <p className="text-base md:text-lg text-gray-600 leading-relaxed mb-8">
              Most telemedicine services ask you to scroll through profiles and guess which doctor you need. We do it differently. At Care Access Nigeria, you get a dedicated personal doctor who knows your medical history, manages your family&apos;s health, and guides you to the right specialist when you need one. This is continuous care, not a one-off consultation.
            </p>

            <ul className="space-y-4 mb-8">
              {points.map((point) => (
                <li key={point} className="flex items-start gap-3">
                  <div className="w-5 h-5 rounded-full bg-teal/10 flex items-center justify-center flex-shrink-0 mt-0.5">
                    <CheckCircle2 size={14} className="text-teal" />
                  </div>
                  <span className="text-sm md:text-base text-gray-700 font-medium">{point}</span>
                </li>
              ))}
            </ul>

            <div className="flex flex-col sm:flex-row gap-4">
              <a href="/about" className="btn-primary">
                How It Works
              </a>
              <a href="/become-a-member" className="btn-secondary">
                Join Today
              </a>
            </div>
          </AnimatedSection>
        </div>
      </div>
    </section>
  )
}
