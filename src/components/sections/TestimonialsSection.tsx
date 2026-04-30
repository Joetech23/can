import AnimatedSection from '@/components/ui/AnimatedSection'
import { Quote } from 'lucide-react'

const testimonials = [
  {
    name: 'Adaeze O.',
    location: 'Lagos',
    role: 'Personal Care Member',
    quote:
      'Before Care Access, I was going to the pharmacy for every little thing. Now I just call my doctor and he actually knows my history. It makes such a difference.',
    initials: 'AO',
    color: 'bg-teal',
  },
  {
    name: 'Emeka T.',
    location: 'Abuja',
    role: 'Family Care Member',
    quote:
      'My wife had a health scare at 11pm. We called the nurse line and had a doctor advising us within minutes. We avoided an unnecessary ER trip. Worth every naira.',
    initials: 'ET',
    color: 'bg-navy',
  },
  {
    name: 'Funmi A.',
    location: 'Port Harcourt',
    role: 'Personal Care Member',
    quote:
      'Managing my blood pressure used to be stressful — juggling different doctors with no continuity. My Care Access doctor tracks everything in one place. I feel genuinely looked after.',
    initials: 'FA',
    color: 'bg-orange',
  },
 
]

export default function TestimonialsSection() {
  return (
    <section className="section-padding section-bg-alt overflow-hidden" aria-labelledby="testimonials-heading">
      <div className="container-max">
        <AnimatedSection className="text-center mb-14">
          <div className="section-tag bg-teal/10 text-teal mx-auto mb-4">
            Member Testimonials
          </div>
          <h2 id="testimonials-heading" className="text-3xl md:text-4xl lg:text-5xl font-extrabold text-navy leading-tight mb-4">
            Stories from the people{' '}
            <span className="text-teal">we cared for</span>
          </h2>
          <p className="text-base md:text-lg text-gray-500 max-w-xl mx-auto">
            Real experiences from members across Nigeria.
          </p>
        </AnimatedSection>

        <div className="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
          {testimonials.map(({ name, location, role, quote, initials, color }, i) => (
            <AnimatedSection key={name} delay={i * 80} animation="fade-up">
              <div className="bg-white rounded-2xl p-7 border border-gray-100 shadow-soft hover:shadow-medium transition-all duration-300 hover:-translate-y-1 h-full flex flex-col">
                {/* Quote icon */}
                <div className="mb-4">
                  <Quote size={28} className="text-teal/30 fill-teal/10" />
                </div>

                {/* Text */}
                <p className="text-sm md:text-base text-gray-600 leading-relaxed flex-1 mb-6">
                  &ldquo;{quote}&rdquo;
                </p>

                {/* Author */}
                <div className="flex items-center gap-3 pt-4 border-t border-gray-100">
                  <div className={`w-10 h-10 rounded-full ${color} flex items-center justify-center flex-shrink-0`}>
                    <span className="text-white text-xs font-bold">{initials}</span>
                  </div>
                  <div>
                    <p className="text-sm font-bold text-navy">{name}</p>
                    <p className="text-xs text-gray-400">{role} &middot; {location}</p>
                  </div>
                </div>
              </div>
            </AnimatedSection>
          ))}
        </div>
      </div>
    </section>
  )
}
