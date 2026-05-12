import type { Metadata } from 'next'
import AnimatedSection from '@/components/ui/AnimatedSection'
import ContactForm from '@/components/sections/ContactForm'
import { Mail, Phone, Clock, MessageCircle } from 'lucide-react'

export const metadata: Metadata = {
  title: 'Contact Us',
  description:
    'Get in touch with Care Access Nigeria. General enquiries, membership questions, partnership proposals, or job applications — we respond to every message.',
  alternates: {
    canonical: 'https://careaccess.ng/contact',
  },
}

const contactDetails = [
  {
    icon: Mail,
    label: 'Email',
    value: 'info@careaccess.ng',
    href: 'mailto:info@careaccess.ng',
    note: 'Responses within one business day',
  },
  {
    icon: Phone,
    label: 'Phone',
    value: '0814 214 2721',
    href: 'tel:08142142721',
    note: '24/7 clinical support for members',
  },
  {
    icon: Clock,
    label: 'General Enquiries',
    value: 'Monday to Friday, 9:00am – 5:00pm',
    href: null,
  },
]

export default function ContactPage() {
  return (
    <>
      {/* Hero */}
      <section className="relative pt-28 pb-28 md:pt-36 md:pb-36 overflow-hidden hero-gradient" aria-label="Contact hero">
        <div className="absolute inset-0 bg-navy-mesh" />
        <div className="absolute bottom-0 left-0 right-0">
          <svg viewBox="0 0 1440 90" fill="none" preserveAspectRatio="none">
            <path d="M0 90L1440 90L1440 40C1200 90 900 0 720 0C540 0 240 90 0 40L0 90Z" fill="white" />
          </svg>
        </div>
        <div className="relative z-10 container-max text-center">
          <AnimatedSection>
            <div className="section-tag bg-teal/20 text-teal-200 mx-auto mb-5">Get in Touch</div>
            <h1 className="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-5 max-w-3xl mx-auto">
              We&apos;d love to hear from you
            </h1>
            <p className="text-base md:text-xl text-white/70 max-w-2xl mx-auto leading-relaxed">
              Whether you have a general question, want to enquire about membership, or are interested in joining our team — fill in the form below and we&apos;ll get back to you.
            </p>
          </AnimatedSection>
        </div>
      </section>

      {/* Main content */}
      <section className="section-padding bg-white relative -mt-px" aria-labelledby="contact-form-heading">
        <div className="container-max">
          <div className="grid lg:grid-cols-3 gap-12">
            {/* Contact details */}
            <div className="lg:col-span-1">
              <AnimatedSection animation="fade-right">
                <h2 id="contact-form-heading" className="text-2xl font-extrabold text-navy mb-6">
                  Contact details
                </h2>

                <div className="space-y-5 mb-8">
                  {contactDetails.map(({ icon: Icon, label, value, href, note }) => (
                    <div key={label} className="flex gap-4">
                      <div className="w-10 h-10 rounded-xl bg-teal/10 flex items-center justify-center flex-shrink-0">
                        <Icon size={18} className="text-teal" />
                      </div>
                      <div>
                        <p className="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-0.5">{label}</p>
                        {href ? (
                          <a href={href} className="font-semibold text-navy hover:text-teal transition-colors duration-200 text-sm">
                            {value}
                          </a>
                        ) : (
                          <p className="font-semibold text-navy text-sm">{value}</p>
                        )}
                        <p className="text-xs text-gray-400 mt-0.5">{note}</p>
                      </div>
                    </div>
                  ))}
                </div>

                {/* WhatsApp */}
                <div className="p-5 bg-[#25D366]/10 rounded-2xl border border-[#25D366]/20">
                  <div className="flex items-center gap-3 mb-3">
                    <div className="w-10 h-10 rounded-xl bg-[#25D366] flex items-center justify-center">
                      <MessageCircle size={18} className="text-white" />
                    </div>
                    <div>
                      <p className="font-bold text-navy text-sm">WhatsApp</p>
                      <p className="text-xs text-gray-500">Quick responses via chat</p>
                    </div>
                  </div>
                  <a
                    href="https://wa.me/2348142142721?text=Hello%20Care%20Access%20Nigeria%2C%20I%20have%20a%20question."
                    target="_blank"
                    rel="noopener noreferrer"
                    className="block w-full py-2.5 bg-[#25D366] text-white text-center rounded-xl text-sm font-semibold hover:bg-[#1ebe5d] transition-colors duration-200"
                  >
                    Chat on WhatsApp
                  </a>
                </div>

                {/* <div className="mt-8 p-5 bg-gray-50 rounded-2xl border border-gray-100">
                  <p className="text-xs font-bold text-navy uppercase tracking-wide mb-2">Important note</p>
                  <p className="text-xs text-gray-500 leading-relaxed">
                    We do not list a street address for general enquiries. Members have 24/7 nurse access; general enquiries are responded to within business hours.
                  </p>
                </div> */}
              </AnimatedSection>
            </div>

            {/* Form */}
            <div className="lg:col-span-2">
              <AnimatedSection animation="fade-left">
                <ContactForm />
              </AnimatedSection>
            </div>
          </div>
        </div>
      </section>
    </>
  )
}