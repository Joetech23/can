import Link from 'next/link'
import AnimatedSection from '@/components/ui/AnimatedSection'
import { CheckCircle2, ArrowRight, Star } from 'lucide-react'

const plans = [
  {
    name: 'Care Access Core',
    price: '18,000',
    description: 'Essential access to professional guidance when you need quick clarity on your health.',
    features: [
      'Nurse consultations (limited sessions)',
      'Limited doctor consultations',
      'Basic care guidance',
      'Support for everyday health concerns',
    ],
    cta: 'Get Started',
    href: 'https://careaccess.ng/product/care-access-core-18000-month/',
    popular: false,
    colorScheme: 'light',
  },
  {
    name: 'Care Access Plus',
    price: '25,000',
    description: 'A balanced plan for individuals who want consistent access to care and ongoing support.',
    features: [
      'Unlimited nurse consultations',
      'Up to 4 doctor consultations monthly',
      'Ongoing care and condition support',
      'Extended follow-up care',
      'Priority response',
    ],
    cta: 'Choose Plus',
    href: 'https://careaccess.ng/#',
    popular: true,
    colorScheme: 'teal',
  },
  {
    name: 'Care Access Family',
    price: '40,000',
    description: 'Comprehensive care support designed for families who want shared access and peace of mind.',
    features: [
      'Covers up to 4 family members',
      'Unlimited nurse access (shared)',
      'Up to 6 doctor consultations monthly',
      'Family-wide care support',
      'Full care coordination',
    ],
    cta: 'Choose Family',
    href: 'https://careaccess.ng/#',
    popular: false,
    colorScheme: 'navy',
  },
]

export default function PricingSnapshot() {
  return (
    <section className="section-padding section-bg-alt" aria-labelledby="pricing-heading">
      <div className="container-max">
        <AnimatedSection className="text-center mb-14">
          <div className="section-tag bg-orange/10 text-orange mx-auto mb-4">
            Membership Plans
          </div>
          <h2 id="pricing-heading" className="text-3xl md:text-4xl lg:text-5xl font-extrabold text-navy leading-tight mb-4">
            Choose a plan that{' '}
            <span className="text-teal">works for you</span>
          </h2>
          <p className="text-base md:text-lg text-gray-500 max-w-xl mx-auto">
            Simple, transparent pricing. No hidden costs, no lock-in. Cancel before your next billing date.
          </p>
        </AnimatedSection>

        <div className="grid md:grid-cols-3 gap-6 lg:gap-8">
          {plans.map(({ name, price, description, features, cta, href, popular, colorScheme }, i) => (
            <AnimatedSection key={name} delay={i * 100} animation="fade-up">
              <div
                className={`relative rounded-2xl p-7 h-full flex flex-col transition-all duration-300 hover:-translate-y-2 ${
                  popular
                    ? 'bg-teal text-white shadow-teal scale-105 z-10'
                    : colorScheme === 'navy'
                    ? 'bg-navy text-white shadow-navy'
                    : 'bg-white border border-gray-100 shadow-soft'
                }`}
              >
                {/* Popular badge */}
                {popular && (
                  <div className="absolute -top-3.5 left-1/2 -translate-x-1/2">
                    <div className="flex items-center gap-1.5 px-4 py-1.5 bg-orange text-white text-xs font-bold rounded-full shadow-lg">
                      <Star size={11} fill="currentColor" />
                      Most Popular
                    </div>
                  </div>
                )}

                {/* Plan name */}
                <div className="mb-5">
                  <h3 className={`text-lg font-bold mb-1 ${popular ? 'text-white' : colorScheme === 'navy' ? 'text-white' : 'text-navy'}`}>
                    {name}
                  </h3>
                  <p className={`text-sm leading-relaxed ${popular || colorScheme === 'navy' ? 'text-white/70' : 'text-gray-500'}`}>
                    {description}
                  </p>
                </div>

                {/* Price */}
                <div className="mb-6 pb-6 border-b border-current/10">
                  <div className="flex items-end gap-1">
                    <span className={`text-sm font-medium mb-1.5 ${popular || colorScheme === 'navy' ? 'text-white/70' : 'text-gray-400'}`}>₦</span>
                    <span className="text-4xl font-extrabold">{price}</span>
                    <span className={`text-sm mb-1.5 ${popular || colorScheme === 'navy' ? 'text-white/70' : 'text-gray-400'}`}>/month</span>
                  </div>
                  <p className={`text-xs mt-1 ${popular || colorScheme === 'navy' ? 'text-white/50' : 'text-gray-400'}`}>
                    No lock-in. Cancel anytime.
                  </p>
                </div>

                {/* Features */}
                <ul className="space-y-3 flex-1 mb-7">
                  {features.map((feature) => (
                    <li key={feature} className="flex items-start gap-2.5">
                      <CheckCircle2
                        size={16}
                        className={`flex-shrink-0 mt-0.5 ${
                          popular ? 'text-white' : colorScheme === 'navy' ? 'text-teal-300' : 'text-teal'
                        }`}
                      />
                      <span className={`text-sm ${popular || colorScheme === 'navy' ? 'text-white/80' : 'text-gray-600'}`}>
                        {feature}
                      </span>
                    </li>
                  ))}
                </ul>

                {/* CTA */}
                <a
                  href={href}
                  className={`w-full py-3.5 rounded-xl font-semibold text-sm text-center transition-all duration-200 ${
                    popular
                      ? 'bg-white text-teal hover:bg-gray-50'
                      : colorScheme === 'navy'
                      ? 'bg-teal text-white hover:bg-teal-600'
                      : 'bg-navy text-white hover:bg-navy-600'
                  }`}
                >
                  {cta}
                </a>
              </div>
            </AnimatedSection>
          ))}
        </div>

        {/* Bottom links */}
        <AnimatedSection delay={400} animation="fade-up" className="text-center mt-10 flex flex-col sm:flex-row gap-4 justify-center">
          <Link href="/become-a-member" className="btn-primary">
            Become a Member <ArrowRight size={16} />
          </Link>
          <Link href="/services" className="btn-secondary">
            Compare Plans in Detail
          </Link>
        </AnimatedSection>

        <p className="text-center text-xs text-gray-400 mt-6">
          Consultations are not unlimited. Session limits apply per plan. See full plan details on the Services page.
        </p>
      </div>
    </section>
  )
}
