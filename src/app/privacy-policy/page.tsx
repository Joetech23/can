import type { Metadata } from 'next'

export const metadata: Metadata = {
  title: 'Privacy Policy',
  description: 'Care Access Nigeria Privacy Policy — how we collect, use, and protect your personal and health data.',
}

export default function PrivacyPolicyPage() {
  return (
    <div className="min-h-screen bg-white pt-28 pb-20">
      <div className="container-max max-w-3xl">
        <div className="section-tag bg-teal/10 text-teal mb-5">Legal</div>
        <h1 className="text-4xl font-extrabold text-navy mb-3">Privacy Policy</h1>
        <p className="text-gray-400 text-sm mb-10">Last updated: April 2025</p>

        <div className="prose prose-gray max-w-none">
          <p className="text-base text-gray-600 leading-relaxed mb-6">
            Care Access Nigeria is committed to protecting your privacy and handling your personal and health data with the utmost care. This Privacy Policy explains how we collect, use, store, and protect your information.
          </p>

          <h2 className="text-xl font-bold text-navy mt-8 mb-3">Data We Collect</h2>
          <p className="text-base text-gray-600 leading-relaxed mb-4">
            We collect the information you provide when signing up, using our services, or contacting us. This includes your name, contact details, health history, and communication records. Health data is treated with the highest level of confidentiality.
          </p>

          <h2 className="text-xl font-bold text-navy mt-8 mb-3">How We Use Your Data</h2>
          <p className="text-base text-gray-600 leading-relaxed mb-4">
            Your data is used to provide and improve our healthcare services, communicate with you about your care, and comply with legal obligations. We share your health records with partner hospitals and specialists only with your explicit, informed consent.
          </p>

          <h2 className="text-xl font-bold text-navy mt-8 mb-3">Your Rights</h2>
          <p className="text-base text-gray-600 leading-relaxed mb-4">
            You have the right to access, correct, or delete your personal data at any time. To exercise these rights, contact us at info@careaccess.ng.
          </p>

          <h2 className="text-xl font-bold text-navy mt-8 mb-3">Contact</h2>
          <p className="text-base text-gray-600 leading-relaxed">
            For any privacy-related questions or concerns, please contact our team at <a href="mailto:info@careaccess.ng" className="text-teal underline">info@careaccess.ng</a>.
          </p>
        </div>
      </div>
    </div>
  )
}
