<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import Footer from './Footer.vue';
import { ref, computed, onMounted, onUpdated } from 'vue';
import { AxiosError } from 'axios';
import api from '../infra/Gateways/DvdsGateway';

const dvds = ref([]);
const meta = ref(null);
const links = ref([]);
const currentPage = ref(1);
const isLoading = ref(true);
const isFetching = ref(false);

const getDvds = async (page: number = 1) => {
    try {
        const { data: { data, meta: metaData, links: linksData } } = await api.getDvds({ params: { page } });
        dvds.value = data;
        meta.value = metaData;
        links.value = linksData;
        currentPage.value = meta.value?.current_page || 1;
    } catch (e: any) {
        if (e instanceof Error) {
            alert('js', e.message);
        }

        if (e instanceof AxiosError) {
            alert('axios', e.message);
        }
    } finally {
        isLoading.value = false;
    }
};

const hasPrevious = computed(() => !!meta.value?.links?.find(link => link.label === "&laquo; Previous" && link.url));
const hasNext = computed(() => !!meta.value?.links?.find(link => link.label === "Next &raquo;" && link.url));

const goToPage = async (page: number) => {
    if (isFetching.value) return;
    if (page < 1 || page > (meta.value?.last_page || 1)) return;
    isFetching.value = true;
    await getDvds(page);
    isFetching.value = false;
};

const goToPreviousPage = async () => {
    if (isFetching.value) return; // Evita múltiplos cliques
    const previousLink = meta.value?.links?.find(link => link.label === "&laquo; Previous");
    if (previousLink?.url) {
        const page = Number(new URL(previousLink.url).searchParams.get('page'));
        isFetching.value = true;
        await getDvds(page);
        isFetching.value = false;
    }
};

onMounted(() => {
    getDvds();
});

</script>

<template>

    <Head title="Welcome" />
    <nav class="p-4 bg-gray-800">
        <ul class="flex space-x-6">
            <li>
                <Link :href="route('dashboard')" class="font-medium text-white hover:text-teal-300">
                Dashboard de Comissões
                </Link>
            </li>
        </ul>
    </nav>

    <div v-if="isLoading" class="skeleton-loader">
        <span class="skeleton-item" v-for="i in 25" :key="i"></span>
    </div>

    <div v-else class="flex flex-col items-center justify-center min-h-screen bg-gray-100">
        <div class="text-center">
            <h1 class="text-4xl font-bold text-blue-600">Bem-vindo ao DVDFlix!</h1>
            <p class="mt-2 text-lg text-gray-700">
                Encontre os melhores filmes para assistir no conforto da sua casa.
            </p>
        </div>

        <div class="w-full max-w-5xl mt-10">
            <ul class="grid grid-cols-2 gap-4 md:grid-cols-4">
                <li v-for="dvd in dvds" :key="dvd.id">
                    <div class="p-4 text-center bg-white rounded-lg shadow">
                        <h3 class="text-lg font-semibold">{{ dvd.title }}</h3>
                        <img :src="dvd.image" alt="Poster" class="object-cover w-full h-48">
                        <p class="text-sm text-gray-600">{{ dvd.genre }}</p>
                    </div>
                </li>
            </ul>
        </div>

        <div class="flex items-center justify-center mt-10 space-x-2">
            <button class="px-4 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600 disabled:opacity-50"
                :disabled="!hasPrevious || isFetching" @click="goToPreviousPage">
                Anterior
            </button>

            <button class="px-4 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600 disabled:opacity-50"
                :disabled="!hasNext || isFetching" @click="goToPage(currentPage + 1)">
                Próximo
            </button>
        </div>
    </div>

    <Footer />
</template>

<style scoped>
.skeleton-loader {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.skeleton-item {
    background-color: #e0e0e0;
    height: 20px;
    border-radius: 5px;
    animation: shimmer 1.5s infinite;
    width: 100%;
}

@keyframes shimmer {
    0% {
        background-color: #e0e0e0;
    }

    50% {
        background-color: #f0f0f0;
    }

    100% {
        background-color: #e0e0e0;
    }
}
</style>