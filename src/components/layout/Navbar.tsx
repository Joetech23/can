'use client'

import { useState, useEffect } from 'react'
import Link from 'next/link'
import Image from 'next/image'
import { usePathname } from 'next/navigation'
import { Menu, X, Phone } from 'lucide-react'
import { cn } from '@/lib/utils'

const navLinks = [
  { href: '/',                 label: 'Home' },
  { href: '/about',            label: 'About Us' },
  { href: '/become-a-member',  label: 'Membership' },
  { href: '/contact',          label: 'Contact' },
]

export default function Navbar() {
  const [isScrolled, setIsScrolled] = useState(false)
  const [mobileOpen, setMobileOpen] = useState(false)
  const pathname = usePathname()

  useEffect(() => {
    const handleScroll = () => setIsScrolled(window.scrollY > 20)
    window.addEventListener('scroll', handleScroll, { passive: true })
    return () => window.removeEventListener('scroll', handleScroll)
  }, [])

  useEffect(() => { setMobileOpen(false) }, [pathname])

  useEffect(() => {
    document.body.style.overflow = mobileOpen ? 'hidden' : ''
    return () => { document.body.style.overflow = '' }
  }, [mobileOpen])

  return (
    <>
      <header className={cn(
        'fixed top-0 left-0 right-0 z-50 transition-all duration-300 bg-white border-b border-gray-100',
        isScrolled ? 'shadow-soft' : 'shadow-none'
      )}>
        <div className="container-max">
          <div className="flex items-center justify-between h-16 md:h-20">

            {/* Logo */}
            <Link href="/" aria-label="Care Access Nigeria — Home" className="flex-shrink-0">
              <Image
                src="/logo.png"
                alt="Care Access Nigeria"
                width={1187}
                height={540}
                className="h-14 w-auto object-contain logo-animate"
                priority
              />
            </Link>

            {/* Desktop nav */}
            <nav className="hidden lg:flex items-center gap-1">
              {navLinks.map(({ href, label }) => {
                const isActive = pathname === href
                return (
                  <Link
                    key={href}
                    href={href}
                    className={cn(
                      'relative px-4 py-2 text-sm font-semibold transition-colors duration-200 group rounded-lg',
                      isActive ? 'text-navy' : 'text-gray-500 hover:text-navy'
                    )}
                  >
                    {label}
                    <span className={cn(
                      'absolute bottom-0 left-3 right-3 h-0.5 rounded-full bg-navy transition-all duration-300',
                      isActive ? 'opacity-100' : 'opacity-0 group-hover:opacity-40'
                    )} />
                  </Link>
                )
              })}
            </nav>

            {/* Desktop CTAs */}
            <div className="hidden lg:flex items-center gap-3">
              <Link
                href="/book"
                className="px-5 py-2.5 rounded-xl text-sm font-semibold border-2 border-navy/20 text-navy transition-all duration-200 hover:border-navy hover:bg-navy/5"
              >
                Book a Consultation
              </Link>
              <Link
                href="/become-a-member"
                className="flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-semibold bg-navy text-white transition-all duration-200 hover:bg-navy-600 shadow-navy/20 shadow-md"
              >
                {/* <Phone size={16} /> */}
                Get Started Today
              </Link>
            </div>

            {/* Mobile toggle */}
            <button
              onClick={() => setMobileOpen(!mobileOpen)}
              className="lg:hidden p-2 rounded-lg text-gray-600 hover:bg-gray-100 transition-colors"
              aria-label={mobileOpen ? 'Close menu' : 'Open menu'}
            >
              {mobileOpen ? <X size={22} /> : <Menu size={22} />}
            </button>
          </div>
        </div>
      </header>

      {/* Mobile menu */}
      <div className={cn(
        'fixed inset-0 z-40 lg:hidden transition-all duration-300',
        mobileOpen ? 'opacity-100 pointer-events-auto' : 'opacity-0 pointer-events-none'
      )}>
        <div className="absolute inset-0 bg-navy/60 backdrop-blur-sm" onClick={() => setMobileOpen(false)} />
        <div className={cn(
          'absolute right-0 top-0 bottom-0 w-72 bg-white shadow-2xl transition-transform duration-300 flex flex-col',
          mobileOpen ? 'translate-x-0' : 'translate-x-full'
        )}>
          <div className="flex items-center justify-between p-5 border-b border-gray-100">
            <Image src="/logo.png" alt="Care Access Nigeria" width={1187} height={540} className="h-10 w-auto object-contain" />
            <button onClick={() => setMobileOpen(false)} className="p-2 rounded-lg text-gray-400 hover:bg-gray-100">
              <X size={20} />
            </button>
          </div>

          <nav className="flex-1 py-3 overflow-y-auto">
            {navLinks.map(({ href, label }) => {
              const isActive = pathname === href
              return (
                <Link
                  key={href}
                  href={href}
                  className={cn(
                    'flex items-center gap-3 mx-3 px-4 py-3.5 my-0.5 rounded-xl text-sm font-semibold transition-all duration-200',
                    isActive ? 'text-navy bg-navy/6' : 'text-gray-600 hover:text-navy hover:bg-gray-50'
                  )}
                >
                  {isActive && <span className="w-2 h-2 rounded-full bg-navy flex-shrink-0" />}
                  {label}
                </Link>
              )
            })}
          </nav>

          <div className="p-5 space-y-3 border-t border-gray-100">
            <Link
              href="/book"
              className="flex items-center justify-center w-full py-3 border-2 border-navy text-navy rounded-xl text-sm font-semibold hover:bg-navy hover:text-white transition-all duration-200"
            >
              Book a Consultation
            </Link>
            <Link
              href="/signup"
              className="flex items-center justify-center w-full py-3 bg-navy text-white rounded-xl text-sm font-semibold hover:bg-navy-600 transition-all duration-200"
            >
              Get Started Today
            </Link>
          </div>
        </div>
      </div>
    </>
  )
}
          