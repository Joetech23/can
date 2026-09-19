import Image from 'next/image'
import Link from 'next/link'
import AnimatedSection from '@/components/ui/AnimatedSection'
import { ArrowRight, Home, Stethoscope, GitBranch, MessageCircleQuestion, Siren } from 'lucide-react'
import { images } from '@/lib/utils'
import { ctas } from '@/lib/content'

const support = [
  { icon: Home,                  title: 'Home care',              description: 'Nurses and carers providing support at home.' },
  { icon: Stethoscope,           title: 'Medical support',        description: 'Doctor consultations and appropriate home visits.' },
  { icon: GitBranch,             title: 'Healthcare coordination', description: 'Helping manage appointments, referrals, diagnostics and follow-up care.' },
  { icon: MessageCircleQuestion, title: 'Clinical support',       description: 'Professional guidance when you are unsure what to do next.' },
  { icon: Siren,                 title: 'Emergency support',      description: 'Help navigating urgent healthcare situations and coordinating appropriate care.' },
]

export default function LovedOneSection() {
  return (
    <section id="loved-one" className="relative section-padding overflow-hidden hero-gradient scroll-mt-20" aria-labelledby="loved-one-heading">
      <div className="absolute inset-0 opacity-15">
        <Image src={images.familiesWithDoctor} alt="" fill className="object-cover" sizes="100vw" />
      </div>
      <div className="absolute -top-32 -right-32 w-96 h-96 rounded-full bg-teal/20 blur-3xl" />

      <div className="relative z-10 container-max">
        <div className="grid lg:grid-cols-12 gap-12 lg:gap-16">
          <AnimatedSection animation="fade-right" className="lg:col-span-5">
            <div className="section-tag bg-white/10 text-teal-200 mb-5">Care for a Loved One</div>
            <h2 id="loved-one-heading" className="text-3xl md:text-4xl lg:text-5xl font-extrabold text-white leading-tight mb-6">
              When You Can&apos;t <span className="text-teal-300">Always Be There</span>
            </h2>
            <div className="space-y-4 mb-8">
              <p className="text-base md:text-lg text-white/75 leading-relaxed">Being away from a parent or loved one can make arranging healthcare difficult.</p>
              <p className="text-base md:text-lg text-white/75 leading-relaxed">
                Care Access Nigeria helps families arrange and coordinate professional care for
                loved ones in Nigeria. Whether you&apos;re in Nigeria or living abroad, we can help.
              </p>
            </div>

            <p className="text-xl md:text-2xl font-bold text-white leading-snug mb-1">
              You may not always be able to be there.
            </p>
            <p className="text-xl md:text-2xl font-bold text-teal-300 leading-snug mb-9">
              We can help make sure they are cared for.
            </p>

            <Link
              href={ctas.arrangeLovedOne.href}
              className="inline-flex items-center justify-center gap-2.5 px-7 py-4 bg-teal text-white font-bold rounded-xl text-sm md:text-base transition-all duration-300 hover:bg-teal-600 hover:-translate-y-1 shadow-lg"
            >
              {ctas.arrangeLovedOne.label} <ArrowRight size={18} />
            </Link>
          </AnimatedSection>

          <div className="lg:col-span-7">
            <AnimatedSection>
              <p className="text-sm font-semibold text-white/60 uppercase tracking-widest mb-5">
                We can help arrange
              </p>
            </AnimatedSection>
            <div className="grid sm:grid-cols-2 gap-4">
              {support.map(({ icon: Icon, title, description }, i) => (
                <AnimatedSection
                  key={title}
                  delay={i * 80}
                  className={i === support.length - 1 ? 'sm:col-span-2' : ''}
                >
                  <div className="h-full rounded-2xl bg-white/[0.06] border border-white/10 backdrop-blur-sm p-6 transition-colors duration-300 hover:bg-white/[0.1]">
                    <div className="w-10 h-10 rounded-xl bg-teal/20 flex items-center justify-center mb-4">
                      <Icon size={18} className="text-teal-200" />
                    </div>
                    <h3 className="text-base md:text-lg font-bold text-white mb-1.5">{title}</h3>
                    <p className="text-sm text-white/65 leading-relaxed">{description}</p>
                  </div>
                </AnimatedSection>
              ))}
            </div>
          </div>
        </div>
      </div>
    </section>
  )
}
