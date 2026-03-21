<x-content-container>
    <x-page-header subtitle="Welcome back, {{ auth()->user()->name }}!">
        Dashboard
    </x-page-header>

    {{-- Livewire alerts demo --}}
    <div class="mb-6">
        <livewire:dismissible-alert type="info" message="Welcome to PulsePanel! This is your dashboard starter template. Explore the sidebar to see demo pages." />
    </div>

    {{-- Stats --}}
    <x-metric-grid cols="4" class="mb-6">
        <x-stat-card label="Total Users" value="2,847" change="+12.5%" changeType="up" icon="home" />
        <x-stat-card label="Revenue" value="$45,231" change="+8.2%" changeType="up" icon="chart" />
        <x-stat-card label="Orders" value="1,234" change="-3.1%" changeType="down" icon="cube" />
        <x-stat-card label="Conversion" value="3.24%" change="+2.4%" changeType="up" icon="chart" />
    </x-metric-grid>

    {{-- Charts row --}}
    <x-grid cols="2" class="mb-6">
        <x-chart-container label="Revenue Over Time" height="250px" :config="[
            'type' => 'line',
            'data' => [
                'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                'datasets' => [
                    [
                        'label' => 'Revenue ($)',
                        'data' => [12400, 19800, 15600, 24100, 22300, 28700, 31200, 29800, 34500, 38100, 41200, 45231],
                        'borderColor' => '#3b82f6',
                        'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                        'fill' => true,
                        'tension' => 0.4,
                        'pointBackgroundColor' => '#3b82f6',
                    ],
                ],
            ],
            'options' => [
                'responsive' => true,
                'maintainAspectRatio' => false,
                'plugins' => ['legend' => ['display' => false]],
                'scales' => [
                    'y' => ['beginAtZero' => true, 'grid' => ['color' => 'rgba(156, 163, 175, 0.15)']],
                    'x' => ['grid' => ['display' => false]],
                ],
            ],
        ]" />
        <x-chart-container label="User Growth" height="250px" :config="[
            'type' => 'bar',
            'data' => [
                'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                'datasets' => [
                    [
                        'label' => 'New Users',
                        'data' => [120, 190, 170, 250, 220, 310, 280, 340, 300, 380, 420, 460],
                        'backgroundColor' => 'rgba(34, 197, 94, 0.7)',
                        'borderColor' => '#16a34a',
                        'borderWidth' => 1,
                        'borderRadius' => 6,
                    ],
                    [
                        'label' => 'Returning Users',
                        'data' => [80, 120, 130, 160, 180, 200, 210, 240, 230, 270, 290, 320],
                        'backgroundColor' => 'rgba(59, 130, 246, 0.7)',
                        'borderColor' => '#2563eb',
                        'borderWidth' => 1,
                        'borderRadius' => 6,
                    ],
                ],
            ],
            'options' => [
                'responsive' => true,
                'maintainAspectRatio' => false,
                'plugins' => ['legend' => ['position' => 'bottom', 'labels' => ['usePointStyle' => true, 'padding' => 16]]],
                'scales' => [
                    'y' => ['beginAtZero' => true, 'grid' => ['color' => 'rgba(156, 163, 175, 0.15)']],
                    'x' => ['grid' => ['display' => false]],
                ],
            ],
        ]" />
    </x-grid>

    {{-- Activity & Notifications --}}
    <x-grid cols="2">
        <x-widget-card title="Recent Activity">
            <x-activity-timeline :items="[
                    ['title' => 'New user registered', 'description' => 'John Doe created an account', 'time' => '2 minutes ago', 'icon' => 'home'],
                    ['title' => 'Order completed', 'description' => 'Order #1234 was fulfilled', 'time' => '15 minutes ago', 'icon' => 'cube'],
                    ['title' => 'Report generated', 'description' => 'Monthly analytics report', 'time' => '1 hour ago', 'icon' => 'chart'],
                    ['title' => 'Settings updated', 'description' => 'Email notifications toggled', 'time' => '3 hours ago', 'icon' => 'cog'],
                ]" />
        </x-widget-card>

        <x-widget-card title="Notifications">
            <x-notification-list :notifications="[
                    ['from' => 'Sarah Chen', 'message' => 'Requested access to the analytics dashboard.', 'time' => '5 min ago', 'unread' => true],
                    ['from' => 'Alex Kim', 'message' => 'Completed the onboarding checklist.', 'time' => '1 hour ago', 'unread' => true],
                    ['from' => 'System', 'message' => 'Backup completed successfully.', 'time' => '2 hours ago', 'unread' => false],
                    ['from' => 'Jordan Lee', 'message' => 'Left a comment on your report.', 'time' => '5 hours ago', 'unread' => false],
                ]" />
        </x-widget-card>
    </x-grid>
</x-content-container>