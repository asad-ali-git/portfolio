<template>
  <section id="contact" class="section-pad bg-slate-50 dark:bg-surface-900/40">
    <div class="page-container">

      <div class="reveal mb-16 max-w-2xl">
        <p class="eyebrow mb-3">Contact</p>
        <h2 class="font-black text-4xl sm:text-5xl lg:text-6xl tracking-tight text-slate-900 dark:text-ink leading-tight">
          Have something<br><span class="grad-text">to build?</span>
        </h2>
        <p class="mt-5 text-base text-slate-500 dark:text-ink-soft leading-relaxed">
          Available for freelance work, contract roles, and full-time opportunities.
          Send a message or reach out directly.
        </p>
      </div>

      <div class="grid lg:grid-cols-[1fr_1.6fr] gap-16 items-start">

        <div class="reveal space-y-3">
          <a v-for="link in contactLinks" :key="link.label"
             :href="link.href"
             :target="link.external ? '_blank' : undefined"
             :rel="link.external ? 'noopener' : undefined"
             class="group flex items-center gap-4 p-4 rounded-xl border border-transparent
                    hover:border-slate-200 dark:hover:border-white/[0.07]
                    hover:bg-white dark:hover:bg-surface-900
                    transition-all duration-200">
            <div class="w-9 h-9 rounded-lg bg-accent/[0.08] flex items-center justify-center flex-shrink-0 group-hover:bg-accent/[0.14] transition-colors">
              <svg class="w-4 h-4 text-accent" v-html="link.iconSvg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"></svg>
            </div>
            <div>
              <p class="eyebrow mb-0.5">{{ link.label }}</p>
              <p class="text-sm font-medium text-slate-700 dark:text-ink-soft group-hover:text-accent transition-colors">{{ link.value }}</p>
            </div>
          </a>
        </div>

        <div class="reveal">
          <form @submit.prevent="submit" class="space-y-5" novalidate>
            <div class="grid sm:grid-cols-2 gap-5">
              <div>
                <label class="eyebrow block mb-2" for="cf-name">Name</label>
                <input id="cf-name" v-model="form.name" type="text" placeholder="Your name"
                       class="w-full px-4 py-3 rounded-xl text-sm font-medium
                              bg-white dark:bg-surface-900
                              border border-slate-200 dark:border-white/[0.07]
                              text-slate-900 dark:text-ink
                              placeholder-slate-400 dark:placeholder-ink-faint
                              focus:outline-none focus:ring-2 focus:ring-accent/30 focus:border-accent/40
                              transition-all"/>
                <p v-if="errors.name" class="mt-1.5 text-xs text-red-400 font-mono">{{ errors.name[0] }}</p>
              </div>
              <div>
                <label class="eyebrow block mb-2" for="cf-email">Email</label>
                <input id="cf-email" v-model="form.email" type="email" placeholder="you@example.com"
                       class="w-full px-4 py-3 rounded-xl text-sm font-medium
                              bg-white dark:bg-surface-900
                              border border-slate-200 dark:border-white/[0.07]
                              text-slate-900 dark:text-ink
                              placeholder-slate-400 dark:placeholder-ink-faint
                              focus:outline-none focus:ring-2 focus:ring-accent/30 focus:border-accent/40
                              transition-all"/>
                <p v-if="errors.email" class="mt-1.5 text-xs text-red-400 font-mono">{{ errors.email[0] }}</p>
              </div>
            </div>

            <div>
              <label class="eyebrow block mb-2" for="cf-message">Message</label>
              <textarea id="cf-message" v-model="form.message" rows="5" placeholder="Tell me about your project…"
                        class="w-full px-4 py-3 rounded-xl text-sm font-medium
                               bg-white dark:bg-surface-900
                               border border-slate-200 dark:border-white/[0.07]
                               text-slate-900 dark:text-ink
                               placeholder-slate-400 dark:placeholder-ink-faint
                               focus:outline-none focus:ring-2 focus:ring-accent/30 focus:border-accent/40
                     resize-none transition-all"></textarea>
              <p v-if="errors.message" class="mt-1.5 text-xs text-red-400 font-mono">{{ errors.message[0] }}</p>
            </div>

            <Transition name="fade">
              <p v-if="success"
                 class="font-mono text-sm text-accent py-3 px-4 rounded-xl bg-accent/[0.06] border border-accent/20">
                &#10003; Message sent. I'll be in touch soon.
              </p>
            </Transition>

            <button type="submit" :disabled="submitting"
                    class="inline-flex items-center gap-2 px-6 py-3 rounded-xl
                           bg-accent hover:bg-accent-dark disabled:opacity-50
                           text-white text-sm font-semibold
                           shadow-glow hover:shadow-glow-lg
                           transition-all duration-200">
              <svg v-if="submitting" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
              </svg>
              <span>{{ submitting ? 'Sending…' : 'Send message' }}</span>
            </button>
          </form>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { useScrollReveal } from '@/composables/useScrollReveal'
import { usePortfolioStats } from '@/composables/usePortfolioStats'
import api from '@/services/api'

useScrollReveal()

const { profile, init } = usePortfolioStats()
onMounted(init)

const stripProtocol = (url) => url?.replace(/^https?:\/\//, '') ?? ''

const contactLinks = computed(() => {
  const p = profile.value
  if (!p) return []
  return [
    {
      label: 'Email',
      value: p.email ?? '',
      href: p.email ? `mailto:${p.email}` : '#',
      external: false,
      iconSvg: '<path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>',
    },
    {
      label: 'LinkedIn',
      value: stripProtocol(p.linkedin_url),
      href: p.linkedin_url ?? '#',
      external: true,
      iconSvg: '<path fill="currentColor" stroke="none" d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>',
    },
    {
      label: 'GitHub',
      value: stripProtocol(p.github_url),
      href: p.github_url ?? '#',
      external: true,
      iconSvg: '<path fill="currentColor" stroke="none" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0 1 12 6.844a9.59 9.59 0 0 1 2.504.337c1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.02 10.02 0 0 0 22 12.017C22 6.484 17.522 2 12 2Z"/>',
    },
    {
      label: 'Location',
      value: p.location ? `${p.location} · Remote-friendly` : '',
      href: '#',
      external: false,
      iconSvg: '<path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>',
    },
  ].filter((l) => l.value)
})

const form = ref({ name: '', email: '', message: '' })
const errors = ref({})
const submitting = ref(false)
const success = ref(false)

const submit = async () => {
  errors.value = {}
  success.value = false
  submitting.value = true
  try {
    await api.post('/contact', form.value)
    success.value = true
    form.value = { name: '', email: '', message: '' }
  } catch (e) {
    if (e.response?.status === 422) errors.value = e.response.data.errors ?? {}
  } finally {
    submitting.value = false
  }
}
</script>

<style scoped>
.fade-enter-active, .fade-leave-active { transition: opacity 0.3s, transform 0.3s; }
.fade-enter-from, .fade-leave-to { opacity: 0; transform: translateY(-4px); }
</style>
