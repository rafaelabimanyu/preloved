<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LookbookImage extends Model
{
    protected $fillable = [
        'lookbook_id',
        'image_path',
        'caption',
        'linked_item_id',
        'sort_order',
    ];

    // ─── Relationships ─────────────────────────────────────────────

    public function lookbook(): BelongsTo
    {
        return $this->belongsTo(Lookbook::class);
    }

    public function linkedItem(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'linked_item_id');
    }

    // ─── Helpers ───────────────────────────────────────────────────

    public function url(): string
    {
        if (str_starts_with($this->image_path, 'http')) return $this->image_path;
        return asset('storage/' . $this->image_path);
    }
}
