'use client'

import { useState } from 'react'
import { useForm } from 'react-hook-form'
import { CheckCircle2, Loader2, MessageCircle } from 'lucide-react'
import { submitContactForm } from '@/lib/contact'

interface FormData {
  fullName: string
  email: string
  phone: string
  plan: string
  addons: string
  familyMembers: string
  heardFrom: string
}

const addonServices = ['Lab tests', 'Medication delivery', 'Home nurse visit', 'Home doctor visit']

interface MembershipFormProps {
  defaultPlan?: string
  onSuccess?: () => void
}

export default function MembershipForm({ defaultPlan = '', onSuccess }: MembershipFormProps) {
  const [isSubmitting, setIsSubmitting] = useState(false)
  const [isSuccess, setIsSuccess] = useState(false)
  const [isInquiry, setIsInquiry] = useState(false)
  const [error, setError] = useState('')

  const {
    register,
    handleSubmit,
    watch,
    formState: { errors },
    reset,
  } = useForm<FormData>({ defaultValues: { plan: defaultPlan } })

  const selectedAddons = watch('addons') || ''

  const onSubmit = async (data: FormData) => {
    setIsSubmitting(true)
    setError('')
    try {
      const hasAddons = data.addons && data.addons.trim() !== ''

      const message = [
        `Plan selected: ${data.plan}`,
        hasAddons ? `Add-on service: ${data.addons}` : null,
        data.familyMembers ? `Family members to cover: ${data.familyMembers}` : null,
        data.heardFrom ? `How they heard about us: ${data.heardFrom}` : null,
      ]
        .filter(Boolean)
        .join('\n')

      await submitContactForm({
        full_name: data.fullName,
        email:     data.email,
        phone:     data.phone,
        subject:   hasAddons ? 'Membership Enquiry + Add-on Services' : 'Membership Enquiry',
        message,
      })

      if (hasAddons) {
        setIsInquiry(true)
      } else {
        setIsSuccess(true)
      }
      reset()
    } catch {
      setError('Something went wrong. Please try again or email us at info@careaccess.ng')
    } finally {
      setIsSubmitting(false)
    }
  }

  if (isSuccess) {
    return (
      <div className="bg-white rounded-3xl p-10 shadow-large border border-gray-50 text-center">
        <div className="w-16 h-16 rounded-full bg-teal/10 flex items-center justify-center mx-auto mb-5">
          <CheckCircle2 size={32} className="text-teal" />
        </div>
        <h3 className="text-2xl font-bold text-navy mb-3">You&apos;re on your way!</h3>
        <p className="text-gray-500 leading-relaxed mb-6">
          Thank you for your interest in Care Access Nigeria. A member of our team will be in touch within 24 hours to complete your registration and answer any questions.
        </p>
        <p className="text-sm text-gray-400">A confirmation has been sent to your email address.</p>
      </div>
    )
  }

  if (isInquiry) {
    return (
      <div className="bg-white rounded-3xl p-10 shadow-large border border-gray-50 text-center">
        <div className="w-16 h-16 rounded-full bg-orange/10 flex items-center justify-center mx-auto mb-5">
          <MessageCircle size={32} className="text-orange" />
        </div>
        <h3 className="text-2xl font-bold text-navy mb-3">Inquiry received!</h3>
        <p className="text-gray-500 leading-relaxed mb-6">
          We&apos;ve submitted your inquiry. Someone from our team will be in touch with you soon to discuss your add-on services and confirm the details.
        </p>
        <p className="text-sm text-gray-400">Questions? Email us at info@careaccess.ng</p>
      </div>
    )
  }

  return (
    <div className="bg-white rounded-3xl p-8 md:p-10 shadow-large border border-gray-50">
      <form onSubmit={handleSubmit(onSubmit)} noValidate className="space-y-5">
        {/* Full Name */}
        <div>
          <label className="block text-sm font-semibold text-navy mb-1.5">
            Full Name <span className="text-red-400">*</span>
          </label>
          <input
            type="text"
            placeholder="Your full name"
            className={`form-input ${errors.fullName ? 'border-red-300 focus:ring-red-300' : ''}`}
            {...register('fullName', { required: 'Full name is required' })}
          />
          {errors.fullName && <p className="text-xs text-red-400 mt-1">{errors.fullName.message}</p>}
        </div>

        {/* Email + Phone */}
        <div className="grid sm:grid-cols-2 gap-5">
          <div>
            <label className="block text-sm font-semibold text-navy mb-1.5">
              Email Address <span className="text-red-400">*</span>
            </label>
            <input
              type="email"
              placeholder="your@email.com"
              className={`form-input ${errors.email ? 'border-red-300 focus:ring-red-300' : ''}`}
              {...register('email', {
                required: 'Email address is required',
                pattern: { value: /^[^\s@]+@[^\s@]+\.[^\s@]+$/, message: 'Please enter a valid email' },
              })}
            />
            {errors.email && <p className="text-xs text-red-400 mt-1">{errors.email.message}</p>}
          </div>

          <div>
            <label className="block text-sm font-semibold text-navy mb-1.5">
              Telephone <span className="text-red-400">*</span>
            </label>
            <input
              type="tel"
              placeholder="+234 800 000 0000"
              className={`form-input ${errors.phone ? 'border-red-300 focus:ring-red-300' : ''}`}
              {...register('phone', { required: 'Phone number is required' })}
            />
            {errors.phone && <p className="text-xs text-red-400 mt-1">{errors.phone.message}</p>}
          </div>
        </div>

        {/* Plan */}
        <div>
          <label className="block text-sm font-semibold text-navy mb-1.5">
            Choose a Plan <span className="text-red-400">*</span>
          </label>
          <select
            className={`form-input ${errors.plan ? 'border-red-300 focus:ring-red-300' : ''}`}
            {...register('plan', { required: 'Please select a plan' })}
          >
            <option value="">Select a membership plan</option>
            <option value="payg">Pay-As-You-Go — ₦8,000/consultation</option>
            <option value="personal">Personal Care — ₦25,000/month (Most Popular)</option>
            <option value="extended">Extended Care — ₦45,000/month (Premium)</option>
            <option value="family">Family Care — ₦85,000/month · up to 4 people (Best Value)</option>
          </select>
          {errors.plan && <p className="text-xs text-red-400 mt-1">{errors.plan.message}</p>}
        </div>

        {/* Add-on services */}
        <div>
          <label className="block text-sm font-semibold text-navy mb-1.5">
            Add-on Services{' '}
            <span className="text-gray-400 font-normal">(optional)</span>
          </label>
          <select className="form-input" {...register('addons')}>
            <option value="">None — just the plan</option>
            {addonServices.map((s) => (
              <option key={s} value={s}>{s}</option>
            ))}
            <option value="multiple">Multiple add-ons — team will contact me</option>
          </select>
          {selectedAddons && selectedAddons !== '' && (
            <p className="text-xs text-orange mt-1">
              A team member will contact you to confirm details and pricing for your add-on service.
            </p>
          )}
        </div>

        {/* Number of family members */}
        <div>
          <label className="block text-sm font-semibold text-navy mb-1.5">
            Number of family members to cover{' '}
            <span className="text-gray-400 font-normal">(optional)</span>
          </label>
          <select className="form-input" {...register('familyMembers')}>
            <option value="">Just myself</option>
            <option value="2">2 people</option>
            <option value="3">3 people</option>
            <option value="4">4 people (Family Plan)</option>
            <option value="5+">5 or more — contact us</option>
          </select>
        </div>

        {/* How did you hear */}
        <div>
          <label className="block text-sm font-semibold text-navy mb-1.5">
            How did you hear about us?{' '}
            <span className="text-gray-400 font-normal">(optional)</span>
          </label>
          <select className="form-input" {...register('heardFrom')}>
            <option value="">Select an option</option>
            <option value="social-media">Social media</option>
            <option value="friend-family">Friend or family</option>
            <option value="google">Google search</option>
            <option value="workplace">Workplace / employer</option>
            <option value="news">News or article</option>
            <option value="other">Other</option>
          </select>
        </div>

        {/* Error */}
        {error && (
          <div className="p-4 bg-red-50 border border-red-100 rounded-xl text-sm text-red-600">{error}</div>
        )}

        {/* Submit */}
        <button
          type="submit"
          disabled={isSubmitting}
          className="w-full py-4 bg-teal text-white font-bold rounded-xl text-base transition-all duration-300 hover:bg-teal-600 disabled:opacity-70 disabled:cursor-not-allowed flex items-center justify-center gap-3 shadow-teal hover:shadow-none hover:-translate-y-0.5"
        >
          {isSubmitting ? (
            <>
              <Loader2 size={18} className="animate-spin" />
              Submitting...
            </>
          ) : (
            'Start My Membership'
          )}
        </button>

        <p className="text-center text-xs text-gray-400">
          By submitting, you agree to be contacted by our team to complete your registration. Your data is kept private and secure.
        </p>
      </form>
    </div>
  )
}
