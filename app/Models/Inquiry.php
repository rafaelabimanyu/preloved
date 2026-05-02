<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inquiry extends Model
{
    protected $fillable = [
        'name',
        'email',
        'instagram_handle',
        'message',
        'item_id',
        'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    // ─── Relationships ─────────────────────────────────────────────

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    // ─── Scopes ────────────────────────────────────────────────────

    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }
}
