import type { Metadata, Viewport } from 'next'
import './globals.css'
import Navbar from '@/components/layout/Navbar'
import Footer from '@/components/layout/Footer'
import WhatsAppButton from '@/components/layout/WhatsAppButton'

const BASE_URL = 'https://careaccess.ng'
const OG_IMAGE = 'https://res.cloudinary.com/dx2bbdxnw/image/upload/v1776377034/doctor_with_families_vjxq4i.jpg'

export const metadata: Metadata = {
  metadataBase: new URL(BASE_URL),

  title: {
    default: 'Care Access Nigeria | Clear, Reliable Care When You Need It',
    template: '%s | Care Access Nigeria',
  },
  description:
    'Care Access Nigeria gives every member a dedicated care team that understands their medical history, 24/7 clinical nurse advice, teleconsultation, home visits, and end-to-end care coordination — delivered with transparency and trust.',

  keywords: [
    'dedicated care team Nigeria',
    'telemedicine Nigeria',
    'virtual clinic Nigeria',
    'online doctor Nigeria',
    'teleconsultation Nigeria',
    '24/7 nurse Nigeria',
    'health membership Nigeria',
    'family doctor Nigeria',
    'care access Nigeria',
    'care coordination Nigeria',
    'home nurse visit Nigeria',
    'healthcare access Nigeria',
    'medical subscription Nigeria',
    'private doctor Lagos',
    'doctor on call Nigeria',
  ],

  authors: [{ name: 'Care Access Nigeria', url: BASE_URL }],
  creator: 'Care Access Nigeria',
  publisher: 'Care Access Nigeria',

  // ── Favicons & icons (Next.js metadata API) ──────────────────────────────
  icons: {
    icon: [
      { url: '/favicon.ico',          sizes: 'any' },
      { url: '/favicon-16x16.png',    sizes: '16x16',  type: 'image/png' },
      { url: '/favicon-32x32.png',    sizes: '32x32',  type: 'image/png' },
      { url: '/favicon-96x96.png',    sizes: '96x96',  type: 'image/png' },
      { url: '/favicon-192x192.png',  sizes: '192x192', type: 'image/png' },
    ],
    apple: [
      { url: '/apple-touch-icon.png', sizes: '180x180', type: 'image/png' },
    ],
    other: [
      { rel: 'mask-icon', url: '/favicon-96x96.png' },
    ],
  },

  // ── PWA manifest ─────────────────────────────────────────────────────────
  manifest: '/manifest.json',

  // ── Open Graph ───────────────────────────────────────────────────────────
  openGraph: {
    type: 'website',
    locale: 'en_NG',
    url: BASE_URL,
    siteName: 'Care Access Nigeria',
    title: 'Care Access Nigeria | Clear, Reliable Care When You Need It',
    description:
      'A dedicated care team, 24/7 clinical advice, and expert care coordination — for individuals, families, and organisations across Nigeria.',
    images: [
      {
        url: OG_IMAGE,
        width: 1200,
        height: 630,
        alt: 'Care Access Nigeria — Personal Healthcare',
        type: 'image/jpeg',
      },
    ],
  },

  // ── Twitter / X ──────────────────────────────────────────────────────────
  twitter: {
    card: 'summary_large_image',
    site: '@careaccessng',
    creator: '@careaccessng',
    title: 'Care Access Nigeria | Clear, Reliable Care When You Need It',
    description:
      'Get a dedicated care team, 24/7 clinical advice, and expert care coordination. Plans from ₦25,000/month.',
    images: [OG_IMAGE],
  },

  // ── Robots ───────────────────────────────────────────────────────────────
  robots: {
    index: true,
    follow: true,
    nocache: false,
    googleBot: {
      index: true,
      follow: true,
      noimageindex: false,
      'max-video-preview': -1,
      'max-image-preview': 'large',
      'max-snippet': -1,
    },
  },

  // ── Verification (fill in once verified) ─────────────────────────────────
  verification: {
    google: 'your-google-verification-code',
    // yandex: 'your-yandex-code',
  },

  // ── Canonical ────────────────────────────────────────────────────────────
  alternates: {
    canonical: BASE_URL,
    languages: { 'en-NG': BASE_URL },
  },

  // ── App-specific ─────────────────────────────────────────────────────────
  applicationName: 'Care Access Nigeria',
  referrer: 'origin-when-cross-origin',
  category: 'health',
  classification: 'Healthcare',
  formatDetection: {
    telephone: true,
    email: true,
    address: true,
  },
}

export const viewport: Viewport = {
  width: 'device-width',
  initialScale: 1,
  minimumScale: 1,
  maximumScale: 5,
  userScalable: true,
  themeColor: [
    { media: '(prefers-color-scheme: light)', color: '#0a1f44' },
    { media: '(prefers-color-scheme: dark)',  color: '#0a1f44' },
  ],
}

export default function RootLayout({
  children,
}: Readonly<{
  children: React.ReactNode
}>) {
  return (
    <html lang="en-NG" className="scroll-smooth">
      <head>
        {/* Fonts */}
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossOrigin="anonymous" />
        <link
          href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Inter:wght@300;400;500;600;700;800&display=swap"
          rel="stylesheet"
        />

        {/* Preload critical assets */}
        <link rel="preload" href="/logo.png" as="image" />

        {/* MS Tile */}
        <meta name="msapplication-TileColor" content="#033661" />
        <meta name="msapplication-TileImage" content="/icons/icon-144x144.png" />
        <meta name="msapplication-config" content="/browserconfig.xml" />

        {/* PWA iOS safari */}
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-status-bar-style" content="default" />
        <meta name="apple-mobile-web-app-title" content="CareAccess" />

        {/* Geo targeting */}
        <meta name="geo.region" content="NG" />
        <meta name="geo.placename" content="Nigeria" />

        {/* Structured Data — MedicalOrganization */}
        <script
          type="application/ld+json"
          dangerouslySetInnerHTML={{
            __html: JSON.stringify({
              '@context': 'https://schema.org',
              '@type': 'MedicalOrganization',
              name: 'Care Access Nigeria',
              alternateName: 'CAN',
              url: BASE_URL,
              logo: `${BASE_URL}/logo.png`,
              image: OG_IMAGE,
              description:
                'Care Access Nigeria is a virtual healthcare access platform providing a dedicated care team, 24/7 clinical nurse advice, teleconsultation, home visits, specialist referrals, and end-to-end care coordination across Nigeria.',
              foundingDate: '2023',
              areaServed: {
                '@type': 'Country',
                name: 'Nigeria',
              },
              contactPoint: [
                {
                  '@type': 'ContactPoint',
                  email: 'info@careaccess.ng',
                  contactType: 'customer support',
                  availableLanguage: 'English',
                  hoursAvailable: {
                    '@type': 'OpeningHoursSpecification',
                    dayOfWeek: ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'],
                    opens: '00:00',
                    closes: '23:59',
                  },
                },
              ],
              sameAs: [
                'https://instagram.com/careaccesng',
                'https://twitter.com/careaccessng',
                'https://facebook.com/careaccessng',
                'https://linkedin.com/company/care-access-nigeria',
              ],
              medicalSpecialty: [
                'General Practice',
                'Family Medicine',
                'Telehealth',
                'Care Coordination',
              ],
              hasOfferCatalog: {
                '@type': 'OfferCatalog',
                name: 'Care Access Nigeria Membership Plans',
                itemListElement: [
                  {
                    '@type': 'Offer',
                    name: 'Personal Care',
                    description: 'A dedicated care team that understands your medical history, 24/7 clinical advice, and care coordination for individuals.',
                    price: '25000',
                    priceCurrency: 'NGN',
                    priceSpecification: { '@type': 'UnitPriceSpecification', billingDuration: 'P1M' },
                  },
                  {
                    '@type': 'Offer',
                    name: 'Extended Care',
                    description: 'Enhanced care plan with more frequent consultations, chronic condition management, and home nurse visits.',
                    price: '45000',
                    priceCurrency: 'NGN',
                    priceSpecification: { '@type': 'UnitPriceSpecification', billingDuration: 'P1M' },
                  },
                  {
                    '@type': 'Offer',
                    name: 'Family Care',
                    description: 'Comprehensive family healthcare covering up to 4 members with shared doctor access.',
                    price: '85000',
                    priceCurrency: 'NGN',
                    priceSpecification: { '@type': 'UnitPriceSpecification', billingDuration: 'P1M' },
                  },
                ],
              },
            }),
          }}
        />
      </head>
      <body className="antialiased">
        <Navbar />
        <main>{children}</main>
        <Footer />
        <WhatsAppButton />
      </body>
    </html>
  )
}
