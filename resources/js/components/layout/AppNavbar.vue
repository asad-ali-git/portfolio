<template>
  <header
    :class="[
      'fixed top-0 left-0 right-0 z-50 transition-all duration-500',
      scrolled
        ? 'bg-white/80 dark:bg-surface-950/80 backdrop-blur-xl border-b border-slate-100 dark:border-white/[0.05]'
        : 'bg-transparent',
    ]"
  >
    <nav class="page-container flex items-center justify-between h-14">
      <a
        href="#hero"
        class="font-mono text-sm font-semibold tracking-tight text-slate-900 dark:text-ink hover:text-accent dark:hover:text-accent transition-colors"
        @click.prevent="scrollTo('hero')"
      >{{ brandSlug }}</a>

      <ul class="hidden md:flex items-center gap-7">
        <li v-for="item in navItems" :key="item.id">
          <a
            :href="`#${item.id}`"
            :class="[
              'text-[13px] font-medium transition-colors duration-200',
              activeSection === item.id
                ? 'text-accent'
                : 'text-slate-500 hover:text-slate-900 dark:text-ink-soft dark:hover:text-ink',
            ]"
            @click.prevent="scrollTo(item.id)"
          >{{ item.label }}</a>
        </li>
      </ul>

      <div class="flex items-center gap-2">
        <button
          class="w-8 h-8 rounded-lg flex items-center justify-center text-slate-400 hover:text-slate-800 dark:text-ink-faint dark:hover:text-ink hover:bg-slate-100 dark:hover:bg-white/[0.06] transition-all"
          :title="isDark ? 'Light mode' : 'Dark mode'"
          @click="toggleDark"
        >
          <svg v-if="isDark" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 2.25a.75.75 0 0 1 .75.75v2.25a.75.75 0 0 1-1.5 0V3a.75.75 0 0 1 .75-.75ZM7.5 12a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM18.894 6.166a.75.75 0 0 0-1.06-1.06l-1.591 1.59a.75.75 0 1 0 1.06 1.061l1.591-1.59ZM21.75 12a.75.75 0 0 1-.75.75h-2.25a.75.75 0 0 1 0-1.5H21a.75.75 0 0 1 .75.75ZM17.834 18.894a.75.75 0 0 0 1.06-1.06l-1.59-1.591a.75.75 0 1 0-1.061 1.06l1.59 1.591ZM12 18a.75.75 0 0 1 .75.75V21a.75.75 0 0 1-1.5 0v-2.25A.75.75 0 0 1 12 18ZM7.758 17.303a.75.75 0 0 0-1.061-1.06l-1.591 1.59a.75.75 0 0 0 1.06 1.061l1.591-1.59ZM6 12a.75.75 0 0 1-.75.75H3a.75.75 0 0 1 0-1.5h2.25A.75.75 0 0 1 6 12ZM6.697 7.757a.75.75 0 0 0 1.06-1.06l-1.59-1.591a.75.75 0 0 0-1.061 1.06l1.59 1.591Z" />
          </svg>
          <svg v-else xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
            <path fill-rule="evenodd" d="M9.528 1.718a.75.75 0 0 1 .162.819A8.97 8.97 0 0 0 9 6a9 9 0 0 0 9 9 8.97 8.97 0 0 0 3.463-.69.75.75 0 0 1 .981.98 10.503 10.503 0 0 1-9.694 6.46c-5.799 0-10.5-4.7-10.5-10.5 0-4.368 2.667-8.112 6.46-9.694a.75.75 0 0 1 .818.162Z" clip-rule="evenodd" />
          </svg>
        </button>

        <button
          class="md:hidden w-8 h-8 rounded-lg flex items-center justify-center text-slate-400 hover:text-slate-800 dark:text-ink-faint dark:hover:text-ink hover:bg-slate-100 dark:hover:bg-white/[0.06] transition-all"
          @click="mobileOpen = !mobileOpen"
          aria-label="Toggle menu"
        >
          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path v-if="!mobileOpen" stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h10" />
            <path v-else stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
    </nav>

    <Transition name="slide-down">
      <div
        v-if="mobileOpen"
        class="md:hidden bg-white/95 dark:bg-surface-950/95 backdrop-blur-xl border-b border-slate-100 dark:border-white/[0.05]"
      >
        <ul class="page-container py-5 flex flex-col gap-1">
          <li v-for="item in navItems" :key="item.id">
            <a
              :href="`#${item.id}`"
              :class="[
                'block px-3 py-2.5 rounded-lg text-sm font-medium transition-colors',
                activeSection === item.id
                  ? 'text-accent bg-accent/[0.06]'
                  : 'text-slate-600 dark:text-ink-soft hover:text-slate-900 dark:hover:text-ink',
              ]"
              @click.prevent="scrollTo(item.id); mobileOpen = false"
            >{{ item.label }}</a>
          </li>
        </ul>
      </div>
    </Transition>
  </header>
</template>

<script setup>
import { ref, computed, onMounted, onBeforeUnmount } from 'vue'
import { useActiveSection } from '@/composables/useActiveSection'
import { useDarkMode } from '@/composables/useDarkMode'
import { usePortfolioStats } from '@/composables/usePortfolioStats'

const { profile, init } = usePortfolioStats()
onMounted(init)

const brandSlug = computed(() =>
  profile.value?.name
    ? profile.value.name.toLowerCase().replace(/\s+/, '.')
    : '…'
)

const navItems = [
  { id: 'about', label: 'About' },
  { id: 'skills', label: 'Skills' },
  { id: 'projects', label: 'Projects' },
  { id: 'experience', label: 'Experience' },
  { id: 'contact', label: 'Contact' },
]

const sections = navItems.map((i) => i.id)
const { activeSection } = useActiveSection(sections)
const { isDark, toggleDark } = useDarkMode()

const scrolled = ref(false)
const mobileOpen = ref(false)

const handleScroll = () => { scrolled.value = window.scrollY > 24 }
onMounted(() => window.addEventListener('scroll', handleScroll, { passive: true }))
onBeforeUnmount(() => window.removeEventListener('scroll', handleScroll))

const scrollTo = (id) => {
  const el = document.getElementById(id)
  if (el) window.scrollTo({ top: el.getBoundingClientRect().top + window.scrollY - 60, behavior: 'smooth' })
}
</script>

<style scoped>
.slide-down-enter-active,
.slide-down-leave-active { transition: all 0.2s ease; }
.slide-down-enter-from,
.slide-down-leave-to { opacity: 0; transform: translateY(-8px); }
</style>
