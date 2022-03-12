<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Record extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'total',
        'comment',
        'type',
        'category_id',
        'user_id',
        'created_at',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
