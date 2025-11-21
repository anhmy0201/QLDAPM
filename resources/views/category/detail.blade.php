@extends('layouts.app_admin')
@section('content')
<div class="container mt-4">
<p><a href="{{ route('category') }}">Về danh sách</a></p>
<h3 class="text-info">Chi tiết</h3>
<p><strong>Tên:</strong> {{ $category->name }}</p>
<p>
<a href="{{ route('category.edit', ['id' => $category->id]) }}" class="btn btn-warning">Sửa</a>
<a href="{{ route('category.delete', ['id' => $category->id]) }}" class="btn btn-danger"
onclick="return confirm('Bạn có muốn xóa danh mục {{ $category->name }} không?')">Xóa</a>
</p>
</div>
@endsection
