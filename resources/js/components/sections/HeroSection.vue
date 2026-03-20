<template>
  <section
    id="hero"
    class="relative min-h-screen flex items-center overflow-hidden bg-white dark:bg-surface-950"
  >
    <div class="noise" aria-hidden="true"></div>

    <div aria-hidden="true"
         class="pointer-events-none absolute -top-60 -left-60 w-[800px] h-[800px] rounded-full
                opacity-[0.05] dark:opacity-[0.10] blur-[140px]"
         style="background:radial-gradient(circle,#7c6af7,transparent 70%)"></div>
    <div aria-hidden="true"
         class="pointer-events-none absolute bottom-0 right-0 w-[500px] h-[500px] rounded-full
                opacity-[0.03] dark:opacity-[0.07] blur-[100px]"
         style="background:radial-gradient(circle,#e8c97e,transparent 70%)"></div>

    <div class="page-container w-full pt-24 pb-24">
      <div class="grid lg:grid-cols-[1fr_auto] gap-10 lg:gap-20 items-end">

        <div class="max-w-3xl">
          <div class="reveal flex items-center gap-3 mb-8">
            <span class="w-2 h-2 rounded-full bg-accent animate-pulse-slow"></span>
            <span class="eyebrow">{{ profile?.availability ?? 'Available for work' }}</span>
          </div>

          <h1 class="reveal font-black leading-[0.92] tracking-tight text-slate-900 dark:text-ink mb-6"
              style="font-size:clamp(3.5rem,10vw,8.5rem)">
            {{ profile?.first_name ?? '…' }}<br>
            <span class="grad-text">{{ profile?.last_name ?? '' }}</span>
          </h1>

          <p class="reveal font-mono text-base sm:text-lg text-slate-500 dark:text-ink-soft mb-10 leading-relaxed max-w-xl">
            {{ profile?.title ?? '' }}
            <template v-if="profile?.subtitle"> &mdash; {{ profile.subtitle }}</template><br>
            {{ profile?.tagline ?? '' }}
          </p>

          <div class="reveal flex flex-wrap items-center gap-5">
            <a href="#projects"
               class="inline-flex items-center gap-2 text-[15px] font-semibold
                      text-slate-900 dark:text-ink hover:text-accent dark:hover:text-accent
                      transition-colors group"
               @click.prevent="scrollTo('projects')">
              <span>View my work</span>
              <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform"
                   fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
              </svg>
            </a>
            <span class="text-slate-200 dark:text-white/10 select-none">/</span>
            <a href="#contact"
               class="inline-flex items-center gap-2 text-[15px] font-medium
                      text-slate-500 dark:text-ink-soft hover:text-accent dark:hover:text-accent
                      transition-colors"
               @click.prevent="scrollTo('contact')">
              Let's talk
            </a>
          </div>
        </div>

        <div class="reveal hidden lg:flex flex-col gap-9 pb-2 text-right">
          <div v-for="s in stats" :key="s.label">
            <div class="font-black text-5xl text-slate-900 dark:text-ink leading-none tabular-nums mb-1">{{ s.value }}</div>
            <div class="eyebrow">{{ s.label }}</div>
          </div>
        </div>
      </div>

      <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 opacity-30">
        <span class="eyebrow">Scroll</span>
        <svg class="w-4 h-4 text-slate-400 dark:text-ink-faint animate-bounce"
             fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
        </svg>
      </div>
    </div>
  </section>
</template>

<script setup>
import { computed, onMounted } from 'vue'
import { useScrollReveal } from '@/composables/useScrollReveal'
import { usePortfolioStats } from '@/composables/usePortfolioStats'

useScrollReveal()

const { profile, projectCount, skillCount, yearsOfExperience, init } = usePortfolioStats()
onMounted(init)

const stats = computed(() => [
  { value: yearsOfExperience.value != null ? `${yearsOfExperience.value}+` : '…', label: 'Years exp.' },
  { value: projectCount.value > 0 ? `${projectCount.value}+` : '…', label: 'Projects' },
  { value: skillCount.value > 0 ? `${skillCount.value}+` : '…', label: 'Skills' },
])

const scrollTo = (id) => {
  const el = document.getElementById(id)
  if (el) window.scrollTo({ top: el.getBoundingClientRect().top + window.scrollY - 60, behavior: 'smooth' })
}
</script>
