import Link from 'next/link'
import AnimatedSection from '@/components/ui/AnimatedSection'
import { User, Building2, ArrowRight, Heart, Briefcase } from 'lucide-react'

const audiences = [
  {
    icon: User,
    label: 'Individuals & Families',
    headline: 'Peace of mind for you and everyone you love',
    description: 'Whether you need quick advice or full ongoing health management, we help you stay on top of your health without the confusion.',
    cta: 'Get Started',
    href: '/become-a-member',
    colorScheme: 'teal',
    icon2: Heart,
  },
  {
    icon: Building2,
    label: 'Corporate Organisations',
    headline: 'Invest in your team\'s health and productivity',
    description: 'Give your employees access to expert medical guidance and teleconsultation as part of their wellness benefits. Healthier teams are more productive and more loyal.',
    cta: 'Partner With Us',
    href: '/contact',
    colorScheme: 'navy',
    icon2: Briefcase,
  },
]

export default function WhoWeServe() {
  return (
    <section className="section-padding section-bg-alt" aria-labelledby="serve-heading">
      <div className="container-max">
        <AnimatedSection className="text-center mb-14">
          <div className="section-tag bg-navy/10 text-navy mx-auto mb-4">
            Who We Serve
          </div>
          <h2 id="serve-heading" className="text-3xl md:text-4xl lg:text-5xl font-extrabold text-navy leading-tight mb-4">
            Built for people who{' '}
            <span className="text-teal">value their health</span>
          </h2>
          <p className="text-base md:text-lg text-gray-500 max-w-xl mx-auto">
            Whether you are looking after your family or your company&apos;s team, we have a care model designed around your needs.
          </p>
        </AnimatedSection>

        <div className="grid md:grid-cols-2 gap-6 max-w-3xl mx-auto">
          {audiences.map(({ icon: Icon, label, headline, description, cta, href, colorScheme }, i) => (
            <AnimatedSection key={label} delay={i * 150} animation="fade-up">
              <div
                className={`rounded-2xl p-7 h-full flex flex-col transition-all duration-300 hover:-translate-y-1 hover:shadow-large ${
                  colorScheme === 'teal'
                    ? 'bg-gradient-to-br from-teal to-teal-700 text-white'
                    : 'bg-gradient-to-br from-navy to-navy-700 text-white'
                }`}
              >
                <div className="flex items-center gap-3 mb-5">
                  <div className="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center">
                    <Icon size={20} className="text-white" />
                  </div>
                  <span className="text-xs font-semibold text-white/70 uppercase tracking-wider">{label}</span>
                </div>

                <h3 className="text-xl font-extrabold text-white leading-tight mb-3">
                  {headline}
                </h3>
                <p className="text-sm text-white/70 leading-relaxed mb-6 flex-1">
                  {description}
                </p>

                <Link
                  href={href}
                  className={`inline-flex items-center gap-2 px-5 py-2.5 rounded-xl font-semibold text-sm transition-all duration-200 w-fit ${
                    colorScheme === 'teal'
                      ? 'bg-white text-teal hover:bg-gray-50'
                      : 'bg-teal text-white hover:bg-teal-600'
                  }`}
                >
                  {cta} <ArrowRight size={14} />
                </Link>
              </div>
            </AnimatedSection>
          ))}
        </div>
      </div>
    </section>
  )
}
