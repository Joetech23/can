import { apiFetchWithAuth } from './api'

export interface ActivateMembershipPayload {
  paystack_reference: string
  plan: 'personal' | 'family'
  billing_cycle: 'monthly' | 'yearly'
}

export interface ActivateMembershipResponse {
  success: boolean
  message: string
  next_billing_date: string
}

/**
 * Verify Paystack payment server-side and activate membership.
 * Must be called with the user's access token from signup.
 */
export function activateMembership(
  payload: ActivateMembershipPayload,
  accessToken: string
): Promise<ActivateMembershipResponse> {
  return apiFetchWithAuth<ActivateMembershipResponse>(
    '/api/memberships/activate',
    accessToken,
    {
      method: 'POST',
      body: JSON.stringify(payload),
    }
  )
}
