<template>
  <div>
    <AppNavbar />

    <main>
      <HeroSection />
      <AboutSection />
      <SkillsSection />
      <ProjectsSection />
      <ExperienceSection />
      <ContactSection />
    </main>

    <AppFooter />

    <Transition name="fade-up">
      <button
        v-if="showBackToTop"
        class="fixed bottom-6 right-6 z-40 w-11 h-11 rounded-xl bg-accent hover:bg-accent-dark text-white flex items-center justify-center shadow-glow hover:shadow-glow-lg transition-all duration-200 hover:-translate-y-0.5"
        title="Back to top"
        @click="scrollToTop"
      >
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5"/>
        </svg>
      </button>
    </Transition>
  </div>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue'
import AppNavbar from '@/components/layout/AppNavbar.vue'
import AppFooter from '@/components/layout/AppFooter.vue'
import HeroSection from '@/components/sections/HeroSection.vue'
import AboutSection from '@/components/sections/AboutSection.vue'
import SkillsSection from '@/components/sections/SkillsSection.vue'
import ProjectsSection from '@/components/sections/ProjectsSection.vue'
import ExperienceSection from '@/components/sections/ExperienceSection.vue'
import ContactSection from '@/components/sections/ContactSection.vue'
import { useScrollReveal } from '@/composables/useScrollReveal'

useScrollReveal()

const showBackToTop = ref(false)

const handleScroll = () => {
  showBackToTop.value = window.scrollY > 500
}

const scrollToTop = () => {
  window.scrollTo({ top: 0, behavior: 'smooth' })
}

onMounted(() => {
  window.addEventListener('scroll', handleScroll, { passive: true })
})
onBeforeUnmount(() => {
  window.removeEventListener('scroll', handleScroll)
})
</script>

<style scoped>
.fade-up-enter-active,
.fade-up-leave-active {
  transition: all 0.3s ease;
}
.fade-up-enter-from,
.fade-up-leave-to {
  opacity: 0;
  transform: translateY(10px);
}
</style>
