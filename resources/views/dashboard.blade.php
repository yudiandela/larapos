<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="py-10 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <select class="relative z-50 border rounded-lg cursor-pointer left-14" onchange="update(this)">
                    <option value="1">Hari ini</option>
                    <option value="7" selected>7 Hari</option>
                    <option value="14">2 Minggu</option>
                    <option value="30">Bulan Ini</option>
                </select>
                <div id="chart" style="height: 430px;"></div>
            </div>
        </div>
    </div>

    @push('script')
        <!-- Charting library -->
        <script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
        <!-- Chartisan -->
        <script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>
        <!-- Your application script -->
        <script>
        const chart = new Chartisan({
            el: '#chart',
            url: "@chart('dashboard_chart')",
            loader: {
                color: '#6699CC',
                size: [30, 30],
                type: 'bar',
                textColor: '#000000',
                text: 'Mengambil data penjualan',
            },
            error: {
                color: '#6699CC',
                size: [30, 30],
                text: 'Upps...Sepertinya ada kesalahan!',
                textColor: '#000000',
                type: 'general'
            },
            hooks: new ChartisanHooks()
                .legend()
                .colors(['#6699CC', '#e63946', '#e9c46a', '#00b4d8'])
                .legend({ bottom: 0 })
                .title({
                    textAlign: 'center',
                    left: '50%',
                    text: 'Grafik data penjualan 7 hari',
                })
                .tooltip()
        });

        window.update = function(data) {
            const count = data.value
            let url = `@chart('dashboard_chart', 'count=:count')`
            url = url.replace(':count', count)

            chart.update({
                background: true,
                url: url,
                hooks: new ChartisanHooks()
                    .legend()
                    .colors(['#6699CC', '#e63946', '#e9c46a', '#00b4d8'])
                    .legend({ bottom: 0 })
                    .title({
                        textAlign: 'center',
                        left: '50%',
                        text: `Grafik data penjualan ${count} hari`,
                    })
                    .tooltip()
                })
        }
        </script>
    @endpush
</x-app-layout>
