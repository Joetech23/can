import AnimatedSection from '@/components/ui/AnimatedSection'
import { ShieldCheck, Clock, Lock, Heart } from 'lucide-react'

const signals = [
  { icon: ShieldCheck, text: 'Licensed clinicians' },
  { icon: Clock,       text: '24/7 Emergency Guidance' },
  { icon: Lock,        text: 'Secure records' },
  { icon: Heart,       text: 'Trusted care' },
]

export default function StatsStrip() {
  return (
    <section className="py-8 bg-white border-b border-gray-100 relative -mt-px" aria-label="Trust signals">
      <div className="container-max">
        <div className="grid grid-cols-2 lg:grid-cols-4 gap-4">
          {signals.map(({ icon: Icon, text }, i) => (
            <AnimatedSection key={text} delay={i * 80} animation="fade-up">
              <div className="flex flex-col sm:flex-row items-center sm:items-center gap-3 p-4">
                <div className="w-10 h-10 rounded-xl bg-teal/10 flex items-center justify-center flex-shrink-0">
                  <Icon size={18} className="text-teal" />
                </div>
                <div className="text-center sm:text-left">
                  <p className="text-sm md:text-base font-semibold text-navy">{text}</p>
                </div>
              </div>
            </AnimatedSection>
          ))}
        </div>
      </div>
    </section>
  )
}
