<template>
  <section id="about" class="section-pad bg-slate-50 dark:bg-surface-900/40">
    <div class="page-container">

      <div class="reveal mb-16">
        <p class="eyebrow mb-3">About</p>
        <h2 class="font-black text-4xl sm:text-5xl lg:text-6xl tracking-tight text-slate-900 dark:text-ink leading-tight">
          Crafting software<br><span class="grad-text">that lasts.</span>
        </h2>
      </div>

      <div class="grid lg:grid-cols-[1fr_1.2fr] gap-16 lg:gap-24 items-start">

        <div class="reveal grid grid-cols-2 gap-x-8 gap-y-10">
          <div v-for="s in stats" :key="s.label">
            <div class="font-black text-5xl sm:text-6xl text-slate-900 dark:text-ink leading-none mb-2 tabular-nums">{{ s.value }}</div>
            <div class="eyebrow leading-relaxed">{{ s.label }}</div>
          </div>
        </div>

        <div class="reveal space-y-5">
          <p
            v-for="(paragraph, i) in (profile?.bio ?? [])"
            :key="i"
            :class="i === 0
              ? 'text-lg text-slate-700 dark:text-ink-soft leading-relaxed'
              : 'text-base text-slate-500 dark:text-ink-soft leading-relaxed'"
            v-html="paragraph"
          ></p>

          <div class="flex flex-wrap gap-2 pt-2">
            <span v-for="t in (profile?.tags ?? [])" :key="t" class="chip">{{ t }}</span>
          </div>

          <div class="pt-2">
            <a href="#contact"
               class="inline-flex items-center gap-2 text-sm font-semibold text-accent hover:text-accent-dark transition-colors group"
               @click.prevent="scrollTo('contact')">
              <span>Work together</span>
              <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform"
                   fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
              </svg>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { computed, onMounted } from 'vue'
import { useScrollReveal } from '@/composables/useScrollReveal'
import { usePortfolioStats } from '@/composables/usePortfolioStats'

useScrollReveal()

const { profile, projectCount, featuredCount, skillCount, yearsOfExperience, init } = usePortfolioStats()
onMounted(init)

const stats = computed(() => [
  { value: yearsOfExperience.value != null ? `${yearsOfExperience.value}+` : '…', label: 'Years of experience' },
  { value: projectCount.value > 0 ? `${projectCount.value}+` : '…', label: 'Projects delivered' },
  { value: skillCount.value > 0 ? `${skillCount.value}+` : '…', label: 'Skills mastered' },
  {
    value: profile.value?.open_source_commits > 0
      ? `${profile.value.open_source_commits}+`
      : (featuredCount.value > 0 ? `${featuredCount.value}` : '…'),
    label: profile.value?.open_source_commits > 0 ? 'Open-source commits' : 'Featured projects',
  },
])

const scrollTo = (id) => {
  const el = document.getElementById(id)
  if (el) window.scrollTo({ top: el.getBoundingClientRect().top + window.scrollY - 60, behavior: 'smooth' })
}
</script>
