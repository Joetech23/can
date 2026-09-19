import type { Metadata } from 'next'
import AnimatedSection from '@/components/ui/AnimatedSection'
import MissionSection from '@/components/sections/MissionSection'
import CareAtHome from '@/components/sections/CareAtHome'
import WhyChooseUs from '@/components/sections/WhyChooseUs'
import TrustAssociations from '@/components/sections/TrustAssociations'
import RegisteredCompany from '@/components/sections/RegisteredCompany'
import ClosingCTA from '@/components/sections/ClosingCTA'

export const metadata: Metadata = {
  title: 'About Us',
  description:
    'Care Access Nigeria makes quality healthcare and professional home care more accessible to individuals and families across Nigeria.',
  alternates: {
    canonical: 'https://careaccess.ng/about',
  },
}

export default function AboutPage() {
  return (
    <>
      {/* Hero */}
      <section className="relative pt-28 pb-28 md:pt-36 md:pb-36 overflow-hidden hero-gradient" aria-label="About hero">
        <div className="absolute inset-0 bg-navy-mesh" />
        <div className="absolute bottom-0 left-0 right-0">
          <svg viewBox="0 0 1440 90" fill="none" preserveAspectRatio="none">
            <path d="M0 90L1440 90L1440 40C1200 90 900 0 720 0C540 0 240 90 0 40L0 90Z" fill="white" />
          </svg>
        </div>
        <div className="relative z-10 container-max text-center">
          <AnimatedSection>
            <div className="section-tag bg-teal/20 text-teal-200 mx-auto mb-5">About Us</div>
            <h1 className="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-6 max-w-4xl mx-auto">
              Professional Home Care.{' '}
              <span className="text-teal-300">Connected Healthcare.</span>
            </h1>
            <p className="text-base md:text-xl text-white/75 max-w-2xl mx-auto leading-relaxed">
              Care Access Nigeria connects individuals and families with qualified nurses, carers and
              doctors across Nigeria, and helps them access the right healthcare at the right time.
            </p>
          </AnimatedSection>
        </div>
      </section>

      <MissionSection />
      <CareAtHome />
      <WhyChooseUs />
      <TrustAssociations />
      <RegisteredCompany />
      <ClosingCTA />
    </>
  )
}
