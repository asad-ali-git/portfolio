import api from './api'

export const getProfile = () => api.get('/profile')

export const getProjects = () => api.get('/projects')
export const getFeaturedProjects = () => api.get('/projects/featured')
export const getProject = (id) => api.get(`/projects/${id}`)

export const getSkills = () => api.get('/skills')

export const getExperiences = () => api.get('/experiences')

export const sendContactMessage = (payload) => api.post('/contact', payload)
