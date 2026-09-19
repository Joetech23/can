import AnimatedSection from '@/components/ui/AnimatedSection'
import { MessageSquare, ClipboardList, UserCheck, HeartPulse, LifeBuoy } from 'lucide-react'

const steps = [
  {
    icon: MessageSquare,
    title: 'Tell Us What You Need',
    description: 'Contact our team and tell us about your own or your loved one’s healthcare and care requirements.',
  },
  {
    icon: ClipboardList,
    title: 'We Understand Your Needs',
    description: 'We’ll discuss your requirements and determine the most appropriate type of support.',
  },
  {
    icon: UserCheck,
    title: 'We Arrange Your Care',
    description: 'We connect you with the appropriate nurse, carer, doctor or healthcare service.',
  },
  {
    icon: HeartPulse,
    title: 'Care Begins',
    description: 'Your care professional provides support according to the agreed plan.',
  },
  {
    icon: LifeBuoy,
    title: 'We’re Here When You Need Us',
    description: 'For ongoing care, telemedicine, clinical support or additional healthcare needs, we remain available to help coordinate your care.',
  },
]

export default function HowItWorks() {
  return (
    <section id="how-it-works" className="section-padding bg-white overflow-hidden scroll-mt-20" aria-labelledby="how-heading">
      <div className="container-max">
        <AnimatedSection className="text-center mb-14 md:mb-16">
          <div className="section-tag bg-teal/10 text-teal mx-auto mb-4">
            How It Works
          </div>
          <h2 id="how-heading" className="text-3xl md:text-4xl lg:text-5xl font-extrabold text-navy leading-tight">
            Getting Care Should Be <span className="text-teal">Simple</span>
          </h2>
        </AnimatedSection>

        <ol className="relative grid md:grid-cols-2 lg:grid-cols-5 gap-5">
          {/* Connecting line (desktop) */}
          <div className="hidden lg:block absolute top-7 left-[10%] right-[10%] h-px bg-gradient-to-r from-teal/10 via-teal/40 to-teal/10" aria-hidden="true" />

          {steps.map(({ icon: Icon, title, description }, i) => (
            <li key={title} className={i === steps.length - 1 ? 'md:col-span-2 lg:col-span-1' : ''}>
              <AnimatedSection delay={i * 100} className="h-full">
                <div className="relative h-full flex flex-col items-start lg:items-center lg:text-center rounded-2xl lg:rounded-none p-6 lg:p-0 bg-[#F5F8FC] lg:bg-transparent border border-gray-100 lg:border-0">
                  <div className="relative w-14 h-14 rounded-full bg-white border-2 border-teal/30 flex items-center justify-center mb-5 shadow-soft">
                    <Icon size={22} className="text-teal" />
                    <span className="absolute -top-1.5 -right-1.5 w-6 h-6 rounded-full bg-navy text-white text-[11px] font-black flex items-center justify-center">
                      {String(i + 1).padStart(2, '0')}
                    </span>
                  </div>
                  <h3 className="text-base md:text-lg font-bold text-navy mb-2 leading-snug">{title}</h3>
                  <p className="text-sm text-gray-600 leading-relaxed">{description}</p>
                </div>
              </AnimatedSection>
            </li>
          ))}
        </ol>
      </div>
    </section>
  )
}
