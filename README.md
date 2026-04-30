# CAN Frontend

Next.js 14 static site for Care Access Nigeria. UI only — all data flows through the backend API at `NEXT_PUBLIC_API_URL`.

**Static export** → deployed to Hostinger. No server-side rendering, no `/api` routes.

---

## Setup

```bash
npm install
cp .env.example .env.local   # fill in credentials
npm run dev                   # http://localhost:3000
```

---

## Core Rule

> The frontend **never** reads or writes to Supabase directly for data operations.
> Every form submission, booking, and auth call goes through the Express backend via `NEXT_PUBLIC_API_URL`.

`src/lib/supabase.ts` exists only for future client-side auth session management (token refresh etc.). It must not be used to query data tables.

---

## API Layer — `src/lib/`

| File | Functions | Backend endpoint | Status |
|---|---|---|---|
| `api.ts` | `apiFetch()`, `apiFetchWithAuth()` | Base client used by all lib files | ✅ Done |
| `auth.ts` | `signup()`, `login()`, `getMe()` | `/api/auth/*` | ✅ Done |
| `contact.ts` | `submitContactForm()` | `POST /api/contact` | ✅ Done |
| `bookings.ts` | `createBooking()`, `verifyBookingPayment()` | `POST /api/bookings`, `POST /api/bookings/verify-payment` | ✅ Done |
| `supabase.ts` | Supabase anon client | Session management only | ✅ Done |

**Missing lib files still needed:**
- `enquiries.ts` — `submitOrgEnquiry()` → `POST /api/enquiries/organisation`
- `care.ts` — `submitCareRequest()` → `POST /api/requests/additional-care`
- `memberships.ts` — `submitMembershipEnquiry()` → `POST /api/memberships/enquiry`

---

## Pages & Wiring Status

| Route | File | Backend call | Status |
|---|---|---|---|
| `/contact` | `ContactForm.tsx` | `POST /api/contact` via `submitContactForm()` | ✅ Wired |
| `/book` | `app/book/page.tsx` | `POST /api/bookings` + `POST /api/bookings/verify-payment` | ✅ Wired |
| `/signup` | `app/signup/page.tsx` | `handlePay` still uses `setTimeout` — needs `signup()` from `lib/auth.ts` + Paystack subscription | ⚠️ Stub |
| `/org-enquiry` | `app/org-enquiry/page.tsx` | `TODO: POST /api/enquiries/organisation` — backend route missing | ⚠️ Stub |
| `/request-care` | `app/request-care/page.tsx` | `TODO: POST /api/requests/additional-care` — backend route missing | ⚠️ Stub |
| `/become-a-member` | `MembershipForm.tsx` | No endpoint defined yet | ⚠️ Stub |
| `/` `/about` `/services` `/faq` `/pricing` `/terms` `/privacy-policy` | — | Static — no API calls | ✅ Static |

---

## Paystack Integration

### Book a Consultation (`/book`)
Uses `react-paystack` → `usePaystackPayment`. Full flow:
1. `createBooking()` — saves pending record before popup opens
2. `initializePayment({ onSuccess, onClose })` — opens Paystack popup
3. On success: `verifyBookingPayment(reference)` — backend re-verifies server-side
4. Show confirmed screen only after step 3 resolves

### Signup payment (`/signup`) — ⚠️ Not yet wired
`handlePay` currently simulates with `setTimeout`. Needs:
1. Call `signup()` from `lib/auth.ts` with form data
2. On success, open Paystack popup for subscription via `react-paystack`
3. On payment success, call backend to activate membership

---

## Supabase Auth Flow

`src/lib/auth.ts` makes calls to the backend which then calls Supabase Auth. The frontend does **not** call `supabase.auth.signUp()` or `supabase.auth.signInWithPassword()` directly. The backend owns all auth operations.

---

## TODOs Before Phase 1 Launch

- [ ] Wire `signup/page.tsx handlePay` — replace `setTimeout` with `signup()` + Paystack subscription
- [ ] Create `src/lib/enquiries.ts` + wire `org-enquiry/page.tsx`
- [ ] Create `src/lib/care.ts` + wire `request-care/page.tsx`
- [ ] Create `src/lib/memberships.ts` + wire `MembershipForm.tsx`
- [ ] Add `.env.local` with production values before deploying to Hostinger

---

## Build

```bash
npm run build   # generates /out directory
```

Upload the `/out` folder to Hostinger's `public_html`.

> If the build fails, check that all `NEXT_PUBLIC_*` env vars are set in `.env.local`.
