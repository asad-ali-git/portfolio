<template>
  <article
    :class="[
      'group relative rounded-2xl overflow-hidden border transition-all duration-300',
      'bg-white dark:bg-surface-900',
      'border-slate-100 dark:border-white/[0.07]',
      'hover:border-accent/30 dark:hover:border-accent/30',
      'hover:shadow-card-light dark:hover:shadow-card',
      'hover:-translate-y-1',
      featured ? 'col-span-1 md:col-span-2' : '',
    ]"
  >
    <div :class="['relative overflow-hidden bg-slate-100 dark:bg-surface-800', featured ? 'aspect-[2/1]' : 'aspect-[16/9]']">
      <img
        v-if="project.image"
        :src="project.image"
        :alt="project.title"
        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
        loading="lazy"
      />
      <div v-else class="w-full h-full flex items-center justify-center">
        <span class="font-mono text-xs text-slate-400 dark:text-ink-faint">No preview</span>
      </div>

      <div class="absolute inset-0 bg-surface-950/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center gap-4">
        <a v-if="project.live_url"
           :href="project.live_url" target="_blank" rel="noopener"
           class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-accent text-white text-xs font-semibold hover:bg-accent-dark transition-colors"
           @click.stop>
          <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
          </svg>
          Live
        </a>
        <a v-if="project.github_url"
           :href="project.github_url" target="_blank" rel="noopener"
           class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white/10 border border-white/20 text-white text-xs font-semibold hover:bg-white/20 transition-colors"
           @click.stop>
          <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0 1 12 6.844a9.59 9.59 0 0 1 2.504.337c1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.02 10.02 0 0 0 22 12.017C22 6.484 17.522 2 12 2Z"/>
          </svg>
          Code
        </a>
      </div>
    </div>

    <div class="p-6">
      <div class="flex items-start justify-between gap-4 mb-3">
        <h3 class="font-bold text-slate-900 dark:text-ink text-lg leading-tight">{{ project.title }}</h3>
        <span v-if="project.is_featured"
              class="flex-shrink-0 font-mono text-[10px] tracking-widest uppercase px-2.5 py-1 rounded-lg bg-sand/10 dark:bg-sand/[0.08] text-sand border border-sand/20">
          Featured
        </span>
      </div>
      <p class="text-sm text-slate-500 dark:text-ink-soft leading-relaxed mb-4 line-clamp-2">{{ project.description }}</p>
      <div class="flex flex-wrap gap-1.5">
        <span v-for="tech in project.tech_stack?.slice(0, 6)" :key="tech" class="chip text-[11px] px-2 py-1">{{ tech }}</span>
      </div>
    </div>
  </article>
</template>

<script setup>
defineProps({
  project: { type: Object, required: true },
  featured: { type: Boolean, default: false },
})
</script>
