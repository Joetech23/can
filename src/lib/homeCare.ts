import { apiFetch } from './api'

export interface HomeCareRequest {
  full_name: string
  phone: string
  email: string
  patient_location: string
  support_type: string
  preferred_start_date: string
  duration: string
  setting: string          // 'home' | 'hospital'
  description: string
}

export async function submitHomeCareRequest(data: HomeCareRequest) {
  return apiFetch<{ success: boolean; message: string }>('/api/home-care', {
    method: 'POST',
    body: JSON.stringify(data),
  })
}
