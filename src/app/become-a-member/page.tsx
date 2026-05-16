import type { Metadata } from 'next'
import Image from 'next/image'
import Link from 'next/link'
import AnimatedSection from '@/components/ui/AnimatedSection'
import PricingSection from '@/components/sections/PricingSection'
import HomeCareSection from '@/components/sections/HomeCareSection'
import { ArrowRight, Building2, CheckCircle2 } from 'lucide-react'
import { images } from '@/lib/utils'

export const metadata: Metadata = {
  title: 'Join Care Access Nigeria — Membership Plans',
  description:
    'Simple, reliable healthcare designed around you. Book a single consultation or get started with a dedicated care team, 24/7 clinical advice, and expert care coordination.',
  alternates: { canonical: 'https://careaccess.ng/become-a-member' },
  openGraph: {
    title: 'Join Care Access Nigeria',
    description: 'Simple, reliable healthcare designed around you. Plans from ₦25,000/month.',
    url: 'https://careaccess.ng/become-a-member',
  },
  twitter: {
    title: 'Join Care Access Nigeria',
    description: 'Simple, reliable healthcare designed around you. Plans from ₦25,000/month.',
  },
}

export default function BecomeAMemberPage() {
  return (
    <>
      {/* Hero */}
      <section
        className="relative pt-28 pb-28 md:pt-36 md:pb-36 overflow-hidden hero-gradient"
        aria-label="Membership hero"
      >
        <div className="absolute inset-0 bg-navy-mesh" />
        <div className="absolute -top-32 -right-32 w-96 h-96 rounded-full bg-teal/10 blur-3xl" />
        <div className="absolute bottom-0 left-0 right-0">
          <svg viewBox="0 0 1440 90" fill="none" preserveAspectRatio="none">
            <path d="M0 90L1440 90L1440 40C1200 90 900 0 720 0C540 0 240 90 0 40L0 90Z" fill="white" />
          </svg>
        </div>
        <div className="relative z-10 container-max text-center">
          <AnimatedSection>
            <div className="section-tag bg-teal/20 text-teal-200 mx-auto mb-5 uppercase tracking-widest text-xs font-bold">
              Simple, Reliable Healthcare
            </div>
            <h1 className="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-5 max-w-3xl mx-auto">
              Designed{' '}
              <span className="text-teal-300">Around You</span>
            </h1>
            <p className="text-base md:text-xl text-white/70 max-w-2xl mx-auto leading-relaxed">
              Choose a plan that gives you continuous access to care without the stress of traditional systems.
            </p>
          </AnimatedSection>
        </div>
      </section>

      {/* Plan cards + billing toggle (client component) */}
      <PricingSection />

      {/* For Organisations */}
      <section className="section-padding section-bg-alt" aria-labelledby="corporate-heading">
        <div className="container-max">
          <div className="bg-navy rounded-3xl p-10 md:p-14 grid lg:grid-cols-2 gap-12 items-center">
            <AnimatedSection animation="fade-right">
              <div className="flex items-center gap-3 mb-5">
                <div className="w-12 h-12 rounded-xl bg-teal/20 flex items-center justify-center">
                  <Building2 size={22} className="text-teal-300" />
                </div>
                <span className="text-teal-300 text-xs font-bold uppercase tracking-widest">For Organisations</span>
              </div>
              <h2 id="corporate-heading" className="text-3xl md:text-4xl font-extrabold text-white leading-tight mb-5">
                Healthcare access for your team
              </h2>
              <p className="text-white/70 leading-relaxed mb-8">
                We offer tailored healthcare access packages for businesses, NGOs, and corporate teams.
                Give your employees guided care support, teleconsultation, and 24/7 clinical advice
                as part of their benefits package. Healthier teams are more productive, more present,
                and more loyal.
              </p>
              <div className="space-y-3 mb-8">
                {[
                  'Scalable plans for any team size',
                  'Dedicated account management',
                  'Employee wellness reporting',
                  'Custom onboarding for your team',
                ].map((item) => (
                  <div key={item} className="flex items-center gap-2.5 text-sm text-white/70">
                    <CheckCircle2 size={15} className="text-teal-300 flex-shrink-0" />
                    {item}
                  </div>
                ))}
              </div>
              <Link
                href="/org-enquiry"
                className="inline-flex items-center gap-2 px-6 py-3.5 bg-teal text-white rounded-xl font-semibold text-sm hover:bg-teal-600 transition-all duration-200"
              >
                Submit Organisation Enquiry <ArrowRight size={16} />
              </Link>
            </AnimatedSection>

            <AnimatedSection animation="fade-left">
              <div className="relative rounded-2xl overflow-hidden aspect-[4/3] shadow-large">
                <Image
                  src={images.doctorVideoCall}
                  alt="Corporate healthcare partnership"
                  fill
                  className="object-cover"
                  sizes="50vw"
                />
              </div>
            </AnimatedSection>
          </div>
        </div>
      </section>

      {/* Home Care Support */}
      <HomeCareSection />

      {/* Final CTA */}
      <section className="relative py-24 overflow-hidden bg-white" aria-label="Final CTA">
        <div className="absolute inset-0 bg-mesh" />
        <div className="relative z-10 container-max text-center">
          <AnimatedSection>
            <div className="section-tag bg-teal/10 text-teal mx-auto mb-5">
              Ready to begin?
            </div>
            <h2 className="text-3xl md:text-4xl lg:text-5xl font-extrabold text-navy leading-tight mb-6 max-w-2xl mx-auto">
              Start your care today
            </h2>
            <p className="text-base md:text-lg text-gray-500 max-w-xl mx-auto mb-10">
              Whether for yourself, your family, or your team, we’re here to support you.
            </p>
            <div className="flex flex-col sm:flex-row gap-4 justify-center mb-6">
              <Link href="/signup" className="btn-primary">
                Get Started Today <ArrowRight size={16} />
              </Link>
              <Link href="/book" className="btn-secondary">
                Book a Consultation
              </Link>
            </div>
            <Link
              href="/request-care"
              className="inline-flex items-center gap-2 text-sm font-semibold text-teal hover:text-teal-600 transition-colors duration-200 underline underline-offset-4"
            >
              Already a member? Request additional care <ArrowRight size={14} />
            </Link>
          </AnimatedSection>
        </div>
      </section>
    </>
  )
}
