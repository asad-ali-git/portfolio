<template>
  <div class="min-h-screen bg-white dark:bg-surface-950 transition-colors duration-300">
    <RouterView />
  </div>
</template>

<script setup>
import { onMounted } from 'vue'

onMounted(() => {
  const theme = localStorage.getItem('theme')
  if (theme === 'light') {
    document.documentElement.classList.remove('dark')
  } else {
    document.documentElement.classList.add('dark')
  }
})
</script>
