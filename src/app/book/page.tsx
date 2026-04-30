'use client'

/**
 * book/page.tsx — thin client wrapper
 *
 * react-paystack accesses `window` at hook-call time, which crashes during
 * Next.js static prerendering. The inner BookContent is imported with
 * ssr: false so the paystack module is never evaluated on the server.
 */
import dynamic from 'next/dynamic'

const BookContent = dynamic(() => import('./BookContent'), {
  ssr: false,
  loading: () => (
    <div className="min-h-screen bg-gray-50 pt-20 flex items-center justify-center">
      <div className="w-10 h-10 border-4 border-navy/20 border-t-navy rounded-full animate-spin" />
    </div>
  ),
})

export default function BookPage() {
  return <BookContent />
}
