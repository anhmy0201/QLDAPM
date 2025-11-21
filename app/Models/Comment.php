<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    protected $table = 'comments';
    public function News(): BelongsTo // mỗi bình luận thuộc một bản tin
    {return $this->belongsTo(News::class, 'news_id', 'id');
    }
}
