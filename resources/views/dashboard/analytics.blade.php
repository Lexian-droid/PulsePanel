<x-content-container>
    <x-page-header subtitle="Track your key performance metrics.">
        Analytics
    </x-page-header>

    {{-- Metrics --}}
    <x-metric-grid cols="4" class="mb-6">
        <livewire:metric-widget label="Page Views" value="128,430" change="+14.2%" changeType="up" icon="chart" />
        <livewire:metric-widget label="Bounce Rate" value="42.3%" change="-5.1%" changeType="up" icon="chart" />
        <livewire:metric-widget label="Session Duration" value="4m 32s" change="+1.8%" changeType="up" icon="home" />
        <livewire:metric-widget label="New Visitors" value="8,291" change="+22.4%" changeType="up" icon="home" />
    </x-metric-grid>

    {{-- Charts --}}
    <x-grid cols="2" class="mb-6">
        <x-chart-container label="Traffic Sources" height="300px" :config="[
            'type' => 'doughnut',
            'data' => [
                'labels' => ['Direct', 'Organic Search', 'Social Media', 'Referral', 'Email'],
                'datasets' => [
                    [
                        'data' => [35, 28, 18, 12, 7],
                        'backgroundColor' => ['#3b82f6', '#22c55e', '#8b5cf6', '#f59e0b', '#ef4444'],
                        'borderWidth' => 0,
                        'hoverOffset' => 8,
                    ],
                ],
            ],
            'options' => [
                'responsive' => true,
                'maintainAspectRatio' => false,
                'cutout' => '65%',
                'plugins' => [
                    'legend' => ['position' => 'bottom', 'labels' => ['usePointStyle' => true, 'padding' => 16]],
                ],
            ],
        ]" />
        <x-chart-container label="Top Pages" height="300px" :config="[
            'type' => 'bar',
            'data' => [
                'labels' => ['/dashboard', '/products', '/pricing', '/about', '/contact'],
                'datasets' => [
                    [
                        'label' => 'Page Views',
                        'data' => [24521, 18203, 12847, 9102, 6431],
                        'backgroundColor' => ['rgba(59, 130, 246, 0.7)', 'rgba(34, 197, 94, 0.7)', 'rgba(139, 92, 246, 0.7)', 'rgba(245, 158, 11, 0.7)', 'rgba(239, 68, 68, 0.7)'],
                        'borderColor' => ['#3b82f6', '#22c55e', '#8b5cf6', '#f59e0b', '#ef4444'],
                        'borderWidth' => 1,
                        'borderRadius' => 6,
                    ],
                ],
            ],
            'options' => [
                'indexAxis' => 'y',
                'responsive' => true,
                'maintainAspectRatio' => false,
                'plugins' => ['legend' => ['display' => false]],
                'scales' => [
                    'x' => ['beginAtZero' => true, 'grid' => ['color' => 'rgba(156, 163, 175, 0.15)']],
                    'y' => ['grid' => ['display' => false]],
                ],
            ],
        ]" />
    </x-grid>

    <x-chart-container label="Visitors Over Time" height="350px" class="mb-6" :config="[
        'type' => 'line',
        'data' => [
            'labels' => ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            'datasets' => [
                [
                    'label' => 'This Week',
                    'data' => [1420, 1620, 1890, 1750, 2100, 1340, 980, 1580, 1720, 2010, 1890, 2200, 1450, 1050],
                    'borderColor' => '#3b82f6',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.08)',
                    'fill' => true,
                    'tension' => 0.4,
                    'pointRadius' => 4,
                    'pointBackgroundColor' => '#3b82f6',
                ],
                [
                    'label' => 'Last Week',
                    'data' => [1200, 1380, 1550, 1420, 1800, 1100, 820, 1350, 1480, 1700, 1600, 1900, 1200, 900],
                    'borderColor' => '#9ca3af',
                    'backgroundColor' => 'rgba(156, 163, 175, 0.08)',
                    'fill' => true,
                    'tension' => 0.4,
                    'borderDash' => [5, 5],
                    'pointRadius' => 3,
                    'pointBackgroundColor' => '#9ca3af',
                ],
            ],
        ],
        'options' => [
            'responsive' => true,
            'maintainAspectRatio' => false,
            'interaction' => ['mode' => 'index', 'intersect' => false],
            'plugins' => ['legend' => ['position' => 'bottom', 'labels' => ['usePointStyle' => true, 'padding' => 16]]],
            'scales' => [
                'y' => ['beginAtZero' => true, 'grid' => ['color' => 'rgba(156, 163, 175, 0.15)']],
                'x' => ['grid' => ['display' => false]],
            ],
        ],
    ]" />

    {{-- Summary Table --}}
    <x-card>
        <x-slot:header>
            <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Top Performing Pages</h3>
        </x-slot:header>

        <x-table>
            <x-slot:head>
                <tr>
                    <x-th>Page</x-th>
                    <x-th>Views</x-th>
                    <x-th>Bounce</x-th>
                    <x-th>Avg. Time</x-th>
                    <x-th>Trend</x-th>
                </tr>
            </x-slot:head>
            @foreach([
            ['page' => '/dashboard', 'views' => '24,521', 'bounce' => '32%', 'time' => '5m 12s', 'trend' => 'up'],
            ['page' => '/products', 'views' => '18,203', 'bounce' => '45%', 'time' => '3m 45s', 'trend' => 'up'],
            ['page' => '/pricing', 'views' => '12,847', 'bounce' => '38%', 'time' => '4m 02s', 'trend' => 'down'],
            ['page' => '/about', 'views' => '9,102', 'bounce' => '52%', 'time' => '2m 18s', 'trend' => 'up'],
            ['page' => '/contact', 'views' => '6,431', 'bounce' => '41%', 'time' => '1m 55s', 'trend' => 'down'],
            ] as $row)
            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                <x-td class="font-medium text-gray-900 dark:text-white">{{ $row['page'] }}</x-td>
                <x-td>{{ $row['views'] }}</x-td>
                <x-td>{{ $row['bounce'] }}</x-td>
                <x-td>{{ $row['time'] }}</x-td>
                <x-td>
                    @if($row['trend'] === 'up')
                    <x-badge color="success">↑ Up</x-badge>
                    @else
                    <x-badge color="danger">↓ Down</x-badge>
                    @endif
                </x-td>
            </tr>
            @endforeach
        </x-table>
    </x-card>
</x-content-container>