@extends('layouts.app_admin')
@section('content')
<div class="container mt-4">
<h3 class="text-info">Danh sách bản tin</h3>
<div class="table-responsive">
<p><a href="{{ route('news.create') }}" class="btn btn-info">Thêm mới</a></p>
<table class="table table-bordered table-hover">
<thead>
<tr class="text-center">
<th width="5%">STT</th>
<th width="45%">Tiêu đề</th>
<th width="20%">Người đăng</th>
<th width="20%">Hình</th>
<th width="10%">Chi tiết</th>
<th width="10%">Sửa</th>
<th width="10%">Xóa</th>
</tr>
</thead>
<tbody>
@foreach($news as $value)
<tr valign="middle">
<td>{{ $loop->iteration }}</td>
<td>{{ $value->title }}</td>
<td>{{ $value->user->name }}</td>
<td class="text-center">
    <img src="{{ asset('storage/image/' . $value->image) }}" 
         class="img-thumbnail object-fit-cover" 
         style="width: 100px; height: 60px;" 
         alt="Ảnh tin">
</td>
<td class="text-center">
<a href="{{ route('news.detail', ['id' => $value->id]) }}" class="btn btnlight">Chi tiết</a>
</td>
<td class="text-center">
<a href="{{ route('news.edit', ['id' => $value->id]) }}" class="btn btnwarning">Sửa</a>
</td>
<td class="text-center">
<a href="{{ route('news.delete', ['id' => $value->id]) }}" class="btn btn-danger"
onclick="return confirm('Bạn có muốn xóa bản tin {{ $value->name }}
không?')">Xóa</a>
</td>
</tr>
@endforeach
</tbody>
</table>
</div>
</div>

@endsection