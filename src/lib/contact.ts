import { apiFetch } from './api'

export interface ContactPayload {
  full_name: string
  email: string
  phone?: string
  subject?: string
  message: string
}

export interface ContactResponse {
  success: boolean
  message: string
}

export function submitContactForm(payload: ContactPayload): Promise<ContactResponse> {
  return apiFetch<ContactResponse>('/api/contact', {
    method: 'POST',
    body: JSON.stringify(payload),
  })
}
