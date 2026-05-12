import type { Metadata } from 'next'
import Image from 'next/image'
import AnimatedSection from '@/components/ui/AnimatedSection'
import { images } from '@/lib/utils'
import { Target, Eye, Heart, Users, Building2, Shield } from 'lucide-react'
// Team section removed — not ready for public display

export const metadata: Metadata = {
  title: 'About Us',
  description:
    'Learn the story behind Care Access Nigeria. We exist to make healthcare accessible to every Nigerian — delivered with transparency, consistency, and trust.',
  alternates: {
    canonical: 'https://careaccess.ng/about',
  },
}

const values = [
  {
    icon: Heart,
    title: 'People First',
    description: 'Every decision we make is measured by one question: does this make life better for our members?',
    color: 'text-orange',
    bg: 'bg-orange/10',
  },
  {
    icon: Shield,
    title: 'Trust & Transparency',
    description: 'We tell you exactly what we can do, what we cannot do, and why. No medical jargon, no guessing.',
    color: 'text-navy',
    bg: 'bg-navy/10',
  },
  {
    icon: Users,
    title: 'Continuity of Care',
    description: 'Your care is continuous, with a team that understands your medical history — not one-off consultations.',
    color: 'text-teal',
    bg: 'bg-teal/10',
  },
  {
    icon: Building2,
    title: 'Trusted Network',
    description: 'We partner only with vetted hospitals, labs, pharmacies, and ambulance services across Nigeria.',
    color: 'text-green',
    bg: 'bg-green/10',
  },
]


export default function AboutPage() {
  return (
    <>
      {/* Page hero */}
      <section className="relative pt-28 pb-28 md:pt-36 md:pb-36 overflow-hidden hero-gradient" aria-label="About hero">
        <div className="absolute inset-0 bg-navy-mesh" />
        <div className="absolute bottom-0 left-0 right-0">
          <svg viewBox="0 0 1440 90" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0 90L1440 90L1440 40C1200 90 900 0 720 0C540 0 240 90 0 40L0 90Z" fill="white" />
          </svg>
        </div>
        <div className="relative z-10 container-max text-center">
          <AnimatedSection>
            <div className="section-tag bg-teal/20 text-teal-200 mx-auto mb-5">
              Our Story
            </div>
            <h1 className="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-6 max-w-4xl mx-auto">
              Access the Care you need,{' '}
              <span className="text-teal-300">When you need it</span>
            </h1>
            <p className="text-base md:text-xl text-white/70 max-w-2xl mx-auto leading-relaxed">
              Care Access Nigeria connects you to the right care, at the right time
            </p>
          </AnimatedSection>
        </div>
      </section>

      {/* Who We Are */}
      <section className="section-padding bg-white relative -mt-px" aria-labelledby="who-heading">
        <div className="container-max">
          <div className="grid lg:grid-cols-2 gap-16 items-center">
            <AnimatedSection animation="fade-right">
              <div className="relative rounded-3xl overflow-hidden aspect-[4/5] shadow-large">
                <Image
                  src="https://res.cloudinary.com/dx2bbdxnw/image/upload/v1777370791/about_us_ei0xhv.jpg"
                  alt="Care Access Nigeria — personal healthcare"
                  fill
                  className="object-cover"
                  sizes="50vw"
                />
                <div className="absolute inset-0 bg-gradient-to-t from-navy/40 to-transparent" />
              </div>
            </AnimatedSection>

            <AnimatedSection animation="fade-left">
              <div className="section-tag bg-teal/10 text-teal mb-4">Who We Are</div>
              <h2 id="who-heading" className="text-3xl md:text-4xl font-extrabold text-navy leading-tight mb-6">
                Your first point of contact for healthcare.
              </h2>
              <div className="space-y-4 text-base text-gray-600 leading-relaxed">
                <p>
                  We make it simple to get the right medical advice without long waits, confusion, or
                  guesswork. Instead of navigating the system alone or self-medicating, you have direct
                  access to a trusted clinical team that knows your history and supports you over time.
                </p>
                <p>
                  From everyday concerns to ongoing conditions, we guide your care, coordinate what comes
                  next, and help you make confident decisions about your health. We also support your family,
                  with shared records and continuity of care.
                </p>
                <p>
                  We are not a hospital, we are your first call, your clinical guide, and your partner in
                  better health.
                </p>
              </div>

            </AnimatedSection>
          </div>
        </div>
      </section>

      {/* Prominent statement */}
      <section className="py-10 bg-white" aria-label="Key statement">
        <div className="container-max">
          <AnimatedSection>
            <div className="rounded-2xl bg-teal/8 border border-teal/20 px-8 py-6 text-center">
              <p className="text-lg md:text-2xl font-extrabold text-navy leading-snug">
                We are not a hospital —{' '}
                <span className="text-teal">we are your first point of contact for care.</span>
              </p>
            </div>
          </AnimatedSection>
        </div>
      </section>

      {/* Mission & Vision */}
      <section className="section-padding section-bg-alt" aria-label="Mission and vision">
        <div className="container-max">
          <AnimatedSection className="text-center mb-14">
            <div className="section-tag bg-navy/10 text-navy mx-auto mb-4">Our Purpose</div>
            <h2 className="text-3xl md:text-4xl font-extrabold text-navy mb-4">
              What drives everything we do
            </h2>
          </AnimatedSection>

          <div className="grid md:grid-cols-2 gap-8">
            <AnimatedSection delay={100} animation="fade-up">
              <div className="bg-navy rounded-3xl p-8 md:p-10 text-white h-full">
                <div className="w-14 h-14 rounded-2xl bg-white/15 flex items-center justify-center mb-6">
                  <Target size={26} className="text-teal-300" />
                </div>
                <div className="text-teal-300 text-xs font-bold uppercase tracking-widest mb-3">Our Mission</div>
                <h3 className="text-2xl font-extrabold mb-4 leading-tight text-white">
                  High-quality healthcare, made accessible
                </h3>
                <p className="text-white leading-relaxed">
                  To provide trusted healthcare guidance, coordination, and continuity of care for individuals, families, organisations, and Nigerians abroad with loved ones back home.
                </p>
              </div>
            </AnimatedSection>

            <AnimatedSection delay={200} animation="fade-up">
              <div className="bg-teal rounded-3xl p-8 md:p-10 text-white h-full">
                <div className="w-14 h-14 rounded-2xl bg-white/15 flex items-center justify-center mb-6">
                  <Eye size={26} className="text-white" />
                </div>
                <div className="text-white/70 text-xs font-bold uppercase tracking-widest mb-3">Our Vision</div>
                <h3 className="text-2xl font-extrabold mb-4 leading-tight text-white">
                  Trusted healthcare access for every Nigerian
                </h3>
                <p className="text-white leading-relaxed">
                  A future where every person in Nigeria can access dependable, continuous healthcare with confidence.
                </p>
              </div>
            </AnimatedSection>
          </div>
        </div>
      </section>

      {/* Our Promise Banner */}
      <section className="section-padding bg-white" aria-label="Our Promise">
        <div className="container-max">
          <AnimatedSection>
            <div className="relative rounded-3xl overflow-hidden h-64 md:h-80">
              <Image
                src={images.doctorConsulting}
                alt="Doctor consulting with patient"
                fill
                className="object-cover"
                sizes="(max-width: 1280px) 100vw, 1280px"
              />
              <div className="absolute inset-0 bg-gradient-to-r from-navy/85 to-navy/40" />
              <div className="absolute inset-0 flex items-center px-8 md:px-16">
                <div className="max-w-xl">
                  <p className="text-white/70 text-sm font-semibold uppercase tracking-wider mb-3">
                    Our Promise
                  </p>
                  <p className="text-white text-2xl md:text-3xl font-bold leading-tight">
                    You are never left to figure out your healthcare alone.<br />
                    We guide you every step of the way.
                  </p>
                </div>
              </div>
            </div>
          </AnimatedSection>
        </div>
      </section>

      {/* Our Approach */}
      {/* <section className="section-padding bg-white" aria-labelledby="approach-heading">
        <div className="container-max">
          <AnimatedSection className="text-center mb-14">
            <div className="section-tag bg-teal/10 text-teal mx-auto mb-4">How We Work</div>
            <h2 id="approach-heading" className="text-3xl md:text-4xl font-extrabold text-navy mb-4">
              Continuity of care, not one-off consultations
            </h2>
            <p className="text-base text-gray-500 max-w-xl mx-auto">
              Our approach to healthcare is built on three interconnected pillars that work together to give you complete, continuous coverage.
            </p>
          </AnimatedSection>

          <div className="grid md:grid-cols-3 gap-8">
            {approach.map(({ icon: Icon, title, description }, i) => (
              <AnimatedSection key={title} delay={i * 120} animation="fade-up">
                <div className="relative">
                  <div className="text-8xl font-black text-gray-50 select-none absolute -top-4 -left-2">
                    {String(i + 1).padStart(2, '0')}
                  </div>
                  <div className="relative pt-4">
                    <div className="w-12 h-12 rounded-xl bg-teal/10 flex items-center justify-center mb-4">
                      <Icon size={22} className="text-teal" />
                    </div>
                    <h3 className="text-lg font-bold text-navy mb-3">{title}</h3>
                    <p className="text-sm text-gray-600 leading-relaxed">{description}</p>
                  </div>
                </div>
              </AnimatedSection>
            ))}
          </div>
        </div>
      </section> */}

      {/* Values */}
      <section className="section-padding section-bg-alt" aria-labelledby="values-heading">
        <div className="container-max">
          <AnimatedSection className="text-center mb-14">
            <div className="section-tag bg-orange/10 text-orange mx-auto mb-4">What We Stand For</div>
            <h2 id="values-heading" className="text-3xl md:text-4xl font-extrabold text-navy mb-4">
              The principles behind our care
            </h2>
          </AnimatedSection>

          <div className="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            {values.map(({ icon: Icon, title, description, color, bg }, i) => (
              <AnimatedSection key={title} delay={i * 100} animation="fade-up">
                <div className="card text-center">
                  <div className={`w-14 h-14 rounded-2xl ${bg} flex items-center justify-center mx-auto mb-4`}>
                    <Icon size={24} className={color} />
                  </div>
                  <h3 className="font-bold text-navy mb-2">{title}</h3>
                  <p className="text-sm text-gray-500 leading-relaxed">{description}</p>
                </div>
              </AnimatedSection>
            ))}
          </div>
        </div>
      </section>

    </>
  )
}
