import AnimatedSection from '@/components/ui/AnimatedSection'
import { MessageSquare, Stethoscope, HeartPulse, ArrowRight } from 'lucide-react'

const steps = [
  {
    number: '01',
    icon: MessageSquare,
    title: 'Tell us what you need',
    description: 'Contact Care Access through our platform, Phone or Email. No long forms, no guessing who to speak to.',
    color: 'text-teal',
    bg: 'bg-teal',
    lightBg: 'bg-teal/10',
  },
  {
    number: '02',
    icon: Stethoscope,
    title: 'Get expert guidance',
    description: 'Speak with your dedicated personal doctor or a clinical nurse who understands your full health profile.',
    color: 'text-orange',
    bg: 'bg-orange',
    lightBg: 'bg-orange/10',
  },
  {
    number: '03',
    icon: HeartPulse,
    title: 'Get connected to the right care',
    description: 'Your personal licensed doctor refers you to the right specialist, follows up, and ensures you get the right outcome — not just the next available slot.',
    color: 'text-green',
    bg: 'bg-green',
    lightBg: 'bg-green/10',
  },
]

export default function HowItWorks() {
  return (
    <section className="section-padding bg-white overflow-hidden" aria-labelledby="how-heading">
      <div className="container-max">
        <AnimatedSection className="text-center mb-16">
          <div className="section-tag bg-teal/10 text-teal mx-auto mb-4">
            How It Works
          </div>
          <h2 id="how-heading" className="text-3xl md:text-4xl lg:text-5xl font-extrabold text-navy leading-tight mb-4">
            Getting care is easier{' '}
            <span className="text-teal">than you think</span>
          </h2>
          <p className="text-base md:text-lg text-gray-500 max-w-xl mx-auto">
            Three straightforward steps from first contact to the right care.
          </p>
        </AnimatedSection>

        {/* Steps */}
        <div className="relative">
          {/* Connecting line (desktop) */}
          <div className="hidden lg:block absolute top-16 left-[16.66%] right-[16.66%] h-0.5 bg-gradient-to-r from-teal via-orange to-green z-0" />

          <div className="grid md:grid-cols-3 gap-8 relative z-10">
            {steps.map(({ number, icon: Icon, title, description, bg, lightBg }, i) => (
              <AnimatedSection key={number} delay={i * 120} animation="fade-up">
                <div className="flex flex-col items-center text-center md:items-start md:text-left group">
                  {/* Step circle */}
                  <div className={`relative w-14 h-14 rounded-full ${lightBg} flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300`}>
                    <Icon size={24} className={bg.replace('bg-', 'text-')} />
                    <div className={`absolute -top-1 -right-1 w-5 h-5 ${bg} rounded-full flex items-center justify-center`}>
                      <span className="text-white text-xs font-black">{i + 1}</span>
                    </div>
                  </div>

                  {/* Step number label */}
                  <span className="text-4xl font-black text-gray-100 -mb-2 select-none">{number}</span>

                  <h3 className="text-lg md:text-xl font-bold text-navy mt-3 mb-3">{title}</h3>
                  <p className="text-sm md:text-base text-gray-600 leading-relaxed">{description}</p>

                  {/* Arrow (mobile) */}
                  {i < steps.length - 1 && (
                    <div className="md:hidden flex justify-center w-full my-4">
                      <div className="flex flex-col items-center gap-1">
                        <div className="w-px h-8 bg-gray-200" />
                        <ArrowRight size={18} className="text-gray-300 rotate-90" />
                      </div>
                    </div>
                  )}
                </div>
              </AnimatedSection>
            ))}
          </div>
        </div>

      </div>
    </section>
  )
}
