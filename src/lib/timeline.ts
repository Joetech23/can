import { apiFetchWithAuth } from './api'

export interface TimelineEvent {
  id:          string
  patient_id:  string
  actor_id:    string | null
  event_type:  string
  description: string
  metadata:    Record<string, unknown>
  created_at:  string
}

export interface TimelineResponse {
  success: boolean
  events:  TimelineEvent[]
  total:   number
  limit:   number
  offset:  number
}

export function getPatientTimeline(
  patientId: string,
  token: string,
  limit = 20,
  offset = 0
): Promise<TimelineResponse> {
  return apiFetchWithAuth(
    `/api/timeline/${patientId}?limit=${limit}&offset=${offset}`,
    token
  )
}
