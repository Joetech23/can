import Link from 'next/link'
import { Mail, Phone, Stethoscope, Instagram, Linkedin, Music, ArrowRight, Heart } from 'lucide-react'

const quickLinks = [
  { href: '/', label: 'Home' },
  { href: '/about', label: 'About Us' },
  { href: '/become-a-member', label: 'Membership' },
  { href: '/faq', label: 'FAQ' },
  { href: '/contact', label: 'Contact' },
]

const services = [
  { href: '/services#dedicated-care', label: 'Dedicated Care Team' },
  { href: '/services#teleconsultation', label: 'Teleconsultation' },
  { href: '/services#nurse-on-call', label: '24/7 Clinical Advice' },
  { href: '/services#home-visits', label: 'Home Visits' },
  { href: '/services#care-coordination', label: 'Care Coordination' },
]

const socials = [
  {
    href: 'https://www.instagram.com/careaccessng?igsh=MXFlcmZmeDNob3ZqeA%3D%3D&utm_source=qr',
    icon: Instagram,
    label: 'Instagram',
  },
  {
    href: 'https://www.tiktok.com/@careaccessng?_r=1&_t=ZN-96Alwzc5bvS',
    icon: Music,
    label: 'TikTok',
  },
  {
    href: 'https://www.linkedin.com/company/careaccessng/',
    icon: Linkedin,
    label: 'LinkedIn',
  },
]

export default function Footer() {
  return (
    <footer className="bg-navy text-white">
      {/* Top strip */}
      <div className="bg-teal py-4">
        <div className="container-max">
          <div className="flex flex-col sm:flex-row items-center justify-between gap-3 text-sm">
            <div className="flex items-center gap-2 font-medium">
              <Stethoscope size={16} className="text-white/80" />
              <span>Not sure what to do?<br className="sm:hidden" /> Speak to a clinician and get clear guidance on your next steps.</span>
            </div>
            <Link
              href="/book"
              className="flex items-center gap-1.5 text-white font-semibold hover:gap-2.5 transition-all duration-200 underline underline-offset-2"
            >
              Speak to a Clinician<ArrowRight size={14} />
            </Link>
          </div>
        </div>
      </div>

      {/* Main footer */}
      <div className="section-padding">
        <div className="container-max">
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
            {/* Brand */}
            <div className="lg:col-span-1">
              <div className="mb-5">
                <Link href="/" aria-label="Care Access Nigeria — Home" className="inline-block">
                  <span className="text-xl font-extrabold text-white tracking-tight leading-none">
                    Care Access<br />
                    <span className="text-teal-300">Nigeria</span>
                  </span>
                </Link>
              </div>

              <p className="text-sm text-white/70 leading-relaxed mb-6">
                Continuous care, with 24/7 clinical advice<br />
                Healthcare that truly knows you
              </p>

              <div className="space-y-3">
                <a
                  href="mailto:info@careaccess.ng"
                  className="flex items-center gap-2.5 text-sm text-white/70 hover:text-white transition-colors duration-200"
                >
                  <Mail size={14} className="text-teal-300 flex-shrink-0" />
                  info@careaccess.ng
                </a>
                <a
                  href="tel:07007001234"
                  className="flex items-center gap-2.5 text-sm text-white/70 hover:text-white transition-colors duration-200"
                >
                  <Phone size={14} className="text-teal-300 flex-shrink-0" />
                  <span>0700 700 1234</span>
                </a>
              </div>

              {/* Socials */}
              <div className="flex items-center gap-3 mt-6">
                {socials.map(({ href, icon: Icon, label }) => (
                  <a
                    key={label}
                    href={href}
                    target="_blank"
                    rel="noopener noreferrer"
                    aria-label={label}
                    className="w-9 h-9 rounded-lg bg-white/10 flex items-center justify-center text-white/70 hover:bg-teal hover:text-white transition-all duration-200 hover:-translate-y-0.5"
                  >
                    <Icon size={15} />
                  </a>
                ))}
              </div>
            </div>

            {/* Quick Links */}
            <div>
              <h3 className="text-sm font-semibold text-white uppercase tracking-widest mb-5">
                Quick Links
              </h3>
              <ul className="space-y-3">
                {quickLinks.map(({ href, label }) => (
                  <li key={href}>
                    <Link
                      href={href}
                      className="text-sm text-white/65 hover:text-white transition-colors duration-200 flex items-center gap-2 group"
                    >
                      <span className="w-1 h-1 rounded-full bg-teal-300 group-hover:w-2 transition-all duration-200" />
                      {label}
                    </Link>
                  </li>
                ))}
              </ul>
            </div>

            {/* Services */}
            <div>
              <h3 className="text-sm font-semibold text-white uppercase tracking-widest mb-5">
                Our Services
              </h3>
              <ul className="space-y-3">
                {services.map(({ href, label }) => (
                  <li key={href}>
                    <Link
                      href={href}
                      className="text-sm text-white/65 hover:text-white transition-colors duration-200 flex items-center gap-2 group"
                    >
                      <span className="w-1 h-1 rounded-full bg-teal-300 group-hover:w-2 transition-all duration-200" />
                      {label}
                    </Link>
                  </li>
                ))}
              </ul>
            </div>

            {/* Membership CTA */}
            <div>
              <h3 className="text-sm font-semibold text-white uppercase tracking-widest mb-5">
                Ready to Join?
              </h3>
              <p className="text-sm text-white/65 leading-relaxed mb-5">
                Stay on top of your health by joining us today. 
              </p>
              <Link
                href="/signup"
                className="inline-flex items-center gap-2 px-5 py-3 bg-teal text-white rounded-lg text-sm font-semibold hover:bg-teal-600 transition-all duration-200 shadow-teal mb-4"
              >
                Get Started Today
              </Link>
            </div>
          </div>
        </div>
      </div>

      {/* Bottom bar */}
      <div className="border-t border-white/10 py-5">
        <div className="container-max">
          <div className="flex flex-col md:flex-row items-center justify-between gap-4 text-xs text-white/40">
            <p>
              &copy; {new Date().getFullYear()} Care Access Nigeria. All rights reserved.
            </p>
            <div className="flex items-center gap-4">
              <Link href="/privacy-policy" className="hover:text-white/70 transition-colors duration-200">
                Privacy Policy
              </Link>
              <span>|</span>
              <Link href="/terms" className="hover:text-white/70 transition-colors duration-200">
                Terms of Service
              </Link>
            </div>
            <p className="flex items-center gap-1">
              Built by <Link href="https://eaglescroft.com.ng" target="_blank" rel="noopener noreferrer" className="hover:text-white/70 transition-colors duration-200">Eaglescroft Limited</Link>
            </p>
          </div>
        </div>
      </div>
    </footer>
  )
}