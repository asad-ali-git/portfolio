import { ref, onMounted } from 'vue'
import api from '@/services/api'

export function useFetch(urlOrFn) {
  const data = ref(null)
  const loading = ref(false)
  const error = ref(null)

  const execute = async (...args) => {
    loading.value = true
    error.value = null
    try {
      const response = typeof urlOrFn === 'string'
        ? await api.get(urlOrFn)
        : await urlOrFn(...args)
      data.value = response.data
    } catch (err) {
      error.value = err?.response?.data?.message || 'Something went wrong. Please try again.'
    } finally {
      loading.value = false
    }
  }

  if (typeof urlOrFn === 'string') {
    onMounted(execute)
  }

  return { data, loading, error, execute }
}
