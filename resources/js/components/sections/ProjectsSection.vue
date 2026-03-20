<template>
  <section id="projects" class="section-pad bg-white dark:bg-surface-950">
    <div class="page-container">

      <div class="reveal flex flex-col sm:flex-row sm:items-end sm:justify-between gap-6 mb-16">
        <div>
          <p class="eyebrow mb-3">Projects</p>
          <h2 class="font-black text-4xl sm:text-5xl tracking-tight text-slate-900 dark:text-ink">
            Selected work.
            <span v-if="allProjects.length" class="ml-2 font-mono text-xl font-normal text-slate-400 dark:text-ink-faint">
              ({{ allProjects.length }})
            </span>
          </h2>
        </div>

        <div class="flex items-center gap-1 p-1 rounded-xl bg-slate-100 dark:bg-surface-900 self-start sm:self-auto">
          <button
            v-for="tab in tabs"
            :key="tab.value"
            :class="[
              'px-4 py-2 rounded-lg text-xs font-mono transition-all duration-200',
              activeTab === tab.value
                ? 'bg-white dark:bg-surface-800 text-slate-900 dark:text-ink shadow-sm'
                : 'text-slate-500 dark:text-ink-soft hover:text-slate-900 dark:hover:text-ink',
            ]"
            @click="activeTab = tab.value"
          >{{ tab.label }}</button>
        </div>
      </div>

      <div v-if="loading" class="flex items-center gap-3 text-slate-400 dark:text-ink-faint">
        <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
          <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
          <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
        </svg>
        <span class="font-mono text-sm">Loading&hellip;</span>
      </div>

      <p v-else-if="error" class="font-mono text-sm text-red-400">{{ error }}</p>

      <div v-else class="grid md:grid-cols-2 gap-6">
        <TransitionGroup name="card-fade">
          <ProjectCard
            v-for="(project, i) in filteredProjects"
            :key="project.id"
            :project="project"
            :featured="i === 0 && activeTab === 'all'"
            class="reveal"
          />
        </TransitionGroup>
      </div>

      <p v-if="!loading && !error && filteredProjects.length === 0"
         class="font-mono text-sm text-slate-400 dark:text-ink-faint mt-8">
        No projects found.
      </p>
    </div>
  </section>
</template>

<script setup>
import { ref, computed } from 'vue'
import { useScrollReveal } from '@/composables/useScrollReveal'
import { useFetch } from '@/composables/useFetch'
import ProjectCard from './ProjectCard.vue'

const { data, loading, error } = useFetch('/projects')
const allProjects = computed(() => data.value?.data ?? [])

const tabs = [
  { label: 'All', value: 'all' },
  { label: 'Featured', value: 'featured' },
]
const activeTab = ref('all')

const filteredProjects = computed(() =>
  activeTab.value === 'featured'
    ? allProjects.value.filter((p) => p.is_featured)
    : allProjects.value
)

useScrollReveal()
</script>

<style scoped>
.card-fade-enter-active,
.card-fade-leave-active { transition: opacity 0.25s, transform 0.25s; }
.card-fade-enter-from,
.card-fade-leave-to { opacity: 0; transform: translateY(12px); }
</style>
