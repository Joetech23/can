import Image from 'next/image'
import AnimatedSection from '@/components/ui/AnimatedSection'
import { Target, Eye } from 'lucide-react'
import { images } from '@/lib/utils'

export default function MissionSection() {
  return (
    <section id="mission" className="section-padding bg-white overflow-hidden scroll-mt-20" aria-labelledby="mission-heading">
      <div className="container-max">
        <div className="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
          <AnimatedSection animation="fade-right" className="relative">
            <div className="relative rounded-3xl overflow-hidden aspect-[4/5] md:aspect-[5/4] lg:aspect-[4/5] shadow-large">
              <Image
                src={images.aboutUsPicture}
                alt="The Care Access Nigeria team"
                fill
                className="object-cover"
                sizes="(max-width: 1024px) 100vw, 50vw"
              />
              <div className="absolute inset-0 bg-gradient-to-t from-navy/40 to-transparent" />
            </div>
          </AnimatedSection>

          <AnimatedSection animation="fade-left">
            <div className="section-tag bg-teal/10 text-teal mb-4">Our Mission</div>
            <h2 id="mission-heading" className="text-3xl md:text-4xl lg:text-5xl font-extrabold text-navy leading-tight mb-6">
              Making Quality Care <span className="text-teal">More Accessible</span>
            </h2>
            <div className="space-y-4 mb-10">
              <p className="text-base md:text-lg text-navy font-semibold leading-relaxed">We believe accessing healthcare should be simpler.</p>
              <p className="text-base md:text-lg text-gray-600 leading-relaxed">
                Whether someone needs a carer at home, a nurse after hospital discharge, a doctor
                through telemedicine or professional guidance during an urgent situation, people
                should know where to turn.
              </p>
              <p className="text-base md:text-lg text-gray-600 leading-relaxed">
                Care Access Nigeria connects people with the care and healthcare support they need,
                when they need it and where they need it.
              </p>
            </div>

            <div className="grid sm:grid-cols-2 gap-5">
              <div className="rounded-2xl bg-navy p-6">
                <div className="flex items-center gap-2.5 mb-3">
                  <Target size={18} className="text-teal-300" />
                  <h3 className="text-sm font-bold text-white uppercase tracking-widest">Our Mission</h3>
                </div>
                <p className="text-sm text-white/75 leading-relaxed">
                  To make quality healthcare and professional home care more accessible to
                  individuals and families across Nigeria.
                </p>
              </div>
              <div className="rounded-2xl bg-[#F5F8FC] border border-gray-100 p-6">
                <div className="flex items-center gap-2.5 mb-3">
                  <Eye size={18} className="text-teal" />
                  <h3 className="text-sm font-bold text-navy uppercase tracking-widest">Our Vision</h3>
                </div>
                <p className="text-sm text-gray-600 leading-relaxed">
                  A Nigeria where everyone can access trusted, compassionate and professional care
                  when and where they need it.
                </p>
              </div>
            </div>
          </AnimatedSection>
        </div>
      </div>
    </section>
  )
}
