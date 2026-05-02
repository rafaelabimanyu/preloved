<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lookbook extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'cover_image',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    // ─── Relationships ─────────────────────────────────────────────

    public function images(): HasMany
    {
        return $this->hasMany(LookbookImage::class)->orderBy('sort_order');
    }

    // ─── Scopes ────────────────────────────────────────────────────

    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at')
                     ->where('published_at', '<=', now())
                     ->orderByDesc('published_at');
    }

    // ─── Helpers ───────────────────────────────────────────────────

    public function coverImageUrl(): string
    {
        if (!$this->cover_image) return asset('images/brand/placeholder-lookbook.jpg');
        if (str_starts_with($this->cover_image, 'http')) return $this->cover_image;
        return asset('storage/' . $this->cover_image);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
