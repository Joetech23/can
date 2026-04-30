import { apiFetch, apiFetchWithAuth } from './api'

export interface PatientProfile {
  id:                      string
  user_id:                 string
  allergies:               string | null
  current_medications:     string | null
  chronic_conditions:      string | null
  blood_type:              string | null
  emergency_contact_name:  string | null
  emergency_contact_phone: string | null
  onboarding_completed_at: string | null
  created_at:              string
  updated_at:              string
}

export interface OnboardingPayload {
  allergies?:               string
  current_medications?:     string
  chronic_conditions?:      string
  blood_type?:              string
  emergency_contact_name?:  string
  emergency_contact_phone?: string
}

export interface ClinicalRequest {
  id:          string
  patient_id:  string
  type:        string
  urgency:     string
  description: string
  status:      string
  created_at:  string
}

export interface CreateRequestPayload {
  type?:        'consultation' | 'follow_up' | 'prescription_renewal' | 'lab_test' | 'referral' | 'general'
  urgency?:     'routine' | 'urgent' | 'emergency'
  description:  string
}

/** Submit or update the patient's health profile */
export function submitOnboarding(
  payload: OnboardingPayload,
  token: string
): Promise<{ success: boolean; patient: PatientProfile }> {
  return apiFetchWithAuth('/api/patients/onboarding', token, {
    method: 'POST',
    body:   JSON.stringify(payload),
  })
}

/** Get own patient profile */
export function getMyPatientProfile(
  token: string
): Promise<{ success: boolean; patient: PatientProfile }> {
  return apiFetchWithAuth('/api/patients/me', token)
}

/** Create a new clinical request */
export function createClinicalRequest(
  payload: CreateRequestPayload,
  token: string
): Promise<{ success: boolean; request: ClinicalRequest }> {
  return apiFetchWithAuth('/api/requests', token, {
    method: 'POST',
    body:   JSON.stringify(payload),
  })
}

/** List own requests */
export function listMyRequests(
  token: string
): Promise<{ success: boolean; requests: ClinicalRequest[] }> {
  return apiFetchWithAuth('/api/requests', token)
}
