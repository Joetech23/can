import Image from 'next/image'
import AnimatedSection from '@/components/ui/AnimatedSection'
import { UserCheck, Clock, Compass, Home } from 'lucide-react'
import { images } from '@/lib/utils'

const benefits = [
  {
    icon: UserCheck,
    title: 'Your own personal doctor',
    description: 'One doctor who knows you and your family\'s full health history, assigned to you from day one. No repeating yourself to a new face every time.',
    color: 'text-teal',
    bg: 'bg-teal/10',
  },
  {
    icon: Clock,
    title: '24/7 nurse on call',
    description: 'Immediate clinical advice at any time of day or night. Guidance on symptoms, medication, and next steps whenever you need it. Exclusively for members.',
    color: 'text-orange',
    bg: 'bg-orange/10',
  },
  {
    icon: Compass,
    title: 'We navigate care for you',
    description: 'No guessing which specialist or hospital to go to. Your doctor guides every referral so you arrive at the right place, prepared and expected.',
    color: 'text-navy',
    bg: 'bg-navy/10',
  },
  {
    icon: Home,
    title: 'Home visits available',
    description: 'Arrange an in-person nurse visit for yourself or a family member from anywhere in Nigeria. Ideal for elderly relatives and post-procedure recovery.',
    color: 'text-green',
    bg: 'bg-green/10',
  },
]

export default function WhyChooseUs() {
  return (
    <section className="section-padding bg-white overflow-hidden" aria-labelledby="why-heading">
      <div className="container-max">
        <div className="grid lg:grid-cols-2 gap-16 items-center">
          {/* Text side */}
          <AnimatedSection animation="fade-right">
            <div className="section-tag bg-green/10 text-green mb-4">
              Why Care Access
            </div>
            <h2 id="why-heading" className="text-3xl md:text-4xl lg:text-5xl font-extrabold text-navy leading-tight mb-4">
              Why people choose{' '}
              <span className="text-teal">Care Access Nigeria</span>
            </h2>
            <p className="text-base md:text-lg text-gray-500 mb-10 leading-relaxed">
              We built something different from the ground up. Not another app where you scroll through doctors. A care model where your doctor knows your name.
            </p>

            <div className="space-y-6">
              {benefits.map(({ icon: Icon, title, description, color, bg }, i) => (
                <AnimatedSection key={title} delay={i * 100} animation="fade-right">
                  <div className="flex gap-4 group">
                    <div className={`w-12 h-12 rounded-xl ${bg} flex items-center justify-center flex-shrink-0 transition-transform duration-300 group-hover:scale-110`}>
                      <Icon size={22} className={color} />
                    </div>
                    <div>
                      <h3 className="font-bold text-navy mb-1">{title}</h3>
                      <p className="text-sm text-gray-600 leading-relaxed">{description}</p>
                    </div>
                  </div>
                </AnimatedSection>
              ))}
            </div>
          </AnimatedSection>

          {/* Image grid */}
          <AnimatedSection animation="fade-left" className="relative">
            <div className="grid grid-cols-2 gap-4">
              <div className="space-y-4">
                <div className="relative rounded-2xl overflow-hidden aspect-[3/4] shadow-medium">
                  <Image
                    src={images.femaleNurseSmiling}
                    alt="Nurse smiling on phone"
                    fill
                    className="object-cover"
                    sizes="25vw"
                  />
                </div>
                <div className="relative rounded-2xl overflow-hidden aspect-square shadow-medium">
                  <Image
                    src={images.doctorOneOnOne}
                    alt="Doctor on one-on-one call"
                    fill
                    className="object-cover"
                    sizes="25vw"
                  />
                </div>
              </div>
              <div className="space-y-4 mt-8">
                <div className="relative rounded-2xl overflow-hidden aspect-square shadow-medium">
                  <Image
                    src={images.maleDoctorSession}
                    alt="Male doctor in session"
                    fill
                    className="object-cover"
                    sizes="25vw"
                  />
                </div>
                <div className="relative rounded-2xl overflow-hidden aspect-[3/4] shadow-medium">
                  <Image
                    src={images.femaleDoctorSmiling}
                    alt="Female doctor smiling"
                    fill
                    className="object-cover"
                    sizes="25vw"
                  />
                </div>
              </div>
            </div>

            {/* Overlay card */}
            <div className="absolute -bottom-4 -left-4 bg-navy rounded-2xl p-4 shadow-large">
              <p className="text-teal-300 text-xs font-semibold uppercase tracking-wide mb-1">Our Commitment</p>
              <p className="text-white text-sm font-bold leading-snug max-w-[180px]">
                You are never just a case number to us.
              </p>
            </div>
          </AnimatedSection>
        </div>
      </div>
    </section>
  )
}
