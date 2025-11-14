<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Category extends Model
{
protected $table = "categories";
public function News(): HasMany{ // mỗi danh mục có nhiều bản tin
return $this->hasMany(News::class, 'category_id', 'id');
}
}
