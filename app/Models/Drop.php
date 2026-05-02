<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Drop extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'cover_image',
        'status',
        'released_at',
        'ended_at',
    ];

    protected $casts = [
        'released_at' => 'datetime',
        'ended_at'    => 'datetime',
    ];

    // ─── Relationships ─────────────────────────────────────────────

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    // ─── Scopes ────────────────────────────────────────────────────

    public function scopeLive($query)
    {
        return $query->where('status', 'live');
    }

    public function scopePublished($query)
    {
        return $query->whereIn('status', ['live', 'ended'])
                     ->orderByDesc('released_at');
    }

    // ─── Helpers ───────────────────────────────────────────────────

    public function isLive(): bool
    {
        return $this->status === 'live';
    }

    public function coverImageUrl(): string
    {
        if (!$this->cover_image) return asset('images/brand/placeholder-drop.jpg');
        if (str_starts_with($this->cover_image, 'http')) return $this->cover_image;
        return asset('storage/' . $this->cover_image);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
