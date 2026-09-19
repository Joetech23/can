import type { Metadata } from 'next'
import Link from 'next/link'
import { CheckCircle2, PhoneCall, ShieldAlert } from 'lucide-react'
import HomeCareRequestForm from '@/components/sections/HomeCareRequestForm'
import { ctas } from '@/lib/content'

export const metadata: Metadata = {
  title: 'Request Home Care',
  description:
    'Request professional home care in Nigeria for yourself or a loved one. Tell us what you need and we will arrange the right nurse, carer or doctor.',
  alternates: {
    canonical: 'https://careaccess.ng/request-home-care',
  },
}

const nextSteps = [
  'We review your request and contact you to understand your needs.',
  'We recommend the most appropriate type of support.',
  'We connect you with the right nurse, carer or doctor.',
  'Care begins according to the agreed plan.',
]

export default function RequestHomeCarePage() {
  return (
    <>
      <section className="relative pt-32 pb-16 md:pt-40 md:pb-20 overflow-hidden hero-gradient" aria-label="Request home care">
        <div className="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-teal/20 blur-3xl" />
        <div className="relative z-10 container-max">
          <div className="max-w-2xl">
            <div className="section-tag bg-white/10 text-teal-200 mb-5">Request Home Care</div>
            <h1 className="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-5">
              Tell us what <span className="text-teal-300">you need.</span>
            </h1>
            <p className="text-base md:text-lg text-white/75 leading-relaxed">
              Whether the care is for you or for a loved one in Nigeria, share a few details and our
              team will help you understand the next step.
            </p>
          </div>
        </div>
      </section>

      <section className="section-padding section-bg-alt">
        <div className="container-max">
          <div className="grid lg:grid-cols-12 gap-10 lg:gap-14 items-start">
            <aside className="lg:col-span-4 space-y-6 lg:sticky lg:top-28">
              <div className="rounded-2xl bg-white border border-gray-100 shadow-soft p-7">
                <h2 className="text-lg font-extrabold text-navy mb-5">What happens next</h2>
                <ol className="space-y-4">
                  {nextSteps.map((step, i) => (
                    <li key={step} className="flex items-start gap-3">
                      <span className="w-6 h-6 rounded-full bg-navy text-white text-[11px] font-black flex items-center justify-center flex-shrink-0">
                        {i + 1}
                      </span>
                      <span className="text-sm text-gray-600 leading-relaxed">{step}</span>
                    </li>
                  ))}
                </ol>
              </div>

              <div className="rounded-2xl bg-navy p-7">
                <p className="text-sm text-white/75 leading-relaxed mb-4">
                  Prefer to talk it through first?
                </p>
                <Link
                  href={ctas.speakToTeam.href}
                  className="inline-flex items-center gap-2 text-sm font-bold text-teal-300 hover:text-white transition-colors"
                >
                  <PhoneCall size={16} /> {ctas.speakToTeam.label}
                </Link>
              </div>

              <div className="flex items-start gap-3 rounded-xl border border-orange/30 bg-orange/5 px-5 py-4">
                <ShieldAlert size={18} className="text-orange flex-shrink-0 mt-0.5" />
                <p className="text-sm text-gray-700 leading-relaxed">
                  If someone is experiencing a life-threatening emergency, contact the appropriate
                  emergency services immediately.
                </p>
              </div>
            </aside>

            <div className="lg:col-span-8">
              <div className="rounded-3xl bg-white border border-gray-100 shadow-medium p-6 md:p-10">
                <div className="flex items-center gap-2 mb-6">
                  <CheckCircle2 size={18} className="text-teal" />
                  <p className="text-sm font-semibold text-navy">
                    Pricing is tailored to the care needed, location and duration.
                  </p>
                </div>
                <HomeCareRequestForm />
              </div>
            </div>
          </div>
        </div>
      </section>
    </>
  )
}
