import AnimatedSection from '@/components/ui/AnimatedSection'
import { CheckCircle2, HeartPulse, HandHeart, Stethoscope } from 'lucide-react'

const whoWeSupport = [
  'Older adults',
  'People recovering from illness or surgery',
  'People living with long-term conditions',
  'People requiring nursing care',
  'People who need assistance with daily activities',
  'Individuals requiring post-hospital support',
  'Families caring for loved ones',
  'Individuals who prefer appropriate care at home',
]

const professionals = [
  {
    icon: HeartPulse,
    title: 'Nurses',
    description: 'For clinical nursing care, monitoring and healthcare support.',
  },
  {
    icon: HandHeart,
    title: 'Carers',
    description: 'For personal care, daily living support, companionship and practical assistance.',
  },
  {
    icon: Stethoscope,
    title: 'Doctors',
    description: 'For appropriate medical assessments, consultations and home visits.',
  },
]

export default function CareAtHome() {
  return (
    <section id="care-at-home" className="section-padding section-bg-alt scroll-mt-20" aria-labelledby="care-at-home-heading">
      <div className="container-max">
        <div className="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center mb-16 md:mb-20">
          <AnimatedSection animation="fade-right">
            <div className="section-tag bg-teal/10 text-teal mb-4">Home Care</div>
            <h2 id="care-at-home-heading" className="text-3xl md:text-4xl lg:text-5xl font-extrabold text-navy leading-tight mb-6">
              Care That <span className="text-teal">Starts at Home</span>
            </h2>
            <div className="space-y-4">
              <p className="text-base md:text-lg text-navy font-semibold leading-relaxed">
                Home is often where people feel safest, most comfortable and most independent.
              </p>
              <p className="text-base md:text-lg text-gray-600 leading-relaxed">
                Care Access Nigeria brings professional healthcare and personal support into that
                environment.
              </p>
              <p className="text-base md:text-lg text-gray-600 leading-relaxed">
                We work with individuals and families to understand their needs and arrange the
                appropriate level of care.
              </p>
            </div>
          </AnimatedSection>

          <AnimatedSection animation="fade-left">
            <div className="rounded-3xl bg-white border border-gray-100 shadow-soft p-7 md:p-9">
              <h3 className="text-lg md:text-xl font-extrabold text-navy mb-2">Who We Support</h3>
              <p className="text-sm text-gray-500 mb-6">Our home care services can support:</p>
              <ul className="grid sm:grid-cols-2 gap-x-6 gap-y-3.5">
                {whoWeSupport.map((item) => (
                  <li key={item} className="flex items-start gap-2.5">
                    <CheckCircle2 size={16} className="text-teal flex-shrink-0 mt-0.5" />
                    <span className="text-sm text-gray-700 leading-snug">{item}</span>
                  </li>
                ))}
              </ul>
            </div>
          </AnimatedSection>
        </div>

        {/* Care professionals */}
        <AnimatedSection className="mb-8">
          <h3 className="text-2xl md:text-3xl font-extrabold text-navy text-center">Our Care Professionals</h3>
        </AnimatedSection>

        <div className="grid md:grid-cols-3 gap-6">
          {professionals.map(({ icon: Icon, title, description }, i) => (
            <AnimatedSection key={title} delay={i * 100}>
              <div className="card h-full">
                <div className="w-12 h-12 rounded-xl bg-teal/10 flex items-center justify-center mb-5">
                  <Icon size={22} className="text-teal" />
                </div>
                <h4 className="text-xl font-bold text-navy mb-2">{title}</h4>
                <p className="text-sm md:text-base text-gray-600 leading-relaxed">{description}</p>
              </div>
            </AnimatedSection>
          ))}
        </div>
      </div>
    </section>
  )
}
