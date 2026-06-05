import type { Metadata } from 'next'
import HeroSection from '@/components/sections/HeroSection'
import EmergencyBanner from '@/components/sections/EmergencyBanner'
import StatsStrip from '@/components/sections/StatsStrip'
import ServicesSnapshot from '@/components/sections/ServicesSnapshot'
import HowItWorks from '@/components/sections/HowItWorks'
import WhyChooseUs from '@/components/sections/WhyChooseUs'
import TrustAssociations from '@/components/sections/TrustAssociations'
import RegisteredCompany from '@/components/sections/RegisteredCompany'
import TestimonialsSection from '@/components/sections/TestimonialsSection'

export const metadata: Metadata = {
  title: 'Care Access Nigeria | Clear, Reliable Care When You Need It',
  description:
    'Care Access Nigeria gives you a dedicated care team, 24/7 clinical advice, teleconsultation, home visits, and expert care coordination — delivered with transparency and trust.',
  alternates: {
    canonical: 'https://careaccess.ng',
  },
}

export default function HomePage() {
  return (
    <>
      <HeroSection />
      <EmergencyBanner />
      <StatsStrip />
      <ServicesSnapshot />
      <HowItWorks />
      <WhyChooseUs />
      <TrustAssociations />
      <RegisteredCompany />
      <TestimonialsSection />
    </>
  )
}
