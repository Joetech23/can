import AnimatedSection from '@/components/ui/AnimatedSection'
import { BadgeCheck, ShieldCheck, FileCheck2 } from 'lucide-react'

export default function RegisteredCompany() {
  return (
    <section className="section-padding bg-white overflow-hidden" aria-labelledby="registered-heading">
      <div className="container-max">
        <AnimatedSection animation="scale-up">
          <div className="relative rounded-3xl overflow-hidden bg-navy hero-gradient">
            {/* mesh + glow */}
            <div className="absolute inset-0 bg-navy-mesh" />
            <div className="absolute -top-24 -right-24 w-80 h-80 rounded-full bg-teal/20 blur-3xl" />
            <div className="absolute -bottom-24 -left-24 w-72 h-72 rounded-full bg-teal/10 blur-3xl" />

            <div className="relative z-10 grid lg:grid-cols-2 gap-10 items-center p-10 md:p-14 lg:p-16">

              {/* Left — copy */}
              <div>
                <div className="section-tag bg-white/10 text-teal-200 mb-5">
                  <ShieldCheck size={14} /> Verified &amp; Accountable
                </div>
                <h2 id="registered-heading" className="text-3xl md:text-4xl lg:text-5xl font-extrabold text-white leading-tight mb-5">
                  A registered, accountable{' '}
                  <span className="text-teal-300">healthcare company</span>
                </h2>
                <p className="text-white/70 leading-relaxed mb-8 max-w-lg">
                  Care Access Nigeria is a duly registered company with the Corporate Affairs
                  Commission (CAC) — so you always know exactly who is responsible for your care.
                  Real people, a real company, real accountability.
                </p>

                <div className="flex flex-wrap gap-3">
                  {[
                    { icon: FileCheck2, label: 'CAC Registered Entity' },
                    { icon: BadgeCheck, label: 'Verifiable Company' },
                  ].map(({ icon: Icon, label }) => (
                    <div key={label} className="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white/10 border border-white/15 backdrop-blur-sm">
                      <Icon size={16} className="text-teal-300" />
                      <span className="text-xs font-semibold text-white/85">{label}</span>
                    </div>
                  ))}
                </div>
              </div>

              {/* Right — seal / certificate card */}
              <div className="flex justify-center lg:justify-end">
                <div className="relative chip-float w-full max-w-sm">
                  <div className="relative rounded-2xl bg-white/[0.06] border border-white/15 backdrop-blur-md p-8 text-center overflow-hidden shadow-large">
                    {/* sheen sweep */}
                    <div className="pointer-events-none absolute inset-0 overflow-hidden">
                      <div className="seal-sheen absolute top-0 -left-1/3 h-full w-1/3 bg-gradient-to-r from-transparent via-white/25 to-transparent" />
                    </div>

                    {/* Seal */}
                    <div className="relative mx-auto mb-6 w-24 h-24">
                      <div className="absolute inset-0 rounded-full bg-teal/20 blur-xl" />
                      <div className="relative w-24 h-24 rounded-full bg-gradient-to-br from-teal-400 to-teal-700 flex items-center justify-center shadow-teal ring-4 ring-white/10">
                        <BadgeCheck size={44} className="text-white" strokeWidth={2.2} />
                      </div>
                    </div>

                    <p className="text-[11px] uppercase tracking-[0.25em] text-teal-200 font-bold mb-1">
                      Corporate Affairs Commission
                    </p>
                    <p className="text-xs text-white/50 mb-6">Registered Company &mdash; Nigeria</p>

                    <div className="rounded-xl bg-navy/40 border border-white/10 py-4 px-5">
                      <p className="text-[10px] uppercase tracking-widest text-white/40 font-semibold mb-1.5">
                        Registration Number
                      </p>
                      <p className="text-3xl md:text-4xl font-extrabold text-white tracking-wider font-mono">
                        RC&nbsp;9398994
                      </p>
                    </div>

                    <div className="mt-6 flex items-center justify-center gap-2 text-teal-200">
                      <ShieldCheck size={15} />
                      <span className="text-xs font-semibold">Care Access Nigeria</span>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </AnimatedSection>
      </div>
    </section>
  )
}
