import { apiFetch, apiFetchWithAuth } from './api'

export interface SignupPayload {
  email: string
  password: string
  full_name: string
  phone?: string
  plan?: 'personal' | 'family' | 'consultation'
  billing_cycle?: 'monthly' | 'yearly'
}

export interface LoginPayload {
  email: string
  password: string
}

export interface AuthResponse {
  success: boolean
  user: { id: string; email: string }
  session: { access_token: string; refresh_token: string }
}

export interface ProfileResponse {
  success: boolean
  profile: {
    id: string
    full_name: string
    phone: string
    role: string
    onboarding_complete: boolean
    memberships: Array<{
      plan: string
      billing_cycle: string
      status: string
      next_billing_date: string | null
    }>
  }
}

export function signup(payload: SignupPayload): Promise<AuthResponse> {
  return apiFetch<AuthResponse>('/api/auth/signup', {
    method: 'POST',
    body: JSON.stringify(payload),
  })
}

export function login(payload: LoginPayload): Promise<AuthResponse> {
  return apiFetch<AuthResponse>('/api/auth/login', {
    method: 'POST',
    body: JSON.stringify(payload),
  })
}

export function getMe(token: string): Promise<ProfileResponse> {
  return apiFetchWithAuth<ProfileResponse>('/api/auth/me', token)
}
