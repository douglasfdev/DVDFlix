<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { ref, computed, onMounted } from 'vue';
import { AxiosError } from 'axios';
import api from '@/infra/Gateways';
import { Dvd, DvdApiFetchResponse } from '@/domain';
import { Links, Meta } from '@/infra/domain';

const dvds = ref<Dvd[] | null>([]);
const meta = ref<Meta | null>(null);
const links = ref<Links>({
    first: '',
    last: '',
    next: '',
    prev: ''
});
const currentPage = ref(1);
const isLoading = ref(true);
const isFetching = ref(false);

const getDvds = async (page: number = 1) => {
    try {
        const {
            data, meta: metaData, links: linksData
        } = await api.dvdGateway.getDvds<DvdApiFetchResponse>({ params: { page } });
        dvds.value = data;
        meta.value = metaData;
        links.value = linksData;
        currentPage.value = meta.value?.current_page || 1;
    } catch (e: any) {
        if (e instanceof Error) {
            alert(e.message);
        }

        if (e instanceof AxiosError) {
            alert(e.message);
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
    if (isFetching.value) return;
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

    <Head title="Dvds" />
    <div v-if="isLoading" class="skeleton-loader">
        <span class="skeleton-item" v-for="i in 25" :key="i"></span>
    </div>

    <div v-else class="grid justify-center grid-flow-row auto-rows-max">
        <div class="text-center">
            <h1 class="text-4xl font-bold text-blue-600">Bem-vindo ao DVDFlix!</h1>
            <p class="mt-2 text-lg text-gray-700">
                Encontre os melhores filmes para assistir no conforto da sua casa.
            </p>
        </div>

        <div class="w-full max-w-5xl mt-10">
            <ul class="grid grid-cols-2 gap-4 md:grid-cols-4">
                <li v-for="dvd in dvds" :key="dvd.title">
                    <div class="p-4 text-center transition duration-300 bg-white rounded-lg shadow hover:scale-110">
                        <h3 class="font-semibold movie-title" :title="dvd.title">{{ dvd.title }}</h3>
                        <img :src="dvd.image" alt="Poster">
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
</template>

<style scoped>
.movie-title {
    text-transform: capitalize;
}
</style>
