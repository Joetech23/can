/**
 * Client-side session management.
 * Stores the Supabase JWT and basic user info in localStorage.
 * All functions guard against SSR (window is undefined on the server).
 */

const TOKEN_KEY = 'can_access_token'
const USER_KEY  = 'can_user'

export interface SessionUser {
  id:    string
  email: string
}

export function setSession(accessToken: string, user: SessionUser): void {
  if (typeof window === 'undefined') return
  localStorage.setItem(TOKEN_KEY, accessToken)
  localStorage.setItem(USER_KEY, JSON.stringify(user))
}

export function getToken(): string | null {
  if (typeof window === 'undefined') return null
  return localStorage.getItem(TOKEN_KEY)
}

export function getSessionUser(): SessionUser | null {
  if (typeof window === 'undefined') return null
  const raw = localStorage.getItem(USER_KEY)
  if (!raw) return null
  try { return JSON.parse(raw) } catch { return null }
}

export function clearSession(): void {
  if (typeof window === 'undefined') return
  localStorage.removeItem(TOKEN_KEY)
  localStorage.removeItem(USER_KEY)
}

export function isAuthenticated(): boolean {
  return !!getToken()
}
