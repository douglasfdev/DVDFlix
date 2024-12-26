<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';

</script>

<template>
    <Head title="Welcome" />
    <nav class="p-4 bg-gray-800">
        <ul class="flex space-x-6">
            <li>
                <Link :href="route('home')" class="font-medium text-white hover:text-teal-300">
                    Home
                </Link>
            </li>
            <li>
                <Link :href="route('dashboard')" class="font-medium text-white hover:text-teal-300">
                Dashboard de Comissões
                </Link>
            </li>
        </ul>
    </nav>
</template>

