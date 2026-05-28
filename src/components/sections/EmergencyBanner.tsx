import AnimatedSection from '@/components/ui/AnimatedSection'
import { ShieldAlert } from 'lucide-react'

export default function EmergencyBanner() {
  return (
    <section className="bg-white py-14 md:py-18" aria-label="Emergency support statement">
      <div className="container-max">
        <AnimatedSection>
          <div className="max-w-3xl mx-auto text-center">
            {/* Icon */}
            <div className="w-14 h-14 rounded-2xl bg-orange/10 flex items-center justify-center mx-auto mb-6">
              <ShieldAlert size={28} className="text-orange" />
            </div>

            {/* Heading */}
            <h2 className="text-2xl md:text-3xl lg:text-4xl font-extrabold text-navy leading-tight mb-5">
              You are not alone{' '}
              <span className="text-teal">during a healthcare emergency.</span>
            </h2>

            {/* Body */}
            <p className="text-base md:text-lg text-gray-500 leading-relaxed mb-4 max-w-2xl mx-auto">
              Many people panic during medical emergencies because they do not know the right
              steps to take, what hospital to go to, or who to speak to quickly.
            </p>
            <p className="text-base md:text-lg text-gray-600 font-medium leading-relaxed max-w-2xl mx-auto">
              Care Access Nigeria provides urgent healthcare guidance and support to help
              individuals and families navigate healthcare situations faster and more confidently.
            </p>
          </div>
        </AnimatedSection>
      </div>
    </section>
  )
}
