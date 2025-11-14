@extends('layouts.app')
@section('content')
<p><a href="{{ route('news') }}">Về danh sách</a></p>
<h3 class="text-info">Chi tiết bản tin</h3>
<p><strong>Tên người đăng:</strong> {{ $name }}</p>
<p><strong>Ngày đăng:</strong> {{ $news->created_at->format('d/m/Y') }}</p>
<p><strong>Tiêu đề:</strong> {{ $news->title }}</p>
<p><strong>Hình</strong> <img src="{{ env('APP_URL') . '/news/storage/app/private/' . $news->image }}"
width="300" class="img-thumbnail"></p>
<p><strong>Nội dung:</strong> {{ $news->content }}</p>
<p>
<a href="{{ route('news.edit', ['id' => $news->id]) }}" class="btn btn-warning">Sửa</a>
<a href="{{ route('news.delete', ['id' => $news->id]) }}" class="btn btn-danger"
onclick="return confirm('Bạn có muốn xóa bản tin {{ $news->name }} không?')">Xóa</a>
</p>
@endsection