<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Item extends Model
{
    protected $fillable = [
        'drop_id',
        'title',
        'slug',
        'description',
        'category',
        'size',
        'condition',
        'price',
        'status',
        'instagram_url',
        'cover_image',
        'measurements',
    ];

    protected $casts = [
        'measurements' => 'array',
        'price'        => 'decimal:2',
    ];

    // ─── Relationships ─────────────────────────────────────────────

    public function drop(): BelongsTo
    {
        return $this->belongsTo(Drop::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ItemImage::class)->orderBy('sort_order');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'item_tag');
    }

    public function inquiries(): HasMany
    {
        return $this->hasMany(Inquiry::class);
    }

    // ─── Scopes ────────────────────────────────────────────────────

    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }

    public function scopeByCategory($query, string $category)
    {
        return $query->where('category', $category);
    }

    // ─── Helpers ───────────────────────────────────────────────────

    public function isAvailable(): bool
    {
        return $this->status === 'available';
    }

    public function isSold(): bool
    {
        return $this->status === 'sold';
    }

    public function coverImageUrl(): string
    {
        if (!$this->cover_image) return asset('images/brand/placeholder-item.jpg');
        if (str_starts_with($this->cover_image, 'http')) return $this->cover_image;
        return asset('storage/' . $this->cover_image);
    }

    public function formattedPrice(): string
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
