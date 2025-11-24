<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class News extends Model
{
    protected $table = 'news';
    public function Category(): BelongsTo // mỗi bản tin thuộc một danh mục
    {return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function User(): BelongsTo // mỗi bản tin do một user đăng
    {return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function Comments(): HasMany // mỗi bản tin có nhiều bình luận
    {return $this->HasMany(Comment::class, 'new_id', 'id');
    }
}
