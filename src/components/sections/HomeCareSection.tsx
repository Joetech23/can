'use client'

import { useState } from 'react'
import AnimatedSection from '@/components/ui/AnimatedSection'
import {
  ArrowRight,
  X,
  CheckCircle2,
  HeartPulse,
  BedDouble,
  UserRound,
  Stethoscope,
  ActivitySquare,
  HandHeart,
} from 'lucide-react'
import HomeCareRequestForm from './HomeCareRequestForm'

const careTypes = [
  { icon: HeartPulse,      label: 'In-home nursing care' },
  { icon: BedDouble,       label: 'Hospital bedside support' },
  { icon: UserRound,       label: 'Elderly care assistance' },
  { icon: Stethoscope,     label: 'Post-surgical support' },
  { icon: ActivitySquare,  label: 'Recovery support' },
  { icon: HandHeart,       label: 'Ongoing healthcare assistance' },
]

export default function HomeCareSection() {
  const [open, setOpen] = useState(false)

  function openModal() {
    setOpen(true)
  }

  function closeModal() {
    setOpen(false)
  }

  return (
    <>
      {/* ── Section ─────────────────────────────────────────────────────────── */}
      <section className="section-padding bg-white" aria-labelledby="home-care-heading">
        <div className="container-max">
          <AnimatedSection className="text-center mb-12">
            <div className="section-tag bg-teal/10 text-teal mx-auto mb-5 uppercase tracking-widest text-xs font-bold">
              Home Care Support
            </div>
            <h2
              id="home-care-heading"
              className="text-3xl md:text-4xl font-extrabold text-navy leading-tight mb-5 max-w-2xl mx-auto"
            >
              Professional healthcare{' '}
              <span className="text-teal">in your home or hospital room</span>
            </h2>
            <p className="text-base md:text-lg text-gray-500 max-w-2xl mx-auto leading-relaxed">
              Professional healthcare support tailored to individuals who may require hands-on,
              in-person assistance, at home or at the bedside.
            </p>
          </AnimatedSection>

          {/* Care types grid */}
          <AnimatedSection>
            <div className="grid grid-cols-2 md:grid-cols-3 gap-4 mb-10 max-w-3xl mx-auto">
              {careTypes.map(({ icon: Icon, label }) => (
                <div
                  key={label}
                  className="flex items-center gap-3 p-4 rounded-xl border border-gray-100 bg-[#F5F8FC]"
                >
                  <div className="w-9 h-9 rounded-lg bg-teal/10 flex items-center justify-center flex-shrink-0">
                    <Icon size={18} className="text-teal" />
                  </div>
                  <span className="text-sm font-medium text-navy leading-snug">{label}</span>
                </div>
              ))}
            </div>
          </AnimatedSection>

          {/* Info strip */}
          <AnimatedSection>
            <div className="max-w-3xl mx-auto rounded-2xl border border-teal/20 bg-teal/5 px-8 py-6 flex flex-col md:flex-row items-center justify-between gap-6 mb-10">
              <div>
                <p className="font-semibold text-navy mb-1">
                  Our team will assess your care needs and assign a suitable clinician.
                </p>
                <p className="text-sm text-gray-500 leading-relaxed">
                  Pricing is tailored based on individual care requirements, location, and duration.
                  We will contact you with a personalised care plan and quote.
                </p>
              </div>
              <button
                onClick={openModal}
                className="btn-primary whitespace-nowrap flex-shrink-0"
              >
                Request Assessment <ArrowRight size={16} />
              </button>
            </div>
          </AnimatedSection>

          {/* Reassurance bullets */}
          <AnimatedSection>
            <div className="max-w-2xl mx-auto grid sm:grid-cols-3 gap-4 text-center">
              {[
                'Qualified nurses and care assistants',
                'Flexible home or hospital support',
                'Care coordinated with your clinical team',
              ].map((item) => (
                <div key={item} className="flex flex-col items-center gap-2">
                  <CheckCircle2 size={20} className="text-teal" />
                  <span className="text-sm text-gray-600 leading-snug">{item}</span>
                </div>
              ))}
            </div>
          </AnimatedSection>
        </div>
      </section>

      {/* ── Modal ───────────────────────────────────────────────────────────── */}
      {open && (
        <div
          className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm"
          role="dialog"
          aria-modal="true"
          aria-labelledby="hc-modal-title"
          onClick={(e) => { if (e.target === e.currentTarget) closeModal() }}
        >
          <div className="relative w-full max-w-xl max-h-[90vh] overflow-y-auto bg-white rounded-2xl shadow-2xl">
            {/* Modal header */}
            <div className="sticky top-0 z-10 bg-navy px-6 py-5 rounded-t-2xl flex items-start justify-between gap-4">
              <div>
                <p className="text-xs font-bold uppercase tracking-widest text-teal-300 mb-1">
                  Home Care Support
                </p>
                <h3 id="hc-modal-title" className="text-xl font-extrabold text-white">
                  Home Care Support Request Form
                </h3>
              </div>
              <button
                onClick={closeModal}
                className="text-white/60 hover:text-white transition-colors mt-0.5"
                aria-label="Close form"
              >
                <X size={20} />
              </button>
            </div>

            <div className="px-6 py-6">
              <HomeCareRequestForm onClose={closeModal} />
            </div>
          </div>
        </div>
      )}
    </>
  )
}
