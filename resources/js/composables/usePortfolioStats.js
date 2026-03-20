import { ref, computed } from 'vue'
import api from '@/services/api'

const _loading = ref(false)
const _initialized = ref(false)

const _profile = ref(null)
const _projects = ref([])
const _skills = ref([])
const _experiences = ref([])

export function usePortfolioStats() {
  const init = async () => {
    if (_initialized.value || _loading.value) return
    _loading.value = true
    try {
      const [profileRes, projRes, skillRes, expRes] = await Promise.all([
        api.get('/profile'),
        api.get('/projects'),
        api.get('/skills'),
        api.get('/experiences'),
      ])

      _profile.value = profileRes.data?.data ?? null
      _projects.value = projRes.data?.data ?? []

      const grouped = skillRes.data?.data ?? {}
      _skills.value = Object.values(grouped).flat()

      _experiences.value = expRes.data?.data ?? []
      _initialized.value = true
    } catch (e) {
      console.error('[usePortfolioStats]', e)
    } finally {
      _loading.value = false
    }
  }

  const profile = computed(() => _profile.value)

  const projectCount = computed(() => _projects.value.length)

  const featuredCount = computed(() =>
    _projects.value.filter((p) => p.is_featured).length
  )

  const skillCount = computed(() => _skills.value.length)

  const yearsOfExperience = computed(() =>
    _profile.value?.years_of_experience ?? null
  )

  return {
    loading: _loading,
    profile,
    projectCount,
    featuredCount,
    skillCount,
    yearsOfExperience,
    init,
  }
}
