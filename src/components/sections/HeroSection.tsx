'use client'

import { useState, useEffect } from 'react'
import Image from 'next/image'
import Link from 'next/link'
import { ArrowRight, Star, Users } from 'lucide-react'
import { images } from '@/lib/utils'

const slides = [
  {
    image: images.familiesWithDoctor,
    headline: 'Expert Guidance,',
    subline: 'Right Care.',
    badge: 'Personal Doctor',
  },
  {
    image: images.femaleDoctorVirtual,
    headline: 'Your Health,',
    subline: 'Anywhere Care.',
    badge: 'Continuous Care',
  },
  {
    image: images.personalDoctor,
    headline: 'One Doctor,',
    subline: 'Your Care.',
    badge: '24/7 Clinical Advice',
  },
]

const trustBadges = [
  { icon: Star, text: 'Licensed professionals' },
  { icon: Users, text: 'Trusted by families' },
  { icon: Star, text: 'Members across Nigeria' },
]

export default function HeroSection() {
  const [currentSlide, setCurrentSlide] = useState(0)
  const [isTransitioning, setIsTransitioning] = useState(false)

  useEffect(() => {
    const interval = setInterval(() => {
      setIsTransitioning(true)
      setTimeout(() => {
        setCurrentSlide((prev) => (prev + 1) % slides.length)
        setIsTransitioning(false)
      }, 400)
    }, 6000)
    return () => clearInterval(interval)
  }, [])

  const slide = slides[currentSlide]

  return (
    <section className="relative min-h-screen flex items-center overflow-hidden" aria-label="Hero">
      {/* Background image */}
      <div className="absolute inset-0 z-0">
        {slides.map((s, i) => (
          <div
            key={i}
            className="absolute inset-0 transition-opacity duration-700"
            style={{ opacity: i === currentSlide ? 1 : 0 }}
          >
            <Image
              src={s.image}
              alt={`Care Access Nigeria - ${s.headline}`}
              fill
              className="object-cover object-center scale-105"
              priority={i === 0}
              quality={90}
              sizes="100vw"
            />
          </div>
        ))}
        {/* Overlay */}
        <div className="absolute inset-0 bg-gradient-to-r from-navy/95 via-navy/85 to-navy/50 z-10" />
        <div className="absolute inset-0 bg-gradient-to-t from-navy/70 via-transparent to-transparent z-10" />
      </div>

      {/* Decorative elements */}
      <div className="absolute top-1/4 right-1/4 w-72 h-72 rounded-full bg-teal/10 blur-3xl z-10" />
      <div className="absolute bottom-1/4 left-1/4 w-48 h-48 rounded-full bg-orange/10 blur-3xl z-10" />

      <div className="relative z-20 container-max w-full pt-20 md:pt-24">
        <div className="max-w-3xl">
          {/* Badge */}
          <div
            className="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-teal/20 border border-teal/30 mb-6 backdrop-blur-sm transition-all duration-500"
            style={{ opacity: isTransitioning ? 0 : 1, transform: `translateY(${isTransitioning ? '8px' : '0'})` }}
          >
            <span className="w-2 h-2 rounded-full bg-teal animate-pulse-slow" />
            <span className="text-xs font-semibold text-teal-200 tracking-wider uppercase">
              {slide.badge}
            </span>
          </div>

          {/* Headline */}
          <h1
            className="text-4xl sm:text-5xl lg:text-6xl xl:text-7xl font-extrabold text-white leading-tight mb-4 transition-all duration-500"
            style={{ opacity: isTransitioning ? 0 : 1, transform: `translateY(${isTransitioning ? '12px' : '0'})` }}
          >
            {slide.headline}
            <br />
            <span className="text-teal-300">{slide.subline}</span>
          </h1>

          {/* Sub-headline */}
          <p className="text-base md:text-lg text-white/80 leading-relaxed mb-8 max-w-2xl">
            Care Access Nigeria gives you a dedicated personal doctor, 24/7 nurse advice, and guided care so you always know what to do when it comes to your health.
          </p>

          {/* CTA Buttons */}
          <div className="flex flex-col sm:flex-row gap-4 mb-10">
            <Link
              href="/become-a-member"
              className="inline-flex items-center justify-center gap-2.5 px-8 py-4 bg-teal text-white font-bold rounded-xl text-base transition-all duration-300 hover:bg-teal-600 hover:shadow-teal hover:-translate-y-1 shadow-lg"
            >
              Become a Member
              <ArrowRight size={18} />
            </Link>
            <Link
              href="/book"
              className="inline-flex items-center justify-center gap-2.5 px-8 py-4 bg-white/10 backdrop-blur-sm border-2 border-white/40 text-white font-bold rounded-xl text-base transition-all duration-300 hover:bg-white hover:text-navy hover:-translate-y-1"
            >
              Talk to a Doctor
            </Link>
          </div>

          {/* Trust badges */}
          <div className="flex flex-wrap items-center gap-5">
            {trustBadges.map(({ icon: Icon, text }) => (
              <div key={text} className="flex items-center gap-2 text-white/70">
                <div className="w-7 h-7 rounded-lg bg-white/10 flex items-center justify-center">
                  <Icon size={13} className="text-teal-300" />
                </div>
                <span className="text-xs font-medium">{text}</span>
              </div>
            ))}
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
        <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
          <path d="M0 60L1440 60L1440 20C1200 60 900 0 720 0C540 0 240 60 0 20L0 60Z" fill="white" />
        </svg>
      </div>
    </section>
  )
}
