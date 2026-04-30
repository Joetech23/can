'use client'

import { useState } from 'react'
import { useForm } from 'react-hook-form'
import { CheckCircle2, Loader2, Send } from 'lucide-react'
import { submitContactForm } from '@/lib/contact'

interface FormData {
  fullName: string
  email: string
  phone: string
  reason: string
  message: string
}

export default function ContactForm() {
  const [isSubmitting, setIsSubmitting] = useState(false)
  const [isSuccess, setIsSuccess] = useState(false)
  const [error, setError] = useState('')

  const {
    register,
    handleSubmit,
    formState: { errors },
    reset,
  } = useForm<FormData>()

  const onSubmit = async (data: FormData) => {
    setIsSubmitting(true)
    setError('')
    try {
      await submitContactForm({
        full_name: data.fullName,
        email: data.email,
        phone: data.phone,
        subject: data.reason,
        message: data.message,
      })

      setIsSuccess(true)
      reset()
    } catch {
      setError('Something went wrong. Please try again or email us directly at info@careaccess.ng')
    } finally {
      setIsSubmitting(false)
    }
  }

  if (isSuccess) {
    return (
      <div className="bg-white rounded-3xl p-10 shadow-large border border-gray-50 text-center h-full flex flex-col items-center justify-center">
        <div className="w-16 h-16 rounded-full bg-teal/10 flex items-center justify-center mx-auto mb-5">
          <CheckCircle2 size={32} className="text-teal" />
        </div>
        <h3 className="text-2xl font-bold text-navy mb-3">Message received</h3>
        <p className="text-gray-500 leading-relaxed max-w-sm">
          Thank you for getting in touch. We will respond to your message within 1 business day. For urgent matters, please use our WhatsApp button.
        </p>
        <button
          onClick={() => setIsSuccess(false)}
          className="mt-6 text-sm text-teal underline underline-offset-2 hover:text-teal-600"
        >
          Send another message
        </button>
      </div>
    )
  }

  return (
    <div className="bg-white rounded-3xl p-8 md:p-10 shadow-large border border-gray-50">
      <h2 className="text-2xl font-extrabold text-navy mb-2">Send us a message</h2>
      <p className="text-sm text-gray-500 mb-7">All fields marked with * are required.</p>

      <form onSubmit={handleSubmit(onSubmit)} noValidate className="space-y-5">
        <div className="grid sm:grid-cols-2 gap-5">
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

          {/* Phone */}
          <div>
            <label className="block text-sm font-semibold text-navy mb-1.5">
              Phone Number <span className="text-red-400">*</span>
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

        {/* Email */}
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
              pattern: {
                value: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
                message: 'Please enter a valid email address',
              },
            })}
          />
          {errors.email && <p className="text-xs text-red-400 mt-1">{errors.email.message}</p>}
        </div>

        {/* Reason */}
        <div>
          <label className="block text-sm font-semibold text-navy mb-1.5">
            Reason for contact <span className="text-red-400">*</span>
          </label>
          <select
            className={`form-input ${errors.reason ? 'border-red-300 focus:ring-red-300' : ''}`}
            {...register('reason', { required: 'Please select a reason' })}
          >
            <option value="">Select a reason</option>
            <option value="consultation">Book a consultation</option>
            <option value="general">General inquiries</option>
            <option value="membership">Membership</option>
            <option value="partnership">Partnership</option>
            <option value="jobs">Job vacancies</option>
            <option value="other">Other</option>
          </select>
          {errors.reason && <p className="text-xs text-red-400 mt-1">{errors.reason.message}</p>}
        </div>

        {/* Message */}
        <div>
          <label className="block text-sm font-semibold text-navy mb-1.5">
            Message <span className="text-red-400">*</span>
          </label>
          <textarea
            rows={5}
            placeholder="Tell us how we can help you..."
            className={`form-input resize-none ${errors.message ? 'border-red-300 focus:ring-red-300' : ''}`}
            {...register('message', {
              required: 'Please write a message',
              minLength: { value: 20, message: 'Please write at least 20 characters' },
            })}
          />
          {errors.message && <p className="text-xs text-red-400 mt-1">{errors.message.message}</p>}
        </div>

        {/* Error */}
        {error && (
          <div className="p-4 bg-red-50 border border-red-100 rounded-xl text-sm text-red-600">
            {error}
          </div>
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
              Sending your message...
            </>
          ) : (
            <>
              <Send size={16} />
              Send Message
            </>
          )}
        </button>
      </form>
    </div>
  )
}
