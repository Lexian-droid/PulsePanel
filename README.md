# PulsePanel

A clean, reusable Laravel starter template for building admin dashboards and internal tools. Built with **Laravel 12**, **Blade Components**, **Livewire**, and **Tailwind CSS**.

## Features

- **Authentication**  Login/logout powered by Laravel Fortify (no registration by default)
- **Dashboard Layout**  Responsive sidebar + topbar with mobile support
- **50+ Blade Components**  Layout, UI, form, data, and dashboard components
- **Livewire Components**  Searchable table, profile form, metric widgets, modals, alerts
- **Dark Mode Ready**  Full dark-mode support via CSS custom variant
- **Demo Pages**  Dashboard overview, analytics, tables, settings, and component showcase
- **Tailwind CSS v4**  Custom theme with primary, accent, success, warning, and danger color tokens

## Requirements

- PHP 8.2+
- Node.js 18+
- Composer

## Installation

`ash
# Clone the repository
git clone <your-repo-url> pulsepanel
cd pulsepanel

# Install PHP dependencies
composer install

# Install Node dependencies
npm install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Run database migrations and seed demo data
php artisan migrate --seed

# Build front-end assets
npm run build
`

## Default Login

After seeding, you can log in with:

| Field    | Value                   |
|----------|-------------------------|
| Email    | admin@pulsepanel.test   |
| Password | password                |

## Dashboard Routes

| Route                  | Description              |
|------------------------|--------------------------|
| `/`                  | Welcome / landing page   |
| `/login`             | Authentication           |
| `/dashboard`         | Main dashboard overview  |
| `/dashboard/analytics` | Analytics with charts  |
| `/dashboard/tables`  | Searchable data table    |
| `/dashboard/settings`| Profile & password form  |
| `/dashboard/components` | Component showcase     |

## Project Structure

`
app/
  Livewire/              # Livewire component classes
  Models/                # Eloquent models
  Providers/             # Service providers (incl. Fortify)

resources/views/
  auth/                  # Login view
  components/            # Blade components
    icon/                #   SVG icon components
  dashboard/             # Dashboard page views
  layouts/               # App and guest layouts
  livewire/              # Livewire component views

routes/
  web.php                # All application routes

config/
  fortify.php            # Authentication configuration
`

### Blade Components

| Category   | Components |
|------------|------------|
| Layout     | app-logo, sidebar, sidebar-section, sidebar-link, topbar, user-menu, breadcrumb, page-header, content-container, panel |
| UI         | card, stat-card, badge, alert, button, dropdown, modal, tabs, tab, tab-panel, avatar |
| Form       | form-field, input, textarea, select, checkbox, radio-group, toggle |
| Data       | table, th, td, empty-state, loading-skeleton, search-input |
| Dashboard  | metric-grid, activity-timeline, notification-list, chart-container, widget-card |
| Layout Helpers | grid, stack |
| Icons      | icon.home, icon.chart, icon.table, icon.cube, icon.cog |

### Livewire Components

| Component          | Description                              |
|--------------------|------------------------------------------|
| DismissibleAlert   | Auto-dismissible alert with type support |
| SearchableTable    | Searchable, sortable, paginated table    |
| UpdateProfileForm  | Profile info and password update         |
| MetricWidget       | Auto-refreshing metric display           |
| ConfirmModal       | Confirmation dialog with events          |

## Customization

### Theme Colors

Edit `resources/css/app.css` to change the color palette:

`css
--color-primary-*: /* Blue by default */
--color-accent-*:  /* Violet by default */
--color-success-*: /* Green */
--color-warning-*: /* Amber */
--color-danger-*:  /* Red */
--color-sidebar-*: /* Slate */
`

### Adding Sidebar Links

Add entries in `resources/views/components/sidebar.blade.php`:

`lade
<x-sidebar-link href="/dashboard/new-page" :active="request()->is('dashboard/new-page')">
    <x-slot:icon><!-- SVG --></x-slot:icon>
    New Page
</x-sidebar-link>
`

### Adding Dashboard Pages

1. Create a view in `resources/views/dashboard/`
2. Add a route in `routes/web.php` inside the auth middleware group
3. Add a sidebar link (see above)

## Using as a Template

1. Clone or fork this repository
2. Run the installation steps above
3. Remove or modify the demo pages as needed
4. Replace the demo seeder data with your own
5. Build your application on top of the existing component library

## Tech Stack

- [Laravel 12](https://laravel.com)
- [Livewire 4](https://livewire.laravel.com)
- [Laravel Fortify](https://laravel.com/docs/fortify)
- [Tailwind CSS v4](https://tailwindcss.com)
- [Alpine.js](https://alpinejs.dev) (bundled with Livewire)

## License

Open-sourced under the [MIT license](https://opensource.org/licenses/MIT).
