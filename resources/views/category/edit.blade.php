@extends('layouts.app')
@section('content')
<div class="container mt-4">
<p><a href="{{ route('category') }}">Về danh sách</a></p>
<h3 class="text-info">Cập nhật</h3>
<form action="{{ route('category.edit', ['id' => $category->id]) }}" method="post">
@csrf
<div class="mb-3">
<label class="form-label" for="name">Tên</label>
<input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}"
required />
</div>
<button type="submit" class="btn btn-primary"> Lưu </button>
</form>
</div>
@endsection
