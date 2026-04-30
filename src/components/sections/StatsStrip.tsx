import AnimatedSection from '@/components/ui/AnimatedSection'
import { Users, Clock, Star, Building2 } from 'lucide-react'

const stats = [
  { icon: Users, value: '10,000+', label: 'Members Served' },
  { icon: Clock, value: '24/7', label: 'Nurse Availability' },
  { icon: Star, value: '98%', label: 'Satisfaction Rate' },
  { icon: Building2, value: '50+', label: 'Partner Hospitals' },
]

export default function StatsStrip() {
  return (
    <section className="py-10 bg-white relative -mt-px" aria-label="Key statistics">
      <div className="container-max">
        <div className="grid grid-cols-2 lg:grid-cols-4 gap-6">
          {stats.map(({ icon: Icon, value, label }, i) => (
            <AnimatedSection key={label} delay={i * 80} animation="fade-up">
              <div className="flex flex-col sm:flex-row items-center sm:items-start gap-3 p-4">
                <div className="w-10 h-10 rounded-xl bg-teal/10 flex items-center justify-center flex-shrink-0">
                  <Icon size={18} className="text-teal" />
                </div>
                <div className="text-center sm:text-left">
                  <p className="text-2xl md:text-3xl font-extrabold text-navy">{value}</p>
                  <p className="text-xs text-gray-500 font-medium mt-0.5">{label}</p>
                </div>
              </div>
            </AnimatedSection>
          ))}
        </div>
      </div>
    </section>
  )
}
