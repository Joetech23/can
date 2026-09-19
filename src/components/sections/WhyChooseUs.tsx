import AnimatedSection from '@/components/ui/AnimatedSection'
import { BadgeCheck, UserRound, MapPin, Network, HeartHandshake, ShieldCheck } from 'lucide-react'

const pillars = [
  {
    icon: BadgeCheck,
    title: 'Professional',
    description: 'Access appropriately qualified healthcare professionals and care staff.',
  },
  {
    icon: UserRound,
    title: 'Personal',
    description: 'Care is built around the individual and their needs.',
  },
  {
    icon: MapPin,
    title: 'Convenient',
    description: 'Access appropriate healthcare and care without always needing to travel.',
  },
  {
    icon: Network,
    title: 'Connected',
    description: 'Home care, doctors, nurses, telemedicine and clinical support brought together through one service.',
  },
  {
    icon: HeartHandshake,
    title: 'Compassionate',
    description: 'We treat every individual with dignity, respect and understanding.',
  },
  {
    icon: ShieldCheck,
    title: 'Trusted',
    description: 'A dedicated healthcare partner for individuals, families and families living abroad.',
  },
]

export default function WhyChooseUs() {
  return (
    <section id="why-us" className="section-padding section-bg-alt overflow-hidden scroll-mt-20" aria-labelledby="why-heading">
      <div className="container-max">
        <AnimatedSection className="text-center mb-14">
          <div className="section-tag bg-navy/10 text-navy mx-auto mb-4">
            Why Care Access Nigeria?
          </div>
          <h2 id="why-heading" className="text-3xl md:text-4xl lg:text-5xl font-extrabold text-navy leading-tight">
            More Than Care. <span className="text-teal">A Healthcare Partner.</span>
          </h2>
        </AnimatedSection>

        <div className="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
          {pillars.map(({ icon: Icon, title, description }, i) => (
            <AnimatedSection key={title} delay={i * 80}>
              <div className="group card h-full border-2 border-transparent hover:border-teal/40">
                <div className="w-12 h-12 rounded-xl bg-teal/10 flex items-center justify-center mb-5 transition-colors duration-300 group-hover:bg-teal">
                  <Icon size={22} className="text-teal transition-colors duration-300 group-hover:text-white" />
                </div>
                <h3 className="text-xl font-bold text-navy mb-2">{title}</h3>
                <p className="text-sm md:text-base text-gray-600 leading-relaxed">{description}</p>
              </div>
            </AnimatedSection>
          ))}
        </div>
      </div>
    </section>
  )
}
