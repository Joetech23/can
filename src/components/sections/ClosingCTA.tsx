import Image from 'next/image'
import Link from 'next/link'
import { ArrowRight, CalendarCheck, PhoneCall } from 'lucide-react'
import { images } from '@/lib/utils'
import { ctas } from '@/lib/content'

export default function ClosingCTA() {
  return (
    <section id="contact" className="relative py-24 md:py-32 overflow-hidden scroll-mt-20" aria-labelledby="closing-cta-heading">
      {/* Background */}
      <div className="absolute inset-0 z-0">
        <Image
          src={images.femaleNurseSmiling}
          alt=""
          fill
          className="object-cover"
          sizes="100vw"
        />
        <div className="absolute inset-0 animated-gradient opacity-90" />
      </div>

      <div className="absolute top-0 left-0 w-96 h-96 rounded-full bg-teal/20 blur-3xl z-10" />

      <div className="relative z-20 container-max text-center">
        <div className="max-w-3xl mx-auto">
          <div className="section-tag bg-white/15 text-white/85 border border-white/20 backdrop-blur-sm mx-auto mb-6">
            Contact
          </div>

          <h2 id="closing-cta-heading" className="text-3xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-6">
            Let&apos;s Talk About <span className="text-teal-300">Your Care</span>
          </h2>

          <p className="text-base md:text-xl text-white/80 leading-relaxed mb-4 max-w-2xl mx-auto">
            Whether you need home care for yourself, support for a loved one, a doctor consultation
            or professional clinical guidance, we&apos;re here to help.
          </p>
          <p className="text-base md:text-lg text-white font-semibold mb-10">
            Tell us what you need. We&apos;ll help you understand the next step.
          </p>

          <div className="flex flex-col sm:flex-row flex-wrap gap-4 justify-center">
            <Link
              href={ctas.requestHomeCare.href}
              className="inline-flex items-center justify-center gap-2.5 px-7 py-4 bg-white text-navy font-bold rounded-xl text-base transition-all duration-300 hover:bg-gray-50 hover:-translate-y-1 shadow-large"
            >
              {ctas.requestHomeCare.label}
              <ArrowRight size={18} />
            </Link>
            <Link
              href={ctas.bookConsultation.href}
              className="inline-flex items-center justify-center gap-2.5 px-7 py-4 bg-white/10 backdrop-blur-sm border-2 border-white/40 text-white font-bold rounded-xl text-base transition-all duration-300 hover:bg-white/20 hover:-translate-y-1"
            >
              <CalendarCheck size={18} />
              {ctas.bookConsultation.label}
            </Link>
            <Link
              href={ctas.speakToTeam.href}
              className="inline-flex items-center justify-center gap-2.5 px-7 py-4 bg-white/10 backdrop-blur-sm border-2 border-white/40 text-white font-bold rounded-xl text-base transition-all duration-300 hover:bg-white/20 hover:-translate-y-1"
            >
              <PhoneCall size={18} />
              {ctas.speakToTeam.label}
            </Link>
          </div>
        </div>
      </div>
    </section>
  )
}
