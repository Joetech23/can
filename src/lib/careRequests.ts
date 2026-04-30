import { apiFetch } from './api'

export interface CareRequestPayload {
  full_name: string
  email: string
  phone: string
  service_types: string[]
  location?: string
  notes?: string
}

export interface CareRequestResponse {
  success: boolean
  message: string
}

export function submitCareRequest(payload: CareRequestPayload): Promise<CareRequestResponse> {
  return apiFetch<CareRequestResponse>('/api/care-requests', {
    method: 'POST',
    body: JSON.stringify(payload),
  })
}
