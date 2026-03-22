<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class StarterCleanup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pulsepanel:cleanup {--force : Skip confirmation prompt}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove starter dashboard views and routes so you can begin building immediately';

    /**
     * Views to delete (non-essential starter pages).
     *
     * @var list<string>
     */
    protected array $starterViews = [
        'resources/views/dashboard/analytics.blade.php',
        'resources/views/dashboard/tables.blade.php',
        'resources/views/dashboard/components.blade.php',
    ];

    /**
     * Livewire page components to delete.
     *
     * @var list<string>
     */
    protected array $starterPageComponents = [
        'app/Livewire/Pages/Analytics.php',
        'app/Livewire/Pages/Tables.php',
        'app/Livewire/Pages/ComponentsShowcase.php',
    ];

    /**
     * Routes to remove from the web routes file.
     *
     * @var list<string>
     */
    protected array $routePatterns = [
        "/\s*Route::get\('\/dashboard\/analytics'.*?\)->name\('dashboard\.analytics'\);/",
        "/\s*Route::get\('\/dashboard\/tables'.*?\)->name\('dashboard\.tables'\);/",
        "/\s*Route::get\('\/dashboard\/components'.*?\)->name\('dashboard\.components'\);/",
    ];

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        if (! $this->option('force') && ! $this->confirm('This will remove starter views, page components, and related routes. Continue?')) {
            $this->info('Cleanup cancelled.');

            return self::SUCCESS;
        }

        $this->deleteStarterViews();
        $this->deleteStarterPageComponents();
        $this->cleanRoutes();
        $this->replaceWithBlankDashboard();
        $this->cleanSidebar();
        $this->selfDestruct();

        $this->newLine();
        $this->info('Starter cleanup complete! Your dashboard is ready for development.');

        return self::SUCCESS;
    }

    /**
     * Delete non-essential starter views.
     */
    protected function deleteStarterViews(): void
    {
        foreach ($this->starterViews as $view) {
            $path = base_path($view);
            if (File::exists($path)) {
                File::delete($path);
                $this->components->info("Deleted: {$view}");
            }
        }
    }

    /**
     * Delete Livewire page components for starter pages.
     */
    protected function deleteStarterPageComponents(): void
    {
        foreach ($this->starterPageComponents as $component) {
            $path = base_path($component);
            if (File::exists($path)) {
                File::delete($path);
                $this->components->info("Deleted: {$component}");
            }
        }
    }

    /**
     * Remove starter routes from the web routes file.
     */
    protected function cleanRoutes(): void
    {
        $routesPath = base_path('routes/web.php');
        $contents = File::get($routesPath);

        foreach ($this->routePatterns as $pattern) {
            $contents = preg_replace($pattern, '', $contents);
        }

        File::put($routesPath, $contents);
        $this->components->info('Cleaned starter routes from routes/web.php');
    }

    /**
     * Replace the dashboard view with a blank starting point.
     */
    protected function replaceWithBlankDashboard(): void
    {
        $dashboardView = resource_path('views/dashboard/index.blade.php');

        $blankContent = <<<'BLADE'
<x-content-container>
    <x-page-header subtitle="Welcome to your new project.">
        Dashboard
    </x-page-header>

    {{-- Start building here --}}
</x-content-container>
BLADE;

        File::put($dashboardView, $blankContent."\n");
        $this->components->info('Replaced dashboard view with blank template');
    }

    /**
     * Remove starter navigation links from the sidebar.
     */
    protected function cleanSidebar(): void
    {
        $sidebarPath = resource_path('views/components/sidebar.blade.php');
        if (! File::exists($sidebarPath)) {
            return;
        }

        $contents = File::get($sidebarPath);

        // Remove the analytics sidebar link
        $contents = preg_replace(
            '/\s*<x-sidebar-link[^>]*route\(\'dashboard\.analytics\'\)[^>]*>.*?<\/x-sidebar-link>/s',
            '',
            $contents
        );

        // Remove the Content section with tables and components links
        $contents = preg_replace(
            '/\s*<x-sidebar-section\s+label="Content">.*?<\/x-sidebar-section>/s',
            '',
            $contents
        );

        File::put($sidebarPath, $contents);
        $this->components->info('Cleaned starter links from sidebar');
    }

    /**
     * Remove this command file after execution.
     */
    protected function selfDestruct(): void
    {
        $commandPath = __FILE__;

        // Register a shutdown function to delete after the command finishes
        register_shutdown_function(function () use ($commandPath): void {
            if (file_exists($commandPath)) {
                unlink($commandPath);
            }
        });

        $this->components->info('Cleanup command will be removed (one-time action)');
    }
}
