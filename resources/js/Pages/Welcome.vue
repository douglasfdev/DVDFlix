<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';

const categories = ref([
    { id: 1, name: "Ação" },
    { id: 2, name: "Comédia" },
    { id: 3, name: "Drama" },
    { id: 4, name: "Suspense" },
    { id: 5, name: "Terror" },
    { id: 6, name: "Infantil" },
]);
</script>

<template>

    <Head title="Welcome" />
    <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100">
        <div class="text-center">
            <h1 class="text-4xl font-bold text-blue-600">Bem-vindo ao DVDflix!</h1>
            <p class="mt-2 text-lg text-gray-700">
                Encontre os melhores filmes para assistir no conforto da sua casa.
            </p>
            <Link :href="route('movies')"
                class="px-6 py-2 mt-6 text-white transition bg-blue-500 rounded hover:bg-blue-600">
            Explore nossos filmes
            </Link>
        </div>

        <div class="w-full max-w-3xl mt-10">
            <h2 class="mb-4 text-2xl font-semibold text-gray-800">
                Categorias populares
            </h2>
            <ul class="grid grid-cols-2 gap-4 md:grid-cols-3">
                <li v-for="category in categories" :key="category.id">
                    <Link :href="route('category', { id: category.id })"
                        class="p-4 bg-white rounded shadow cursor-pointer hover:bg-gray-100">
                    {{ category.name }}
                    </Link>
                </li>
            </ul>
        </div>
    </div>
</template>
