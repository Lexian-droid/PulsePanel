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
        <x-chart-container label="Traffic Sources" height="300px" />
        <x-chart-container label="Top Pages" height="300px" />
    </x-grid>

    <x-chart-container label="Visitors Over Time" height="350px" class="mb-6" />

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