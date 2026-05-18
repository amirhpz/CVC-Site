<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubmenuPermission extends Model
{
    use HasFactory;

    protected $table = 'submenu_permissions';

    protected $fillable = ['submenu_id', 'role_id', 'user_id', 'can_create', 'can_edit', 'can_delete'];

    public function submenu(): BelongsTo
    {
        return $this->belongsTo(Submenu::class, 'submenu_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }
}
