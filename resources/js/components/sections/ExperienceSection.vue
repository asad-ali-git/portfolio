<template>
  <section id="experience" class="section-pad bg-slate-50 dark:bg-surface-900/40">
    <div class="page-container">

      <div class="reveal mb-16">
        <p class="eyebrow mb-3">Experience</p>
        <h2 class="font-black text-4xl sm:text-5xl tracking-tight text-slate-900 dark:text-ink">
          Where I've built.
        </h2>
      </div>

      <div v-if="loading" class="flex items-center gap-3 text-slate-400 dark:text-ink-faint">
        <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
          <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
          <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
        </svg>
        <span class="font-mono text-sm">Loading&hellip;</span>
      </div>

      <p v-else-if="error" class="font-mono text-sm text-red-400">{{ error }}</p>

      <div v-else class="relative max-w-3xl">
        <div class="absolute left-0 top-3 bottom-3 w-px bg-slate-200 dark:bg-white/[0.07]" aria-hidden="true"></div>

        <div v-for="exp in experiences" :key="exp.id" class="reveal relative pl-10 pb-14 last:pb-0">
          <div :class="[
            'absolute left-0 top-3 -translate-x-1/2 w-2.5 h-2.5 rounded-full border-2 transition-colors',
            exp.is_current
              ? 'bg-accent border-accent'
              : 'bg-white dark:bg-surface-950 border-slate-300 dark:border-white/20'
          ]"></div>

          <div class="eyebrow mb-2">
            {{ formatDate(exp.start_date) }}
            <span class="mx-1.5 opacity-40">&ndash;</span>
            <span :class="exp.is_current ? 'text-accent' : ''">
              {{ exp.is_current ? 'Present' : formatDate(exp.end_date) }}
            </span>
            <span class="ml-1.5 opacity-50">&middot; {{ formatDuration(exp.start_date, exp.end_date, exp.is_current) }}</span>
          </div>

          <h3 class="text-xl font-bold text-slate-900 dark:text-ink mb-0.5">{{ exp.role }}</h3>
          <p class="font-mono text-sm text-sand mb-4">{{ exp.company }}</p>
          <p class="text-sm text-slate-500 dark:text-ink-soft leading-relaxed">{{ exp.description }}</p>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { computed } from 'vue'
import { useScrollReveal } from '@/composables/useScrollReveal'
import { useFetch } from '@/composables/useFetch'

const { data, loading, error } = useFetch('/experiences')
const experiences = computed(() => data.value?.data ?? [])
useScrollReveal()

const formatDate = (d) => {
  if (!d) return ''
  return new Date(d).toLocaleDateString('en-US', { month: 'short', year: 'numeric' })
}

const formatDuration = (startStr, endStr, isCurrent) => {
  if (!startStr) return ''
  const start = new Date(startStr)
  const end = isCurrent ? new Date() : (endStr ? new Date(endStr) : new Date())
  const months = Math.round((end - start) / (1000 * 60 * 60 * 24 * 30.44))
  if (months <= 0) return ''
  const yrs = Math.floor(months / 12)
  const mos = months % 12
  if (yrs === 0) return `${months} mo`
  if (mos === 0) return `${yrs} yr`
  return `${yrs} yr ${mos} mo`
}
</script>
