<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'color',
    ];

    // ─── Relationships ─────────────────────────────────────────────

    public function items(): BelongsToMany
    {
        return $this->belongsToMany(Item::class, 'item_tag');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
