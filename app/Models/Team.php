<?php

namespace App\Models;

use Database\Factories\TeamFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Model
{
    /** @use HasFactory<TeamFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'owner_id',
        'name',
        'description',
    ];

    /**
     * The owner of the team.
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    /**
     * The users that belong to the team.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->withPivot('role')
            ->withTimestamps();
    }

    /**
     * Invitations sent to join this team.
     */
    public function invitations(): HasMany
    {
        return $this->hasMany(TeamInvitation::class);
    }

    /**
     * Pending invitations for this team.
     */
    public function pendingInvitations(): HasMany
    {
        return $this->invitations()->pending();
    }

    /**
     * Get the ordinary team roles the user may assign.
     *
     * Ownership is intentionally excluded from this list.
     */
    public function assignableRolesFor(User $user): array
    {
        $hierarchy = config('pulsepanel.role_hierarchy', []);
        $membership = $this->users->firstWhere('id', $user->id);
        $actorLevel = $membership
            ? ($hierarchy[$membership->pivot->role] ?? 0)
            : ($user->can('manage teams') ? max($hierarchy) : 0);

        return collect($hierarchy)
            ->reject(fn (int $level, string $role): bool => $role === 'owner')
            ->filter(fn (int $level): bool => $level < $actorLevel)
            ->keys()
            ->values()
            ->all();
    }

    public function canAssignRole(User $user, string $role): bool
    {
        return in_array($role, $this->assignableRolesFor($user), true);
    }
}
