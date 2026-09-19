import { images } from './utils'

// Primary calls to action used across the site
export const ctas = {
  requestHomeCare:   { label: 'Request Home Care',            href: '/request-home-care' },
  speakToTeam:       { label: 'Speak to Our Team',            href: '/contact' },
  bookConsultation:  { label: 'Book a Consultation',          href: '/book' },
  speakToClinician:  { label: 'Speak to a Clinician',         href: '/book' },
  arrangeLovedOne:   { label: 'Arrange Care for a Loved One', href: '/request-home-care' },
}

export interface ServiceList {
  heading: string
  items: string[]
}

export interface Service {
  id: string
  number: string
  name: string
  tagline: string
  body: string[]
  lists: ServiceList[]
  closing?: string
  notice?: string
  cta: { label: string; href: string }
  image: string
  imageAlt: string
}

export const services: Service[] = [
  {
    id: 'home-care',
    number: '01',
    name: 'Home Care Services',
    tagline: 'Professional care in the comfort of your home.',
    body: [
      'Our home care service provides personalised support for individuals who need assistance because of age, illness, recovery, disability or changing care needs.',
      'Depending on your requirements, we can arrange qualified nurses, carers and doctors to provide care at home.',
    ],
    lists: [
      {
        heading: 'Our home care services include:',
        items: [
          'Nursing care',
          'Personal and daily care',
          'Elderly care',
          'Carer support',
          'Post-operative care',
          'Post-hospital and recovery care',
          'Long-term care',
          'Complex care support',
          'Doctor home visits',
          'Hospital bedside care',
          'Care for people living with long-term conditions',
        ],
      },
    ],
    cta: ctas.requestHomeCare,
    image: images.doctorWithFamilies,
    imageAlt: 'A Care Access Nigeria clinician supporting a family at home',
  },
  {
    id: 'telemedicine',
    number: '02',
    name: 'Telemedicine & Care Coordination',
    tagline: 'Access a doctor and coordinate your healthcare from wherever you are.',
    body: [
      'Not every healthcare concern requires a hospital visit.',
      'Our telemedicine service allows you to speak with a qualified doctor by telephone or video, while our care coordination service helps connect the different parts of your healthcare journey.',
      'From arranging consultations and referrals to coordinating diagnostics, medication and follow-up care, we help make healthcare easier to navigate.',
    ],
    lists: [
      {
        heading: 'Telemedicine includes:',
        items: [
          'Video consultations',
          'Telephone consultations',
          'Doctor consultations',
          'Medical advice',
          'Follow-up consultations',
          'Medication reviews',
          'Prescription guidance where clinically appropriate',
          'Specialist referral guidance',
        ],
      },
      {
        heading: 'Care coordination includes:',
        items: [
          'Hospital coordination',
          'Specialist referrals',
          'Laboratory and diagnostic coordination',
          'Pharmacy coordination',
          'Medication delivery coordination',
          'Follow-up care',
          'Ongoing care management',
        ],
      },
    ],
    closing: 'One point of contact. Connected care. Less stress.',
    cta: ctas.bookConsultation,
    image: images.femaleDoctorVirtual,
    imageAlt: 'A doctor holding a video consultation',
  },
  {
    id: 'clinical-support',
    number: '03',
    name: 'Clinical & Emergency Support',
    tagline: 'Professional guidance when you need to know what to do next.',
    body: [
      'Healthcare situations can be stressful, particularly when they happen unexpectedly.',
      'Our clinical and emergency support service provides access to professional healthcare guidance to help individuals and families understand a situation, determine the appropriate next step and access further care when required.',
      'Our team can provide guidance around symptoms and urgent health concerns, and where appropriate help coordinate access to hospitals, ambulance services, doctors, nurses and other healthcare providers.',
    ],
    lists: [
      {
        heading: 'Support can include:',
        items: [
          'Clinical advice',
          'Urgent healthcare guidance',
          'Symptom assessment and guidance',
          'Medication guidance',
          'Advice on appropriate escalation',
          'Emergency healthcare coordination',
          'Hospital coordination',
          'Ambulance coordination',
          'Urgent doctor or nurse access',
          'Family support during healthcare emergencies',
        ],
      },
    ],
    closing: 'Clear advice. Professional guidance. The right next step.',
    notice:
      'If someone is experiencing a life-threatening emergency, contact the appropriate emergency services immediately.',
    cta: ctas.speakToClinician,
    image: images.nursePhoneCall,
    imageAlt: 'A nurse giving clinical guidance over the phone',
  },
]

export const homeCareSupportOptions = [
  'Nursing care',
  'Personal and daily care',
  'Elderly care',
  'Carer support',
  'Post-operative care',
  'Post-hospital and recovery care',
  'Long-term care',
  'Complex care support',
  'Doctor home visits',
  'Hospital bedside care',
  'Care for a long-term condition',
  'Not sure yet',
]
