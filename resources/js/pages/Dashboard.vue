<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, usePage } from '@inertiajs/vue3';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';
import { Doughnut } from 'vue-chartjs';
import {
  Chart as ChartJS,
  Title,
  Tooltip,
  Legend,
  ArcElement,
} from 'chart.js';

ChartJS.register(Title, Tooltip, Legend, ArcElement);

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

const page = usePage();
const needs = page.props.needs || [];
const wants = page.props.wants || [];
const needSum = page.props.needSum || 0;
const wantSum = page.props.wantSum || 0;

const chartData = {
  labels: ['Needs', 'Wants'],
  datasets: [
    {
      label: 'Budget',
      data: [needSum, wantSum],
      backgroundColor: ['#22c55e', '#3b82f6'],
      borderColor: ['#16a34a', '#1d4ed8'],
      borderWidth: 2,
    },
  ],
};
const chartOptions = {
  responsive: true,
  plugins: {
    legend: {
      position: 'bottom',
    },
    title: {
      display: false,
    },
  },
};
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="grid auto-rows-min gap-4 md:grid-cols-3">
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border p-4">
                    <div class="flex justify-between items-center mb-2">
                        <h2 class="font-bold">Needs</h2>
                        <span class="text-green-600 font-semibold">{{ needSum }}</span>
                    </div>
                    <ul v-if="needs.length" class="space-y-1">
                        <li v-for="need in needs" :key="need.id" class="flex justify-between">
                            <span>{{ need.title }}</span>
                            <span v-if="need.amount">{{ need.amount }}</span>
                        </li>
                    </ul>
                    <div v-else class="text-sm text-gray-500">No needs added yet.</div>
                </div>
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border p-4">
                    <div class="flex justify-between items-center mb-2">
                        <h2 class="font-bold">Wants</h2>
                        <span class="text-green-600 font-semibold" style="color: #3b82f6;">{{ wantSum }}</span>
                    </div>
                    <ul v-if="wants.length" class="space-y-1">
                        <li v-for="want in wants" :key="want.id" class="flex justify-between">
                            <span>{{ want.title }}</span>
                            <span v-if="want.amount">{{ want.amount }}</span>
                        </li>
                    </ul>
                    <div v-else class="text-sm text-gray-500">No wants added yet.</div>
                </div>
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border p-4">
                    <div class="flex justify-between items-center mb-2">
                        <h2 class="font-bold">Budget</h2>
                        <!-- <div class="flex items-center justify-center h-full">
                        <Doughnut :data="chartData" :options="chartOptions" style="max-width: 250px; max-height: 250px;" />
                        </div> -->
                    </div>
                    
                </div>
            </div>
            <div class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 md:min-h-min dark:border-sidebar-border">
                <!-- <PlaceholderPattern /> -->
                <div class="flex items-center justify-center h-full">
                    <Doughnut :data="chartData" :options="chartOptions" style="max-width: 250px; max-height: 250px;" />
                </div>

            </div>
        </div>
    </AppLayout>
</template>
