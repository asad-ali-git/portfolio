import { ref, onMounted, onBeforeUnmount } from 'vue'

export function useActiveSection(sections) {
  const activeSection = ref('')

  const handleScroll = () => {
    const scrollY = window.scrollY + 120

    for (const id of sections) {
      const el = document.getElementById(id)
      if (el && el.offsetTop <= scrollY && el.offsetTop + el.offsetHeight > scrollY) {
        activeSection.value = id
        break
      }
    }
  }

  onMounted(() => {
    window.addEventListener('scroll', handleScroll, { passive: true })
    handleScroll()
  })

  onBeforeUnmount(() => {
    window.removeEventListener('scroll', handleScroll)
  })

  return { activeSection }
}
