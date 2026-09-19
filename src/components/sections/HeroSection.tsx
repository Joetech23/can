'use client'

import { useState, useEffect } from 'react'
import Image from 'next/image'
import Link from 'next/link'
import { ArrowRight, PhoneCall } from 'lucide-react'
import { images } from '@/lib/utils'
import { ctas } from '@/lib/content'

const slides = [
  { image: images.doctorWithFamilies },
  { image: images.femaleNurseSmiling },
  { image: images.familiesWithDoctor },
]

export default function HeroSection() {
  const [currentSlide, setCurrentSlide] = useState(0)

  useEffect(() => {
    const interval = setInterval(() => {
      setCurrentSlide((prev) => (prev + 1) % slides.length)
    }, 6000)
    return () => clearInterval(interval)
  }, [])

  return (
    <section className="relative min-h-screen flex items-center overflow-hidden" aria-label="Hero">
      {/* Background image carousel */}
      <div className="absolute inset-0 z-0">
        {slides.map((s, i) => (
          <div
            key={i}
            className="absolute inset-0 transition-opacity duration-700"
            style={{ opacity: i === currentSlide ? 1 : 0 }}
          >
            <Image
              src={s.image}
              alt=""
              fill
              className="object-cover object-center scale-105"
              priority={i === 0}
              quality={90}
              sizes="100vw"
            />
          </div>
        ))}
        {/* Overlay */}
        <div className="absolute inset-0 bg-gradient-to-r from-navy/95 via-navy/88 to-navy/55 z-10" />
        <div className="absolute inset-0 bg-gradient-to-t from-navy/70 via-transparent to-transparent z-10" />
      </div>

      {/* Decorative blurs */}
      <div className="absolute top-1/4 right-1/4 w-72 h-72 rounded-full bg-teal/10 blur-3xl z-10" />
      <div className="absolute bottom-1/4 left-1/4 w-48 h-48 rounded-full bg-orange/10 blur-3xl z-10" />

      {/* Content */}
      <div className="relative z-20 container-max w-full pt-28 pb-32 md:pt-32">
        <div className="max-w-3xl">

          <p className="text-xs md:text-sm font-bold text-teal-200 tracking-[0.25em] uppercase mb-5">
            Care Access Nigeria
          </p>

          <h1 className="text-4xl sm:text-5xl lg:text-6xl xl:text-7xl font-extrabold text-white leading-[1.05] mb-6">
            Professional Home Care.{' '}
            <span className="text-teal-300">Connected Healthcare.</span>
          </h1>

          <p className="text-lg md:text-2xl text-white/90 font-medium leading-snug mb-6 max-w-2xl">
            Quality care and healthcare support, delivered with compassion, wherever you need it.
          </p>

          <div className="space-y-4 mb-10 max-w-2xl">
            <p className="text-base md:text-lg text-white/75 leading-relaxed">
              Care Access Nigeria provides professional home care services, connecting individuals and
              families with qualified nurses, carers and doctors across Nigeria.
            </p>
            <p className="text-base md:text-lg text-white/75 leading-relaxed">
              From elderly care and nursing support to post-hospital recovery and doctor home visits,
              we bring trusted healthcare closer to home. And when you need additional support, our
              telemedicine, care coordination and clinical services help you access the right
              healthcare at the right time.
            </p>
          </div>

          {/* CTA Buttons */}
          <div className="flex flex-col sm:flex-row gap-4">
            <Link
              href={ctas.requestHomeCare.href}
              className="inline-flex items-center justify-center gap-2.5 px-8 py-4 bg-teal text-white font-bold rounded-xl text-base transition-all duration-300 hover:bg-teal-600 hover:shadow-teal hover:-translate-y-1 shadow-lg"
            >
              {ctas.requestHomeCare.label}
              <ArrowRight size={18} />
            </Link>
            <Link
              href={ctas.speakToTeam.href}
              className="inline-flex items-center justify-center gap-2.5 px-8 py-4 bg-white/10 backdrop-blur-sm border-2 border-white/40 text-white font-bold rounded-xl text-base transition-all duration-300 hover:bg-white hover:text-navy hover:-translate-y-1"
            >
              <PhoneCall size={18} />
              {ctas.speakToTeam.label}
            </Link>
          </div>
        </div>
      </div>

      {/* Slide indicators */}
      <div className="absolute bottom-8 left-1/2 -translate-x-1/2 z-20 flex items-center gap-2">
        {slides.map((_, i) => (
          <button
            key={i}
            onClick={() => setCurrentSlide(i)}
            className="transition-all duration-300 rounded-full"
            style={{
              width: i === currentSlide ? '24px' : '8px',
              height: '8px',
              backgroundColor: i === currentSlide ? '#168ca2' : 'rgba(255,255,255,0.4)',
            }}
            aria-label={`Go to slide ${i + 1}`}
          />
        ))}
      </div>

      {/* Bottom wave */}
      <div className="absolute bottom-0 left-0 right-0 z-20">
        <svg viewBox="0 0 1440 90" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
          <path d="M0 90L1440 90L1440 40C1200 90 900 0 720 0C540 0 240 90 0 40L0 90Z" fill="white" />
        </svg>
      </div>
    </section>
  )
}
