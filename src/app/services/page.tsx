import type { Metadata } from 'next'
import Link from 'next/link'
import AnimatedSection from '@/components/ui/AnimatedSection'
import ServicesOverview from '@/components/sections/ServicesOverview'
import HowItWorks from '@/components/sections/HowItWorks'
import ClosingCTA from '@/components/sections/ClosingCTA'
import { services } from '@/lib/content'

export const metadata: Metadata = {
  title: 'Our Services',
  description:
    'Home care services, telemedicine and care coordination, and clinical and emergency support from Care Access Nigeria. Qualified nurses, carers and doctors across Nigeria.',
  alternates: {
    canonical: 'https://careaccess.ng/services',
  },
}

export default function ServicesPage() {
  return (
    <>
      {/* Hero */}
      <section className="relative pt-28 pb-20 md:pt-36 md:pb-28 overflow-hidden hero-gradient" aria-label="Services hero">
        <div className="absolute inset-0 bg-navy-mesh" />
        <div className="absolute bottom-0 left-0 right-0">
          <svg viewBox="0 0 1440 60" fill="none" preserveAspectRatio="none">
            <path d="M0 60L1440 60L1440 20C1200 60 900 0 720 0C540 0 240 60 0 20L0 60Z" fill="white" />
          </svg>
        </div>
        <div className="relative z-10 container-max text-center">
          <AnimatedSection>
            <div className="section-tag bg-teal/20 text-teal-200 mx-auto mb-5">Our Services</div>
            <h1 className="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-6 max-w-4xl mx-auto">
              Care That <span className="text-teal-300">Comes to You</span>
            </h1>
            <p className="text-base md:text-xl text-white/70 max-w-2xl mx-auto leading-relaxed mb-10">
              Whether you need ongoing support at home, access to a doctor remotely or professional
              guidance during an urgent situation, Care Access Nigeria is here to help.
            </p>

            <nav aria-label="Jump to a service" className="flex flex-wrap justify-center gap-3">
              {services.map((s) => (
                <Link
                  key={s.id}
                  href={`#${s.id}`}
                  className="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white/10 border border-white/15 text-sm font-semibold text-white/85 hover:bg-white hover:text-navy transition-all duration-200"
                >
                  <span className="text-teal-300 font-black">{s.number}</span>
                  {s.name}
                </Link>
              ))}
            </nav>
          </AnimatedSection>
        </div>
      </section>

      <ServicesOverview showIntro={false} />
      <HowItWorks />
      <ClosingCTA />
    </>
  )
}
