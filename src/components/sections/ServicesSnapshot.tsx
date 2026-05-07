import AnimatedSection from '@/components/ui/AnimatedSection'
import { UserCheck, Video, Home, GitBranch, Phone, Siren } from 'lucide-react'

const services = [
  {
    icon: UserCheck,
    title: 'Dedicated Care Team',
    description: 'A dedicated care team that understands your medical history and manages your care continuously.',
    color: 'teal',
    bgColor: 'bg-teal/10',
    iconColor: 'text-teal',
    borderColor: 'hover:border-teal',
  },
  {
    icon: Video,
    title: 'Teleconsultation',
    description: 'Speak with a licensed doctor anytime you need to, by phone or video call.',
    color: 'navy',
    bgColor: 'bg-navy/10',
    iconColor: 'text-navy',
    borderColor: 'hover:border-navy',
  },
  {
    icon: Phone,
    title: '24/7 Nurse on Call',
    description: 'Immediate clinical advice at any time of day or night. For members only.',
    color: 'green',
    bgColor: 'bg-green/10',
    iconColor: 'text-green',
    borderColor: 'hover:border-green',
  },
  {
    icon: Home,
    title: 'Home Visits',
    description: 'Arrange an in-person nurse or doctor visit for yourself or family anywhere in Nigeria.',
    color: 'orange',
    bgColor: 'bg-orange/10',
    iconColor: 'text-orange',
    borderColor: 'hover:border-orange',
  },
  {
    icon: GitBranch,
    title: 'Care Coordination',
    description: 'We navigate referrals, hospitals, labs, and pharmacies so you never go it alone.',
    color: 'teal',
    bgColor: 'bg-teal/10',
    iconColor: 'text-teal',
    borderColor: 'hover:border-teal',
  },
  {
    icon: Siren,
    title: 'Urgent & Emergency',
    description: 'When you need immediate medical help, we coordinate ambulance dispatch and emergency hospital access fast.',
    color: 'orange',
    bgColor: 'bg-orange/10',
    iconColor: 'text-orange',
    borderColor: 'hover:border-orange',
  },
]

export default function ServicesSnapshot() {
  return (
    <section className="section-padding section-bg-alt" aria-labelledby="services-heading">
      <div className="container-max">
        <AnimatedSection className="text-center mb-14">
          <div className="section-tag bg-navy/10 text-navy mx-auto mb-4">
            What We Offer
          </div>
          <h2 id="services-heading" className="text-3xl md:text-4xl lg:text-5xl font-extrabold text-navy leading-tight mb-4">
            Everything you need to stay on top of{' '}
            <span className="text-teal">your health</span>
          </h2>
          <p className="text-base md:text-lg text-gray-500 max-w-2xl mx-auto">
            From immediate guidance to long-term health management, our full suite of services has you covered at every stage of your health journey.
          </p>
        </AnimatedSection>

        <div className="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
          {services.map(({ icon: Icon, title, description, bgColor, iconColor, borderColor }, i) => (
            <AnimatedSection key={title} delay={i * 80} animation="fade-up">
              <div className={`card border-2 border-transparent ${borderColor} transition-all duration-300 h-full`}>
                <div className={`w-12 h-12 rounded-xl ${bgColor} flex items-center justify-center mb-4`}>
                  <Icon size={22} className={iconColor} />
                </div>
                <h3 className="text-lg font-bold text-navy mb-2">{title}</h3>
                <p className="text-sm text-gray-600 leading-relaxed">{description}</p>
              </div>
            </AnimatedSection>
          ))}

        </div>
      </div>
    </section>
  )
}
