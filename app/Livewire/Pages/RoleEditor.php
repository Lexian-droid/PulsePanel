<?php

namespace App\Livewire\Pages;

use App\Models\User;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

#[Layout('components.layouts.app', ['title' => 'Role Editor', 'breadcrumbs' => ['Role Editor' => null]])]
class RoleEditor extends Component
{
    use WithPagination;

    public string $search = '';

    public string $filterRole = '';

    public ?int $editingUserId = null;

    public string $selectedRole = '';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingFilterRole(): void
    {
        $this->resetPage();
    }

    public function editUser(int $userId): void
    {
        $target = User::findOrFail($userId);

        if (! auth()->user()->can('manage-role', $target)) {
            session()->flash('error', 'You do not have permission to edit this user\'s role.');

            return;
        }

        $this->editingUserId = $userId;
        $this->selectedRole = $target->roles->first()?->name ?? '';
    }

    public function updateRole(): void
    {
        $target = User::findOrFail($this->editingUserId);

        if (! auth()->user()->can('manage-role', $target)) {
            session()->flash('error', 'You do not have permission to edit this user\'s role.');
            $this->cancelEdit();

            return;
        }

        $hierarchy = config('pulsepanel.role_hierarchy', []);
        $newRoleLevel = $hierarchy[$this->selectedRole] ?? 0;
        $currentUserLevel = auth()->user()->roleLevel();

        if ($newRoleLevel >= $currentUserLevel) {
            session()->flash('error', 'You cannot assign a role equal to or higher than your own.');
            $this->cancelEdit();

            return;
        }

        $target->syncRoles([$this->selectedRole]);

        session()->flash('success', "Updated {$target->name}'s role to {$this->selectedRole}.");
        $this->cancelEdit();
    }

    public function cancelEdit(): void
    {
        $this->editingUserId = null;
        $this->selectedRole = '';
    }

    public function render(): View
    {
        $currentUser = auth()->user();
        $hierarchy = config('pulsepanel.role_hierarchy', []);

        $users = User::query()
            ->with('roles')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->filterRole, function ($query) {
                $query->role($this->filterRole);
            })
            ->orderBy('name')
            ->paginate(15);

        $allRoles = Role::orderBy('name')->pluck('name');

        // Roles this user can assign (only roles below their level)
        $assignableRoles = $allRoles->filter(function ($roleName) use ($currentUser, $hierarchy) {
            $roleLevel = $hierarchy[$roleName] ?? 0;

            return $roleLevel < $currentUser->roleLevel();
        });

        return view('dashboard.role-editor', [
            'users' => $users,
            'allRoles' => $allRoles,
            'assignableRoles' => $assignableRoles,
            'hierarchy' => $hierarchy,
        ]);
    }
}
