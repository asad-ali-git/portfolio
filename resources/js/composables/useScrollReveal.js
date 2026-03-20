import { onMounted, onBeforeUnmount } from 'vue'

export function useScrollReveal() {
  let intersectionObserver = null
  let mutationObserver = null

  const observeEl = (el) => {
    if (el.nodeType !== 1) return
    if (!el.classList.contains('reveal')) return
    if (el.classList.contains('visible')) return
    intersectionObserver.observe(el)
  }

  onMounted(() => {
    intersectionObserver = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add('visible')
            intersectionObserver.unobserve(entry.target)
          }
        })
      },
      { threshold: 0.12, rootMargin: '0px 0px -60px 0px' }
    )

    document.querySelectorAll('.reveal').forEach(observeEl)

    mutationObserver = new MutationObserver((mutations) => {
      mutations.forEach((mutation) => {
        mutation.addedNodes.forEach((node) => {
          if (node.nodeType !== 1) return
          observeEl(node)
          node.querySelectorAll?.('.reveal').forEach(observeEl)
        })
      })
    })

    mutationObserver.observe(document.body, { childList: true, subtree: true })
  })

  onBeforeUnmount(() => {
    intersectionObserver?.disconnect()
    mutationObserver?.disconnect()
  })

  return {
    trigger: () => document.querySelectorAll('.reveal').forEach(observeEl),
  }
}
