import { apiFetch } from './api'

export interface OrgEnquiryPayload {
  org_name: string
  contact_name: string
  email: string
  phone: string
  team_size: string
  services_interested?: string[]
  message?: string
}

export interface OrgEnquiryResponse {
  success: boolean
  message: string
}

export function submitOrgEnquiry(payload: OrgEnquiryPayload): Promise<OrgEnquiryResponse> {
  return apiFetch<OrgEnquiryResponse>('/api/org-enquiries', {
    method: 'POST',
    body: JSON.stringify(payload),
  })
}
