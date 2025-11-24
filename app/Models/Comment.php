<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    protected $table = 'comments';
    public function News(): BelongsTo // mỗi bình luận thuộc một bản tin
    {return $this->belongsTo(News::class, 'new_id', 'id');
    }
    public function User(): BelongsTo // mỗi bình luận thuộc một bản tin
    {return $this->belongsTo(User::class, 'user_id', 'id');
    }
    protected $fillable = [
        'new_id',   
        'user_id',
        'email',
        'content',
        'status'
    ];
}
