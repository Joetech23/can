/**
 * Base HTTP client for the CAN Backend API.
 * All frontend data operations go through here — never call Supabase directly from components.
 */

const API_URL = process.env.NEXT_PUBLIC_API_URL

if (!API_URL && typeof window !== 'undefined') {
  console.warn('[CAN] NEXT_PUBLIC_API_URL is not set. API calls will fail.')
}

export class ApiError extends Error {
  status: number
  data?: unknown

  constructor(message: string, status: number, data?: unknown) {
    super(message)
    this.name = 'ApiError'
    this.status = status
    this.data = data
  }
}

/**
 * Base fetch wrapper. Throws ApiError on non-2xx responses.
 */
export async function apiFetch<T = unknown>(
  endpoint: string,
  options: RequestInit = {}
): Promise<T> {
  const res = await fetch(`${API_URL}${endpoint}`, {
    headers: {
      'Content-Type': 'application/json',
      ...options.headers,
    },
    ...options,
  })

  const data = await res.json().catch(() => ({ error: 'Invalid response from server' }))

  if (!res.ok) {
    throw new ApiError(
      data.error || `Request failed with status ${res.status}`,
      res.status,
      data
    )
  }

  return data as T
}

/**
 * Authenticated fetch — attaches the Supabase JWT as a Bearer token.
 */
export async function apiFetchWithAuth<T = unknown>(
  endpoint: string,
  token: string,
  options: RequestInit = {}
): Promise<T> {
  return apiFetch<T>(endpoint, {
    ...options,
    headers: {
      ...options.headers,
      Authorization: `Bearer ${token}`,
    },
  })
}
