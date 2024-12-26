<script setup lang="ts">
import Nav from './Nav.vue';
import Footer from './Footer.vue';

</script>

<template>
    <main class="flex-grow">
        <Nav />
        <div class="container mx-auto p-6">
            <slot />
        </div>
        <Footer />
    </main>
</template>
