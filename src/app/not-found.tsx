import Link from 'next/link'
import { ArrowLeft, Home, Phone } from 'lucide-react'

export default function NotFound() {
  return (
    <div className="min-h-screen flex items-center justify-center bg-white px-4">
      <div className="text-center max-w-lg">
        <div className="text-8xl font-black text-gray-100 mb-4 select-none">404</div>
        <div className="w-14 h-14 rounded-2xl bg-teal/10 flex items-center justify-center mx-auto mb-6">
          <Home size={26} className="text-teal" />
        </div>
        <h1 className="text-3xl font-extrabold text-navy mb-4">Page not found</h1>
        <p className="text-base text-gray-500 leading-relaxed mb-8">
          The page you are looking for does not exist or may have been moved. Let us help you find what you need.
        </p>
        <div className="flex flex-col sm:flex-row gap-4 justify-center">
          <Link href="/" className="btn-primary">
            <ArrowLeft size={16} />
            Back to Home
          </Link>
          <Link href="/contact" className="btn-secondary">
            <Phone size={16} />
            Contact Us
          </Link>
        </div>
      </div>
    </div>
  )
}
