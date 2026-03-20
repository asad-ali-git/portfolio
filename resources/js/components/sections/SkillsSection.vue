<template>
  <section id="skills" class="section-pad bg-white dark:bg-surface-950">
    <div class="page-container">

      <div class="reveal mb-16">
        <p class="eyebrow mb-3">Skills</p>
        <h2 class="font-black text-4xl sm:text-5xl tracking-tight text-slate-900 dark:text-ink">
          The stack I trust.
        </h2>
        <p v-if="totalSkillCount > 0" class="mt-3 font-mono text-sm text-slate-400 dark:text-ink-faint">
          {{ totalSkillCount }} skills &middot; {{ categoryCount }} categories
        </p>
      </div>

      <div v-if="loading" class="flex items-center gap-3 text-slate-400 dark:text-ink-faint">
        <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
          <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
          <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
        </svg>
        <span class="font-mono text-sm">Loading&hellip;</span>
      </div>

      <p v-else-if="error" class="font-mono text-sm text-red-400">{{ error }}</p>

      <div v-else class="grid sm:grid-cols-2 gap-5">
        <div
          v-for="(skillList, category) in groupedSkills"
          :key="category"
          class="reveal group relative rounded-2xl border overflow-hidden
                 bg-white dark:bg-surface-900
                 border-slate-100 dark:border-white/[0.07]
                 hover:border-slate-200 dark:hover:border-white/[0.13]
                 hover:shadow-card-light dark:hover:shadow-card
                 transition-all duration-300 p-6"
        >
          <div
            class="absolute inset-x-0 top-0 h-[2px] opacity-0 group-hover:opacity-100 transition-opacity duration-300"
            :style="{ background: meta(category).gradient }"
          ></div>

          <div class="flex items-start justify-between gap-4 mb-5">
            <div class="flex items-center gap-3">
              <div
                class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0 transition-transform duration-300 group-hover:scale-110"
                :style="{ background: meta(category).bg }"
              >
                <svg class="w-4.5 h-4.5" :style="{ color: meta(category).color }" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"
                     v-html="meta(category).icon" xmlns="http://www.w3.org/2000/svg"></svg>
              </div>
              <h3 class="font-semibold text-base text-slate-900 dark:text-ink tracking-tight">{{ category }}</h3>
            </div>
            <span class="flex-shrink-0 font-mono text-[11px] px-2 py-0.5 rounded-md
                         bg-slate-100 dark:bg-white/[0.06]
                         text-slate-400 dark:text-ink-faint
                         border border-slate-200 dark:border-white/[0.08]">
              {{ skillList.length }}
            </span>
          </div>

          <div class="flex flex-wrap gap-2">
            <span
              v-for="skill in skillList"
              :key="skill.id"
              class="px-2.5 py-1 rounded-lg font-mono text-[12px]
                     bg-slate-50 dark:bg-white/[0.03]
                     text-slate-600 dark:text-ink-soft
                     border border-slate-100 dark:border-white/[0.06]
                     hover:border-slate-300 dark:hover:border-white/20
                     hover:text-slate-900 dark:hover:text-ink
                     transition-all duration-150 cursor-default select-none"
            >
              {{ skill.name }}
            </span>
          </div>
        </div>
      </div>

    </div>
  </section>
</template>

<script setup>
import { computed } from 'vue'
import { useScrollReveal } from '@/composables/useScrollReveal'
import { useFetch } from '@/composables/useFetch'

const { data, loading, error } = useFetch('/skills')
const groupedSkills = computed(() => data.value?.data ?? {})
const totalSkillCount = computed(() =>
  Object.values(data.value?.data ?? {}).reduce((acc, arr) => acc + arr.length, 0)
)
const categoryCount = computed(() => Object.keys(data.value?.data ?? {}).length)

const CATEGORY_META = {
  Frontend: {
    bg: 'rgba(124,106,247,0.10)',
    color: '#7c6af7',
    gradient: 'linear-gradient(90deg,#7c6af7,#a78bfa)',
    icon: '<path stroke-linecap="round" stroke-linejoin="round" d="M17.25 6.75 22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3-4.5 16.5"/>',
  },
  Backend: {
    bg: 'rgba(16,185,129,0.10)',
    color: '#10b981',
    gradient: 'linear-gradient(90deg,#10b981,#34d399)',
    icon: '<path stroke-linecap="round" stroke-linejoin="round" d="M5.25 14.25h13.5m-13.5 0a3 3 0 0 1-3-3V6a3 3 0 0 1 3-3h13.5a3 3 0 0 1 3 3v5.25a3 3 0 0 1-3 3m-16.5 0a3 3 0 0 0 3 3h13.5a3 3 0 0 0 3-3m-16.5 0h16.5"/>',
  },
  Database: {
    bg: 'rgba(14,165,233,0.10)',
    color: '#0ea5e9',
    gradient: 'linear-gradient(90deg,#0ea5e9,#38bdf8)',
    icon: '<path stroke-linecap="round" stroke-linejoin="round" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 5.625c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125"/>',
  },
  Tools: {
    bg: 'rgba(245,158,11,0.10)',
    color: '#f59e0b',
    gradient: 'linear-gradient(90deg,#f59e0b,#fcd34d)',
    icon: '<path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l5.654-4.654m5.65-5.65 3.029-2.497a1.5 1.5 0 0 1 2.122 2.12l-5.65 5.65"/>',
  },
}

const DEFAULT_META = {
  bg: 'rgba(124,106,247,0.10)',
  color: '#7c6af7',
  gradient: 'linear-gradient(90deg,#7c6af7,#a78bfa)',
  icon: '<path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>',
}

const meta = (category) => CATEGORY_META[category] ?? DEFAULT_META

useScrollReveal()
</script>
