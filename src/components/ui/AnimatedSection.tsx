'use client'

import { useEffect, useRef, useState, ReactNode } from 'react'
import { cn } from '@/lib/utils'

interface AnimatedSectionProps {
  children: ReactNode
  className?: string
  delay?: number
  animation?: 'fade-up' | 'fade-left' | 'fade-right' | 'fade-in' | 'scale-up'
  threshold?: number
}

export default function AnimatedSection({
  children,
  className,
  delay = 0,
  animation = 'fade-up',
  threshold = 0.1,
}: AnimatedSectionProps) {
  const [isVisible, setIsVisible] = useState(false)
  const ref = useRef<HTMLDivElement>(null)

  useEffect(() => {
    const observer = new IntersectionObserver(
      ([entry]) => {
        if (entry.isIntersecting) {
          setTimeout(() => setIsVisible(true), delay)
          observer.disconnect()
        }
      },
      { threshold }
    )

    if (ref.current) observer.observe(ref.current)
    return () => observer.disconnect()
  }, [delay, threshold])

  const animationClasses = {
    'fade-up': isVisible
      ? 'opacity-100 translate-y-0'
      : 'opacity-0 translate-y-8',
    'fade-left': isVisible
      ? 'opacity-100 translate-x-0'
      : 'opacity-0 -translate-x-8',
    'fade-right': isVisible
      ? 'opacity-100 translate-x-0'
      : 'opacity-0 translate-x-8',
    'fade-in': isVisible
      ? 'opacity-100'
      : 'opacity-0',
    'scale-up': isVisible
      ? 'opacity-100 scale-100'
      : 'opacity-0 scale-95',
  }

  return (
    <div
      ref={ref}
      className={cn(
        'transition-all duration-700 ease-out',
        animationClasses[animation],
        className
      )}
    >
      {children}
    </div>
  )
}
