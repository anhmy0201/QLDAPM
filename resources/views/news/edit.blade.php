@extends('layouts.app_admin')
@section('content')
<div class="container mt-4">
<p><a href="{{ route('news') }}">Về danh sách</a></p>
<h3 class="text-info">Cập nhật bản tin</h3>
<form action="{{ route('news.edit', $news->id) }}" method="post" enctype="multipart/form-data">
@csrf
<div class="mb-3">
<label class="form-label" for="category_id">Chủ đề</label>
<select class="form-select" id="category_id" name="category_id">
@foreach($category as $value)
<option value="{{ $value->id }}" {{ ($news->category_id == $value->id) ? 'selected' :
'' }} >{{ $value->name }}</option>
@endforeach
</select>
</div>
<div class="mb-3">
<label class="form-label" for="title">Tiêu đề</label>
<input type="text" class="form-control" id="title" name="title" required value="{{ $news->title
}}"/>
</div>
<div class="mb-3">
<label class="form-label" for="description">Tóm tắt</label>
<textarea type="text" class="form-control" id="description" name="description" required>{{
$news->description }}</textarea>
</div>
<div class="row">
    <div class="col-12"> 
        <div class="mb-3">
            <label class="form-label" for="content">Nội dung</label>
            <textarea class="form-control" id="content" name="content" rows="10" required>{{ $news->content }}</textarea>
        </div>
    </div>
</div>
<div class="mb-3">
<label class="form-label" for="image">Hình</label>
<input type="file" class="form-control" id="image" name="image" />
</div>
<div class="mb-3">
<label class="form-label" for="caption">Tiêu đề hình</label>
<input type="text" class="form-control" id="caption" name="caption" value="{{ $news->caption
}}"/>
</div>
<button type="submit" class="btn btn-primary"> Lưu </button>
</form>
</div>
@endsection