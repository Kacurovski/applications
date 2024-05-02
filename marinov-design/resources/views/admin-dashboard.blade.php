<x-app-layout>
    <div class="grid grid-cols-2 gap-8">
        <div class="chart-container">
            <h3 class="chart-title text-center text-md sm:text-xl">Product Types</h3>
            <div id="productTypesChart" class="w-full h-[180px]"></div>
        </div>
        <div class="chart-container">
            <h3 class="chart-title text-center text-md sm:text-xl">Most Revenue Products</h3>
            <div id="mostRevenueProductsChart" class="w-full h-[180px]"></div>
        </div>
        <div class="chart-container">
            <h3 class="chart-title text-center text-md sm:text-xl">Favorite Products</h3>
            <div id="favoriteProductsChart" class="w-full h-[180px]"></div>
        </div>
        <div class="chart-container">
            <h3 class="chart-title text-center text-md sm:text-xl">Most Ordered Products</h3>
            <div id="mostOrderedProductsChart" class="w-full h-[180px]"></div>
        </div>

    </div>

    <div class="chart-container mt-4">
        <h3 class="chart-title text-center text-md sm:text-xl">Materials</h3>
        <div id="materialChart" class="w-full h-[250px]"></div>
    </div>



    <script>
        document.addEventListener('DOMContentLoaded', async function() {
            const typeData = await fetchTypeData();
            createChart('productTypesChart', typeData, ['#211C6A', '#59B4C3', '#74E291', '#EFF396', '#4a5568',
                '#BED1CF', '#9f7aea', '#93c5fd'
            ]);

            const materialData = await fetchMaterialData();
            createChart('materialChart', materialData, ['#E8C872', '#D8C872', '#C9D7DD', '#637A9F', '#9b59b6',
                '#1abc9c', '#e67e22', '#2c3e50'
            ]);

            const favoriteProductsData = await fetchFavoriteProductsData();
            createChart('favoriteProductsChart', favoriteProductsData, ['#24B4C3']);

            const mostOrderedProductsData = await fetchMostOrderedProductsData();
            createChart('mostOrderedProductsChart', mostOrderedProductsData, ['#80BCBD', '#AAD9BB', '#D5F0C1',
                '#F9F7C9'
            ]);

            const mostRevenueData = await fetchMostRevenueProductsData();
            createChart('mostRevenueProductsChart', mostRevenueData, ['#2B1A55', '#1B0A55', '#535C91',
                '#9290C3'
            ]);
        });

        async function fetchTypeData() {
            const response = await fetch('http://localhost:8000/api/products/types');
            const data = await response.json();
            return {
                labels: data.types,
                values: data.counts,
            };
        }

        async function fetchMaterialData() {
            const response = await fetch('http://localhost:8000/api/products/materials');
            const data = await response.json();
            return {
                labels: data.materials,
                values: data.counts,
            };
        }

        async function fetchFavoriteProductsData() {
            const response = await fetch('http://localhost:8000/api/products/favorites');
            const data = await response.json();
            return {
                labels: data.products,
                values: data.counts,
            };
        }

        async function fetchMostOrderedProductsData() {
            const response = await fetch('http://localhost:8000/api/products/most-ordered');
            const data = await response.json();
            return {
                labels: data.products,
                values: data.counts,
            };
        }

        async function fetchMostRevenueProductsData() {
            const response = await fetch('http://localhost:8000/api/products/most-revenue');
            const data = await response.json();
            return {
                labels: data.products,
                values: data.revenue,
            };
        }

        function createChart(containerId, data, backgroundColor) {
            const canvas = document.createElement('canvas');
            canvas.id = containerId + 'Chart';
            document.getElementById(containerId).appendChild(canvas);

            const ctx = canvas.getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: '',
                        data: data.values,
                        backgroundColor: backgroundColor,
                        borderWidth: 1,
                        barThickness: 45,
                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            beginAtZero: true,
                        },
                        y: {
                            beginAtZero: true,
                        },
                    },
                    plugins: {
                        legend: {
                            display: false,
                        },
                    },
                },
            });
        }
    </script>
</x-app-layout>
