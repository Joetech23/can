import type { Metadata } from 'next'
import HeroSection from '@/components/sections/HeroSection'
import ServicesOverview from '@/components/sections/ServicesOverview'
import CareAtHome from '@/components/sections/CareAtHome'
import LovedOneSection from '@/components/sections/LovedOneSection'
import HowItWorks from '@/components/sections/HowItWorks'
import WhyChooseUs from '@/components/sections/WhyChooseUs'
import TrustAssociations from '@/components/sections/TrustAssociations'
import RegisteredCompany from '@/components/sections/RegisteredCompany'
import MissionSection from '@/components/sections/MissionSection'
import ClosingCTA from '@/components/sections/ClosingCTA'

export const metadata: Metadata = {
  title: 'Care Access Nigeria | Professional Home Care. Connected Healthcare.',
  description:
    'Professional home care across Nigeria. Qualified nurses, carers and doctors at home, plus telemedicine, care coordination and clinical support when you need it.',
  alternates: {
    canonical: 'https://careaccess.ng',
  },
}

export default function HomePage() {
  return (
    <>
      <HeroSection />
      <ServicesOverview />
      <CareAtHome />
      <LovedOneSection />
      <HowItWorks />
      <WhyChooseUs />
      <TrustAssociations />
      <RegisteredCompany />
      <MissionSection />
      <ClosingCTA />
    </>
  )
}
