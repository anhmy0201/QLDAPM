<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SavedNews extends Model
{
    protected $table = 'saved_news';

    protected $fillable = [
        'user_id',
        'news_id'
    ];

    // Mỗi bản ghi thuộc về 1 user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Mỗi bản ghi thuộc về 1 news
    public function news(): BelongsTo
    {
        return $this->belongsTo(News::class);
    }
}
