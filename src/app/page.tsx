import type { Metadata } from 'next'
import HeroSection from '@/components/sections/HeroSection'
import StatsStrip from '@/components/sections/StatsStrip'
import ServicesSnapshot from '@/components/sections/ServicesSnapshot'
import HowItWorks from '@/components/sections/HowItWorks'
import TestimonialsSection from '@/components/sections/TestimonialsSection'

export const metadata: Metadata = {
  title: 'Care Access Nigeria | Your Personal Doctor, Always Within Reach',
  description:
    'Care Access Nigeria gives every member a dedicated personal doctor, 24/7 nurse access, teleconsultation, home visits, and expert care coordination. Healthcare made personal.',
  alternates: {
    canonical: 'https://careaccess.ng',
  },
}

export default function HomePage() {
  return (
    <>
      <HeroSection />
      <StatsStrip />
      <ServicesSnapshot />
      <HowItWorks />
      <TestimonialsSection />
    </>
  )
}
