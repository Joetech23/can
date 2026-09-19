import Image from 'next/image'
import Link from 'next/link'
import AnimatedSection from '@/components/ui/AnimatedSection'
import { ArrowRight, CheckCircle2, ShieldAlert } from 'lucide-react'
import { services } from '@/lib/content'

interface ServicesOverviewProps {
  showIntro?: boolean
}

export default function ServicesOverview({ showIntro = true }: ServicesOverviewProps) {
  return (
    <section
      id="services"
      className="section-padding bg-white scroll-mt-20"
      {...(showIntro ? { 'aria-labelledby': 'services-heading' } : { 'aria-label': 'Our services' })}
    >
      <div className="container-max">
        {showIntro && (
          <AnimatedSection className="text-center mb-16 md:mb-20">
            <div className="section-tag bg-navy/10 text-navy mx-auto mb-4">
              Our Services
            </div>
            <h2 id="services-heading" className="text-3xl md:text-4xl lg:text-5xl font-extrabold text-navy leading-tight mb-5">
              Care That <span className="text-teal">Comes to You</span>
            </h2>
            <p className="text-base md:text-lg text-gray-500 max-w-2xl mx-auto leading-relaxed">
              Whether you need ongoing support at home, access to a doctor remotely or professional
              guidance during an urgent situation, Care Access Nigeria is here to help.
            </p>
          </AnimatedSection>
        )}

        <div className="space-y-20 md:space-y-28">
          {services.map((service, i) => {
            const flip = i % 2 === 1
            return (
              <article
                key={service.id}
                id={service.id}
                className="grid lg:grid-cols-12 gap-10 lg:gap-14 items-start scroll-mt-24"
                aria-labelledby={`${service.id}-title`}
              >
                {/* Image */}
                <AnimatedSection
                  animation={flip ? 'fade-left' : 'fade-right'}
                  className={`lg:col-span-5 lg:sticky lg:top-28 ${flip ? 'lg:order-2' : ''}`}
                >
                  <div className="relative rounded-3xl overflow-hidden aspect-[4/5] shadow-large">
                    <Image
                      src={service.image}
                      alt={service.imageAlt}
                      fill
                      className="object-cover"
                      sizes="(max-width: 1024px) 100vw, 40vw"
                    />
                    <div className="absolute inset-0 bg-gradient-to-t from-navy/80 via-navy/10 to-transparent" />
                    <div className="absolute bottom-0 left-0 right-0 p-6 md:p-8">
                      <span className="block text-6xl md:text-7xl font-black text-white/25 leading-none mb-2 select-none">
                        {service.number}
                      </span>
                      <p className="text-white font-bold text-lg leading-snug">{service.name}</p>
                    </div>
                  </div>
                </AnimatedSection>

                {/* Copy */}
                <AnimatedSection
                  animation={flip ? 'fade-right' : 'fade-left'}
                  className={`lg:col-span-7 ${flip ? 'lg:order-1' : ''}`}
                >
                  <p className="text-xs font-bold tracking-[0.2em] uppercase text-teal mb-3">
                    {service.number} <span className="text-gray-300 mx-1.5">/</span> {service.name}
                  </p>
                  <h3
                    id={`${service.id}-title`}
                    className="text-2xl md:text-3xl lg:text-4xl font-extrabold text-navy leading-tight mb-6"
                  >
                    {service.tagline}
                  </h3>

                  <div className="space-y-4 mb-8">
                    {service.body.map((para) => (
                      <p className="text-base md:text-lg text-gray-600 leading-relaxed" key={para}>{para}</p>
                    ))}
                  </div>

                  <div className={`grid gap-6 mb-8 ${service.lists.length > 1 ? 'md:grid-cols-2' : ''}`}>
                    {service.lists.map((list) => (
                      <div key={list.heading} className="rounded-2xl bg-[#F5F8FC] border border-gray-100 p-6">
                        <p className="text-sm font-bold text-navy mb-4">{list.heading}</p>
                        <ul
                          className={`grid gap-x-6 gap-y-3 ${
                            service.lists.length === 1 ? 'sm:grid-cols-2' : ''
                          }`}
                        >
                          {list.items.map((item) => (
                            <li key={item} className="flex items-start gap-2.5">
                              <CheckCircle2 size={16} className="text-teal flex-shrink-0 mt-0.5" />
                              <span className="text-sm text-gray-700 leading-snug">{item}</span>
                            </li>
                          ))}
                        </ul>
                      </div>
                    ))}
                  </div>

                  {service.closing && (
                    <p className="text-lg md:text-xl font-bold text-navy mb-6">{service.closing}</p>
                  )}

                  {service.notice && (
                    <div className="flex items-start gap-3 rounded-xl border border-orange/30 bg-orange/5 px-5 py-4 mb-8">
                      <ShieldAlert size={18} className="text-orange flex-shrink-0 mt-0.5" />
                      <p className="text-sm text-gray-700 leading-relaxed">{service.notice}</p>
                    </div>
                  )}

                  <Link href={service.cta.href} className="btn-primary">
                    {service.cta.label} <ArrowRight size={16} />
                  </Link>
                </AnimatedSection>
              </article>
            )
          })}
        </div>
      </div>
    </section>
  )
}
