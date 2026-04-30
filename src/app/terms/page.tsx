import type { Metadata } from 'next'

export const metadata: Metadata = {
  title: 'Terms of Service',
  description: 'Care Access Nigeria Terms of Service — the agreement governing your use of our healthcare access services.',
}

export default function TermsPage() {
  return (
    <div className="min-h-screen bg-white pt-28 pb-20">
      <div className="container-max max-w-3xl">
        <div className="section-tag bg-navy/10 text-navy mb-5">Legal</div>
        <h1 className="text-4xl font-extrabold text-navy mb-3">Terms of Service</h1>
        <p className="text-gray-400 text-sm mb-10">Last updated: April 2025</p>

        <div className="prose prose-gray max-w-none">
          <p className="text-base text-gray-600 leading-relaxed mb-6">
            These Terms of Service govern your use of Care Access Nigeria&apos;s services. By becoming a member or using our platform, you agree to these terms.
          </p>

          <h2 className="text-xl font-bold text-navy mt-8 mb-3">Our Services</h2>
          <p className="text-base text-gray-600 leading-relaxed mb-4">
            Care Access Nigeria provides virtual healthcare access services including teleconsultation, personal doctor access, nurse on call, home visit arrangement, and care coordination. We are not a hospital and do not replace emergency medical services.
          </p>

          <h2 className="text-xl font-bold text-navy mt-8 mb-3">Membership and Cancellation</h2>
          <p className="text-base text-gray-600 leading-relaxed mb-4">
            Memberships are billed monthly. You may cancel your membership at any time before your next billing date. No lock-in or cancellation penalty applies.
          </p>

          <h2 className="text-xl font-bold text-navy mt-8 mb-3">Medical Disclaimer</h2>
          <p className="text-base text-gray-600 leading-relaxed mb-4">
            Our services provide guidance and care coordination. In any life-threatening situation, please go to the nearest hospital immediately. Our team will support you in reaching the right care.
          </p>

          <h2 className="text-xl font-bold text-navy mt-8 mb-3">Contact</h2>
          <p className="text-base text-gray-600 leading-relaxed">
            For questions about these terms, contact us at <a href="mailto:info@careaccess.ng" className="text-teal underline">info@careaccess.ng</a>.
          </p>
        </div>
      </div>
    </div>
  )
}
