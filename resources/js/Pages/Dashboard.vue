<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js';
import { Bar } from 'vue-chartjs';
import api from '../infra/Gateways';
import { CommissionApiResponse } from '@/domain';

interface Dataset {
    label: string;
    data: number[];
    backgroundColor: string;
    borderColor: string;
    borderWidth: number;
}

interface ChartData {
    labels: string[];
    datasets: Dataset[];
}

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale);

const chartData = ref<ChartData | null>(null);
const isLoading = ref(true);

const fetchData = async () => {
    try {
        const { data: { data } } = await api.dashboardGateway.getComissions<CommissionApiResponse>();
        const labels = data.map(item => item.seller);
        const commissions = data.map(item => parseFloat(item.comission));

        chartData.value = {
            labels: labels,
            datasets: [
                {
                    label: 'Comissões',
                    data: commissions,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                },
            ],
        };
    } catch (error) {
        console.error('Erro ao buscar dados:', error);
    } finally {
        isLoading.value = false;
    }
};

onMounted(() => {
    fetchData();
});
</script>

<template>
    <Head title="Dashboard" />
    <div>
        <h1 class="mb-4 text-2xl font-bold">Gráfico de Comissões</h1>
        <div v-if="chartData">
            <Bar :data="chartData" />
        </div>
        <div v-else class="skeleton-loader">
            <span class="skeleton-item" v-for="i in 25" :key="i"></span>
        </div>
    </div>
</template>

<style scoped></style>
