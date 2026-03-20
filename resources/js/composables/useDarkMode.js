import { ref, watch } from 'vue'

export function useDarkMode() {
  const isDark = ref(localStorage.getItem('theme') !== 'light')

  const applyTheme = (dark) => {
    document.documentElement.classList.toggle('dark', dark)
    localStorage.setItem('theme', dark ? 'dark' : 'light')
  }

  const toggleDark = () => {
    isDark.value = !isDark.value
  }

  watch(isDark, applyTheme, { immediate: true })

  return { isDark, toggleDark }
}
