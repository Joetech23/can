import AnimatedSection from '@/components/ui/AnimatedSection'
import { MessageSquare, Stethoscope, HeartPulse, ArrowRight } from 'lucide-react'

const steps = [
  {
    number: '01',
    icon: MessageSquare,
    title: 'Request care',
    description: 'Tell us what you need — whether it\'s a new concern, a follow-up, or urgent advice.',
    color: 'text-teal',
    bg: 'bg-teal',
    lightBg: 'bg-teal/10',
  },
  {
    number: '02',
    icon: Stethoscope,
    title: 'Speak to a clinician',
    description: 'Our nurses and doctors review your case and provide clear, professional guidance.',
    color: 'text-orange',
    bg: 'bg-orange',
    lightBg: 'bg-orange/10',
  },
  {
    number: '03',
    icon: HeartPulse,
    title: 'Get the right care',
    description: 'Receive treatment, prescriptions, or referrals — and ongoing support when needed.',
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
            Simple, guided care{' '}
            <span className="text-teal">from start to finish</span>
          </h2>
        </AnimatedSection>

        {/* Steps */}
        <div className="relative">
          <div className="grid md:grid-cols-3 gap-8 relative z-10">
            {steps.map(({ number, icon: Icon, title, description, bg, lightBg }, i) => (
              <div key={number}>
                <AnimatedSection delay={i * 120} animation="fade-up">
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
                  </div>
                </AnimatedSection>

                {/* Arrow between steps (desktop) */}
                {i < steps.length - 1 && (
                  <div className="hidden md:flex absolute top-7 -right-5 z-20 pointer-events-none">
                    <div className="flex items-center justify-center w-10 h-10 rounded-full bg-white border-2 border-gray-300">
                      <ArrowRight size={18} className="text-gray-400" />
                    </div>
                  </div>
                )}

                {/* Arrow between steps (mobile) */}
                {i < steps.length - 1 && (
                  <div className="md:hidden flex justify-center w-full my-4">
                    <div className="flex flex-col items-center gap-1">
                      <div className="w-px h-8 bg-gray-200" />
                      <ArrowRight size={18} className="text-gray-300 rotate-90" />
                    </div>
                  </div>
                )}
              </div>
            ))}
          </div>
        </div>
      </div>
    </section>
  )
}
