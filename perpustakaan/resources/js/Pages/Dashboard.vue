<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
import {onMounted, ref} from "vue";

const chartData = ref(null);
const chartOptions = ref(null);

onMounted(() => {
    chartData.value = setChartData();
    chartOptions.value = setChartOptions();
});

const setChartData = () => {
    const documentStyle = getComputedStyle(document.documentElement);

    return {
        labels: ['Q1', 'Q2', 'Q3', 'Q4'],
        datasets: [
            {
                type: 'bar',
                label: 'Total Peminjam',
                backgroundColor: documentStyle.getPropertyValue('--p-primary-400'),
                data: [4000, 10000, 15000, 4000],
                barThickness: 32
            },
            {
                type: 'bar',
                label: 'Total Pengunjung',
                backgroundColor: documentStyle.getPropertyValue('--p-primary-200'),
                data: [4100, 5200, 3400, 7400],
                borderRadius: {
                    topLeft: 8,
                    topRight: 8
                },
                borderSkipped: true,
                barThickness: 32
            }
        ]
    };
}

const setChartOptions = () => {
    const documentStyle = getComputedStyle(document.documentElement);
    const borderColor = documentStyle.getPropertyValue('--surface-border');
    const textMutedColor = documentStyle.getPropertyValue('--text-color-secondary');

    return {
        maintainAspectRatio: false,
        aspectRatio: 0.8,
        scales: {
            x: {
                stacked: true,
                ticks: {
                    color: textMutedColor
                },
                grid: {
                    color: 'transparent',
                    borderColor: 'transparent'
                }
            },
            y: {
                stacked: true,
                ticks: {
                    color: textMutedColor
                },
                grid: {
                    color: borderColor,
                    borderColor: 'transparent',
                    drawTicks: false
                }
            }
        }
    };
}


</script>

<template>
    <Head title="Dashboard"/>
    <Toast/>

    <AuthenticatedLayout>
        <div class="grid grid-cols-12 gap-8">
            <div class="col-span-12 lg:col-span-6 xl:col-span-6">
                <div class="card mb-0">
                    <div class="flex justify-between mb-4">
                        <div>
                            <span class="block text-muted-color font-medium mb-4">Buku</span>
                            <div class="text-surface-900 dark:text-surface-0 font-medium text-xl">
                                152
                            </div>
                        </div>
                        <div
                            class="flex items-center justify-center bg-blue-100 dark:bg-blue-400/10 rounded-border"
                            style="width: 2.5rem; height: 2.5rem">
                            <i class="pi pi-book text-blue-500 !text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-12 lg:col-span-6 xl:col-span-6">
                <div class="card mb-0">
                    <div class="flex justify-between mb-4">
                        <div>
                            <span class="block text-muted-color font-medium mb-4">Kategori Buku</span>
                            <div class="text-surface-900 dark:text-surface-0 font-medium text-xl">
                                10
                            </div>
                        </div>
                        <div
                            class="flex items-center justify-center bg-orange-100 dark:bg-orange-400/10 rounded-border"
                            style="width: 2.5rem; height: 2.5rem">
                            <i class="pi pi-bookmark text-orange-500 !text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-12 xl:col-span-12">
                <div class="card">
                    <div class="font-semibold text-xl mb-4">Total Peminjam</div>
                    <Chart type="bar" :data="chartData" :options="chartOptions" class="h-80" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
