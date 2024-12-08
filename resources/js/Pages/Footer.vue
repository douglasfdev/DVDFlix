<script setup lang="ts">
import { ref } from 'vue';

const currentDate = ref(new Date().toLocaleDateString('pt-BR', {
  weekday: 'long',
  year: 'numeric',
  month: 'long',
  day: 'numeric',
}));
</script>

<template>
  <footer class="py-6 mt-12 text-white bg-gray-900">
    <div class="container flex flex-col items-center justify-between mx-auto space-y-4 md:flex-row md:space-y-0">
      <!-- Logo e Nome -->
      <div class="text-center md:text-left">
        <h2 class="text-3xl font-semibold">DVDFlix</h2>
        <p class="mt-1 text-lg">Douglas Fernandes Pereira Junior</p>
      </div>

      <div class="text-center md:text-right">
        <p class="text-sm">Hoje é: <span class="font-semibold">{{ currentDate }}</span></p>
      </div>

      <div class="text-center md:text-left">
        <p class="text-xs">Feito com 💻 e paixão em 2024</p>
      </div>
    </div>
  </footer>
</template>

<style scoped>
footer {
  box-shadow: 0 -4px 6px rgba(0, 0, 0, 0.1);
}
</style>
