'use client'

import { useState, useEffect } from 'react'
import Image from 'next/image'
import Link from 'next/link'
import { ArrowRight, PhoneCall } from 'lucide-react'
import { images } from '@/lib/utils'

const slides = [
  { image: images.familiesWithDoctor },
  { image: images.femaleDoctorVirtual },
  { image: images.personalDoctor },
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
              alt="Care Access Nigeria"
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
      <div className="relative z-20 container-max w-full pt-20 md:pt-24">
        <div className="max-w-3xl">

          {/* Live badge */}
          <div className="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-teal/20 border border-teal/30 mb-7 backdrop-blur-sm">
            <span className="w-2 h-2 rounded-full bg-teal animate-pulse-slow" />
            <span className="text-xs font-semibold text-teal-200 tracking-wider uppercase">
              24/7 Emergency Healthcare Guidance
            </span>
          </div>

          {/* Headline */}
          <h1 className="text-4xl sm:text-5xl lg:text-6xl xl:text-7xl font-extrabold text-white leading-tight mb-6">
            When a health emergency happens,{' '}
            <span className="text-teal-300">who do you call?</span>
          </h1>

          {/* Sub-headline */}
          <p className="text-base md:text-xl text-white/80 leading-relaxed mb-10 max-w-2xl">
            Access urgent healthcare guidance, doctor consultations, nurse support, home visits,
            and healthcare coordination from trained healthcare professionals in Nigeria.
          </p>

          {/* CTA Buttons */}
          <div className="flex flex-col sm:flex-row gap-4">
            <Link
              href="/signup"
              className="inline-flex items-center justify-center gap-2.5 px-8 py-4 bg-teal text-white font-bold rounded-xl text-base transition-all duration-300 hover:bg-teal-600 hover:shadow-teal hover:-translate-y-1 shadow-lg"
            >
              Register with us
              <ArrowRight size={18} />
            </Link>
            <Link
              href="/contact"
              className="inline-flex items-center justify-center gap-2.5 px-8 py-4 bg-white/10 backdrop-blur-sm border-2 border-white/40 text-white font-bold rounded-xl text-base transition-all duration-300 hover:bg-white hover:text-navy hover:-translate-y-1"
            >
              <PhoneCall size={18} />
              Speak To Our Team
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
