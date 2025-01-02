<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import api from '../infra/Gateways';
import { User, UserApiFetchResponse } from '@/domain';
import { onMounted, ref } from 'vue';
import { Links, Meta } from '@/infra/domain';

const customers = ref<User[] | null>([]);
const meta = ref<Meta | null>(null);
const links = ref<Links>({
    first: '',
    last: '',
    next: '',
    prev: ''
});

const getCustomers = async (page: number = 1) => {
    try {
        const {
            data, meta: metaData, links: linksData
        } = await api.usersGatway.getCustomers<UserApiFetchResponse>({ params: { page } });

        customers.value = data;
        meta.value = metaData;
        links.value = linksData;
    } catch (error) {
        console.error(error);
    }
}

onMounted(() => {
    getCustomers();
});
</script>

<template>
    <Head title="Users" />
    <h2 class="text-4xl font-bold"> Usuários </h2>
    <div class="py-12">
        <div class="w-full max-w-5xl mt-10">
            <ul class="grid grid-cols-2 gap-4 md:grid-cols-4">
                <li v-for="customer in customers" :key="customer.email">
                    <div class="p-4 text-center bg-white rounded-lg shadow hover:scale-110 transition duration-300">
                        <h3>{{ customer.name }}</h3>
                        <p class="text-sm text-gray-600">{{ customer.email }}</p>
                        <p class="text-sm text-gray-600"> {{ customer.phone }} </p>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>
