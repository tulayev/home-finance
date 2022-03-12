<template>

    <div id="chart">
        <ApexChart
            width="380" type="donut" :options="options" :series="series"
        />
    </div>

</template>

<script>
import VueApexCharts from 'vue3-apexcharts'

export default {
    name: 'Dashboard',
    components: {
        ApexChart: VueApexCharts,
    },

    data: () => {
        return {
            options: {},
            series: [44, 55, 41, 17, 15]
        }
    }
}
</script>