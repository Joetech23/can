import AnimatedSection from '@/components/ui/AnimatedSection'
import { Stethoscope, HeartPulse, Pill, ShieldPlus, FlaskConical, Landmark, ShieldCheck } from 'lucide-react'

/**
 * Nigeria's healthcare regulatory & professional bodies.
 * Framed as the standards our clinicians are LICENSED & REGULATED by —
 * not commercial "partnerships" (these are statutory regulators).
 */
const bodies = [
  { acronym: 'MDCN',   name: 'Medical & Dental Council of Nigeria',          icon: Stethoscope },
  { acronym: 'NMA',    name: 'Nigerian Medical Association',                  icon: HeartPulse },
  { acronym: 'NMCN',   name: 'Nursing & Midwifery Council of Nigeria',       icon: ShieldPlus },
  { acronym: 'PCN',    name: 'Pharmacists Council of Nigeria',               icon: Pill },
  { acronym: 'NAFDAC', name: 'National Agency for Food & Drug Admin. & Control', icon: FlaskConical },
  { acronym: 'NHIA',   name: 'National Health Insurance Authority',          icon: ShieldCheck },
  { acronym: 'FMOH',   name: 'Federal Ministry of Health',                   icon: Landmark },
]

function Chip({ acronym, name, Icon }: { acronym: string; name: string; Icon: typeof Stethoscope }) {
  return (
    <div className="group flex items-center gap-3.5 px-6 py-4 mx-3 rounded-2xl bg-white border border-gray-100 shadow-soft hover:shadow-medium hover:-translate-y-1 transition-all duration-300 whitespace-nowrap">
      <div className="w-11 h-11 rounded-xl bg-teal/10 flex items-center justify-center flex-shrink-0 group-hover:bg-teal group-hover:scale-105 transition-all duration-300">
        <Icon size={20} className="text-teal group-hover:text-white transition-colors duration-300" />
      </div>
      <div className="flex flex-col">
        <span className="text-base font-extrabold text-navy leading-none tracking-tight">{acronym}</span>
        <span className="text-[11px] text-gray-400 font-medium mt-1 max-w-[200px] truncate">{name}</span>
      </div>
    </div>
  )
}

export default function TrustAssociations() {
  // Duplicate the list so the marquee loops seamlessly (translateX -50%)
  const loop = [...bodies, ...bodies]

  return (
    <section className="py-16 md:py-20 bg-[#F5F8FC] overflow-hidden" aria-labelledby="trust-bodies-heading">
      <div className="container-max">
        <AnimatedSection className="text-center mb-10">
          <div className="section-tag bg-teal/10 text-teal mx-auto mb-4">
            Regulated &amp; Recognised
          </div>
          <h2 id="trust-bodies-heading" className="text-2xl md:text-3xl lg:text-4xl font-extrabold text-navy leading-tight mb-3">
            Care delivered to{' '}
            <span className="text-teal">Nigeria&apos;s healthcare standards</span>
          </h2>
          <p className="text-sm md:text-base text-gray-500 max-w-2xl mx-auto">
            Our doctors, nurses and clinical team are licensed and regulated by the foremost
            healthcare bodies in Nigeria — so the care you receive meets recognised national standards.
          </p>
        </AnimatedSection>
      </div>

      {/* Marquee */}
      <AnimatedSection animation="fade-in">
        <div className="relative marquee-track">
          {/* edge fade masks */}
          <div className="pointer-events-none absolute left-0 top-0 bottom-0 w-16 md:w-32 z-10 bg-gradient-to-r from-[#F5F8FC] to-transparent" />
          <div className="pointer-events-none absolute right-0 top-0 bottom-0 w-16 md:w-32 z-10 bg-gradient-to-l from-[#F5F8FC] to-transparent" />

          <div className="flex animate-marquee py-3">
            {loop.map((b, i) => (
              <Chip key={`${b.acronym}-${i}`} acronym={b.acronym} name={b.name} Icon={b.icon} />
            ))}
          </div>
        </div>
      </AnimatedSection>

      <p className="text-center text-xs text-gray-400 mt-8 px-4 max-w-2xl mx-auto">
        Care Access Nigeria operates in line with the standards set by Nigeria&apos;s healthcare
        regulatory and professional bodies.
      </p>
    </section>
  )
}
