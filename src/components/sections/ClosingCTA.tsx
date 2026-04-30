import Image from 'next/image'
import Link from 'next/link'
import { ArrowRight, Shield } from 'lucide-react'
import { images } from '@/lib/utils'

export default function ClosingCTA() {
  return (
    <section className="relative py-24 md:py-32 overflow-hidden" aria-label="Call to action">
      {/* Background */}
      <div className="absolute inset-0 z-0">
        <Image
          src={images.nursePhoneCall}
          alt="24/7 nurse care"
          fill
          className="object-cover"
          sizes="100vw"
        />
        <div className="absolute inset-0 animated-gradient opacity-90" />
      </div>

      {/* Decorative blobs */}
      <div className="absolute top-0 left-0 w-96 h-96 rounded-full bg-teal/20 blur-3xl z-10" />
      <div className="absolute bottom-0 right-0 w-96 h-96 rounded-full bg-orange/10 blur-3xl z-10" />

      <div className="relative z-20 container-max text-center">
        <div className="max-w-3xl mx-auto">
          <div className="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/15 border border-white/20 mb-6 backdrop-blur-sm">
            <Shield size={14} className="text-teal-300" />
            <span className="text-xs font-semibold text-white/80 tracking-wider uppercase">
              Join thousands of Nigerians
            </span>
          </div>

          <h2 className="text-3xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-6">
            Your health deserves consistent,{' '}
            <span className="text-teal-300">expert attention.</span>
          </h2>

          <p className="text-base md:text-xl text-white/75 leading-relaxed mb-10 max-w-2xl mx-auto">
            Join Care Access and get the right care you deserve. Plans start at ₦25,000/month. No lock-in.
          </p>

          <div className="flex flex-col sm:flex-row gap-4 justify-center mb-12">
            <Link
              href="/become-a-member"
              className="inline-flex items-center justify-center gap-2.5 px-8 py-4 bg-white text-navy font-bold rounded-xl text-base transition-all duration-300 hover:bg-gray-50 hover:-translate-y-1 shadow-large"
            >
              Become a Member
              <ArrowRight size={18} />
            </Link>
            <Link
              href="/contact"
              className="inline-flex items-center justify-center gap-2.5 px-8 py-4 bg-white/10 backdrop-blur-sm border-2 border-white/40 text-white font-bold rounded-xl text-base transition-all duration-300 hover:bg-white/20 hover:-translate-y-1"
            >
              Talk to a Doctor
            </Link>
          </div>

          {/* Trust line */}
          <div className="flex flex-wrap justify-center gap-6">
            {[
              'No lock-in commitment',
              '100% confidential',
              'Licensed professionals',
            ].map((item) => (
              <div key={item} className="flex items-center gap-2 text-white/60 text-sm">
                <span className="w-1.5 h-1.5 rounded-full bg-teal-300" />
                {item}
              </div>
            ))}
          </div>
        </div>
      </div>
    </section>
  )
}
