import { clsx, type ClassValue } from 'clsx'
import { twMerge } from 'tailwind-merge'

export function cn(...inputs: ClassValue[]) {
  return twMerge(clsx(inputs))
}

export const images = {
  patientQueue: 'https://res.cloudinary.com/dx2bbdxnw/image/upload/v1776377036/patient-on-queue_waiting_for_doctors_g3nkk9.png',
  familiesWithDoctor: 'https://res.cloudinary.com/dx2bbdxnw/image/upload/v1776377036/families-with-personal-doctor_espscd.jpg',
  femaleNurseOnLaptop: 'https://res.cloudinary.com/dx2bbdxnw/image/upload/v1776377035/young_female_nurse_on_laptop_awsutm.jpg',
  virtualMaleSession: 'https://res.cloudinary.com/dx2bbdxnw/image/upload/v1776377035/virtual_male_session_on_syste_with_client_elfm6d.jpg',
  maleDoctorVirtual: 'https://res.cloudinary.com/dx2bbdxnw/image/upload/v1776377035/male_doctor_virtual_session_with_personal_doctor_rcxlcr.jpg',
  maleDoctorSession: 'https://res.cloudinary.com/dx2bbdxnw/image/upload/v1776377035/male_doctor_on_session_with_client_jm7rdl.jpg',
  femaleNurseCall: 'https://res.cloudinary.com/dx2bbdxnw/image/upload/v1776377035/female_nurse_on_a_call_x4u9e1.jpg',
  femaleNurseSmiling: 'https://res.cloudinary.com/dx2bbdxnw/image/upload/v1776377035/female_nurse_on_phone_smilling_hf1fp8.jpg',
  doctorWithFamilies: 'https://res.cloudinary.com/dx2bbdxnw/image/upload/v1776377034/doctor_with_families_vjxq4i.jpg',
  doctorOneOnOne: 'https://res.cloudinary.com/dx2bbdxnw/image/upload/v1776377034/doctor_one_on_one_call_with_client_rdtz6m.jpg',
  femaleDoctorVirtual: 'https://res.cloudinary.com/dx2bbdxnw/image/upload/v1776377034/female_doctor_virtual_session_hyypul.jpg',
  maleDoctorExplaining: 'https://res.cloudinary.com/dx2bbdxnw/image/upload/v1776377034/male_doctor_explaining_one_on_one_with_client_xad18b.jpg',
  femaleDoctorSmiling: 'https://res.cloudinary.com/dx2bbdxnw/image/upload/v1776377034/female_doctor_smilling_on_phone_call_with_client_ypb4ca.jpg',
  doctorVideoCall: 'https://res.cloudinary.com/dx2bbdxnw/image/upload/v1776377034/doctor-video-call-consultant-telehealth-black-man-healthcare-diagnosis-medical-advice-portrait-african-male-health-expert-online-consultation-checkup-appointment_590464-84577_fhesgu.avif',
  doctorConsulting: 'https://res.cloudinary.com/dx2bbdxnw/image/upload/v1776377033/doctor_consulting_patiient_bybz4t.jpg',
  nursePhoneCall: 'https://res.cloudinary.com/dx2bbdxnw/image/upload/v1776377033/247_phone_call_nurse_yb20i3.jpg',
  adminAjax: 'https://res.cloudinary.com/dx2bbdxnw/image/upload/v1776377033/admin-ajax_isbrpn.avif',
  personalDoctor: 'https://res.cloudinary.com/dx2bbdxnw/image/upload/v1776928863/personal_doctor_idlih4.jpg',
  aboutUsPicture: 'https://res.cloudinary.com/dx2bbdxnw/image/upload/v1776928862/about_us_picture_wmnlun.jpg',
  ourDifferencePicture: 'https://res.cloudinary.com/dx2bbdxnw/image/upload/v1776929135/alamy_2WEPRDW_cwjbbo.jpg',
}
