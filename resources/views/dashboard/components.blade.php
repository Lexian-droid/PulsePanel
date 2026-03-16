<x-content-container>
    <x-page-header subtitle="A showcase of all available Blade components.">
        Components Showcase
    </x-page-header>

    <x-stack gap="8">
        {{-- Buttons --}}
        <x-card>
            <x-slot:header>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Buttons</h3>
            </x-slot:header>
            <div class="flex flex-wrap items-center gap-3">
                <x-button>Primary</x-button>
                <x-button variant="secondary">Secondary</x-button>
                <x-button variant="danger">Danger</x-button>
                <x-button variant="success">Success</x-button>
                <x-button variant="ghost">Ghost</x-button>
            </div>
            <div class="mt-4 flex flex-wrap items-center gap-3">
                <x-button size="sm">Small</x-button>
                <x-button size="md">Medium</x-button>
                <x-button size="lg">Large</x-button>
                <x-button disabled>Disabled</x-button>
            </div>
        </x-card>

        {{-- Badges --}}
        <x-card>
            <x-slot:header>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Badges</h3>
            </x-slot:header>
            <div class="flex flex-wrap items-center gap-3">
                <x-badge>Default</x-badge>
                <x-badge color="primary">Primary</x-badge>
                <x-badge color="success">Success</x-badge>
                <x-badge color="warning">Warning</x-badge>
                <x-badge color="danger">Danger</x-badge>
            </div>
            <div class="mt-3 flex flex-wrap items-center gap-3">
                <x-badge size="sm">Small</x-badge>
                <x-badge size="md">Medium</x-badge>
                <x-badge size="lg">Large</x-badge>
            </div>
        </x-card>

        {{-- Alerts --}}
        <x-card>
            <x-slot:header>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Alerts</h3>
            </x-slot:header>
            <x-stack gap="3">
                <x-alert type="info">This is an informational message.</x-alert>
                <x-alert type="success">Operation completed successfully!</x-alert>
                <x-alert type="warning">Please review your settings before continuing.</x-alert>
                <x-alert type="danger">An error occurred while processing your request.</x-alert>
                <x-alert type="info" dismissible>This alert can be dismissed. Click the X to close it.</x-alert>
            </x-stack>
        </x-card>

        {{-- Avatars --}}
        <x-card>
            <x-slot:header>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Avatars</h3>
            </x-slot:header>
            <div class="flex items-center gap-4">
                <x-avatar name="John Doe" size="xs" />
                <x-avatar name="Jane Smith" size="sm" />
                <x-avatar name="Alex Kim" size="md" />
                <x-avatar name="Sarah Chen" size="lg" />
                <x-avatar name="PulsePanel" size="xl" />
            </div>
        </x-card>

        {{-- Cards --}}
        <x-card>
            <x-slot:header>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Cards & Panels</h3>
            </x-slot:header>
            <x-grid cols="3">
                <x-card>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Simple card with default padding.</p>
                </x-card>
                <x-card>
                    <x-slot:header>
                        <h4 class="font-medium text-gray-900 dark:text-white">Card with Header</h4>
                    </x-slot:header>
                    <p class="text-sm text-gray-500 dark:text-gray-400">This card has a header section.</p>
                </x-card>
                <x-widget-card title="Widget Card">
                    <p class="text-sm text-gray-500 dark:text-gray-400">A card designed for dashboard widgets.</p>
                </x-widget-card>
            </x-grid>
        </x-card>

        {{-- Stat Cards --}}
        <x-card>
            <x-slot:header>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Stat Cards</h3>
            </x-slot:header>
            <x-metric-grid cols="3">
                <x-stat-card label="Total Revenue" value="$54,231" change="+12%" changeType="up" icon="chart" />
                <x-stat-card label="Active Users" value="2,431" change="+3.2%" changeType="up" icon="home" />
                <x-stat-card label="Bounce Rate" value="24.5%" change="+1.5%" changeType="down" icon="chart" />
            </x-metric-grid>
        </x-card>

        {{-- Forms --}}
        <x-card>
            <x-slot:header>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Form Elements</h3>
            </x-slot:header>
            <div class="max-w-lg space-y-4">
                <x-form-field label="Text Input" hint="Enter your full name.">
                    <x-input placeholder="John Doe" />
                </x-form-field>
                <x-form-field label="Email" required>
                    <x-input type="email" placeholder="john@example.com" />
                </x-form-field>
                <x-form-field label="With Error" error="This field is required.">
                    <x-input placeholder="Required field" />
                </x-form-field>
                <x-form-field label="Select">
                    <x-select :options="['option1' => 'Option One', 'option2' => 'Option Two', 'option3' => 'Option Three']" placeholder="Choose an option..." />
                </x-form-field>
                <x-form-field label="Textarea">
                    <x-textarea placeholder="Write your message here..." rows="3" />
                </x-form-field>
                <x-form-field label="Checkboxes">
                    <div class="flex flex-wrap gap-4">
                        <x-checkbox label="Option A" checked />
                        <x-checkbox label="Option B" />
                        <x-checkbox label="Option C" />
                    </div>
                </x-form-field>
                <x-form-field label="Radio Group">
                    <x-radio-group name="demo-radio" :options="['small' => 'Small', 'medium' => 'Medium', 'large' => 'Large']" />
                </x-form-field>
                <x-form-field label="Toggle Switch">
                    <x-toggle label="Enable notifications" />
                </x-form-field>
            </div>
        </x-card>

        {{-- Table --}}
        <x-card>
            <x-slot:header>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Table</h3>
            </x-slot:header>
            <x-table striped>
                <x-slot:head>
                    <tr>
                        <x-th>Name</x-th>
                        <x-th>Role</x-th>
                        <x-th>Status</x-th>
                        <x-th>Joined</x-th>
                    </tr>
                </x-slot:head>
                @foreach([
                ['name' => 'Alice Johnson', 'role' => 'Admin', 'status' => 'Active', 'date' => 'Jan 15, 2026'],
                ['name' => 'Bob Smith', 'role' => 'Editor', 'status' => 'Active', 'date' => 'Feb 20, 2026'],
                ['name' => 'Carol White', 'role' => 'Viewer', 'status' => 'Inactive', 'date' => 'Mar 01, 2026'],
                ] as $row)
                <tr>
                    <x-td>
                        <div class="flex items-center gap-3">
                            <x-avatar :name="$row['name']" size="sm" />
                            <span class="font-medium text-gray-900 dark:text-white">{{ $row['name'] }}</span>
                        </div>
                    </x-td>
                    <x-td>{{ $row['role'] }}</x-td>
                    <x-td>
                        <x-badge :color="$row['status'] === 'Active' ? 'success' : 'gray'">{{ $row['status'] }}</x-badge>
                    </x-td>
                    <x-td>{{ $row['date'] }}</x-td>
                </tr>
                @endforeach
            </x-table>
        </x-card>

        {{-- Empty State --}}
        <x-card>
            <x-slot:header>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Empty State</h3>
            </x-slot:header>
            <x-empty-state
                title="No projects yet"
                description="Get started by creating your first project.">
                <x-slot:action>
                    <x-button>Create Project</x-button>
                </x-slot:action>
            </x-empty-state>
        </x-card>

        {{-- Loading Skeleton --}}
        <x-card>
            <x-slot:header>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Loading Skeleton</h3>
            </x-slot:header>
            <x-loading-skeleton rows="3" cols="4" />
        </x-card>

        {{-- Tabs --}}
        <x-card>
            <x-slot:header>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Tabs</h3>
            </x-slot:header>
            <x-tabs active="general">
                <x-slot:tabs>
                    <x-tab name="general">General</x-tab>
                    <x-tab name="advanced">Advanced</x-tab>
                    <x-tab name="api">API</x-tab>
                </x-slot:tabs>
                <x-tab-panel name="general">
                    <p class="text-sm text-gray-500 dark:text-gray-400">General settings content goes here.</p>
                </x-tab-panel>
                <x-tab-panel name="advanced">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Advanced settings content goes here.</p>
                </x-tab-panel>
                <x-tab-panel name="api">
                    <p class="text-sm text-gray-500 dark:text-gray-400">API configuration content goes here.</p>
                </x-tab-panel>
            </x-tabs>
        </x-card>

        {{-- Modal Demo --}}
        <x-card>
            <x-slot:header>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Modal</h3>
            </x-slot:header>
            <x-button x-data @click="$dispatch('open-modal', 'demo-modal')">Open Modal</x-button>
            <x-modal name="demo-modal" maxWidth="md">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Example Modal</h3>
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">This is a reusable modal component. You can put any content here.</p>
                <div class="mt-6 flex justify-end gap-3">
                    <x-button variant="secondary" x-data @click="$dispatch('close-modal', 'demo-modal')">Cancel</x-button>
                    <x-button x-data @click="$dispatch('close-modal', 'demo-modal')">Confirm</x-button>
                </div>
            </x-modal>
        </x-card>

        {{-- Dropdown --}}
        <x-card>
            <x-slot:header>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Dropdown</h3>
            </x-slot:header>
            <x-dropdown>
                <x-slot:trigger>
                    <x-button variant="secondary">
                        Options
                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </x-button>
                </x-slot:trigger>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700">Edit</a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700">Duplicate</a>
                <a href="#" class="block px-4 py-2 text-sm text-danger-600 hover:bg-gray-100 dark:hover:bg-gray-700">Delete</a>
            </x-dropdown>
        </x-card>
    </x-stack>
</x-content-container>