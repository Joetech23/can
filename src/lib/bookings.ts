import { apiFetch } from './api'

export interface CreateBookingPayload {
  full_name: string
  email: string
  phone: string
  preferred_date: string   // ISO format: YYYY-MM-DD
  preferred_time: string
  paystack_reference: string
}

export interface VerifyPaymentPayload {
  reference: string
}

export interface BookingResponse {
  success: boolean
  booking: { id: string; paystack_reference: string; status: string }
}

export interface VerifyResponse {
  success: boolean
  message: string
}

/**
 * Save a pending booking BEFORE opening the Paystack popup.
 */
export function createBooking(payload: CreateBookingPayload): Promise<BookingResponse> {
  return apiFetch<BookingResponse>('/api/bookings', {
    method: 'POST',
    body: JSON.stringify(payload),
  })
}

/**
 * Verify payment with Paystack AFTER the popup reports success.
 * Backend re-verifies server-side — this is the source of truth.
 */
export function verifyBookingPayment(reference: string): Promise<VerifyResponse> {
  return apiFetch<VerifyResponse>('/api/bookings/verify-payment', {
    method: 'POST',
    body: JSON.stringify({ reference }),
  })
}
