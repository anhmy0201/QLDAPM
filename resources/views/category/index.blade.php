@extends('layouts.app')
@section('content')
<h3 class="text-info">Danh mục chủ đề</h3>
<div class="table-responsive">
<p><a href="{{ route('category.create') }}" class="btn btn-info">Thêm mới</a></p>
<table class="table table-bordered table-hover">
<thead>
<tr class="text-center">
<th width="5%">STT</th>
<th width="45%">Tên danh mục</th>
<th width="20%">Thứ tự</th>
<th width="10%">Chi tiết</th>
<th width="10%">Sửa</th>
<th width="10%">Xóa</th>
</tr>
</thead>
<tbody>
@foreach($category as $value)
<tr>
<td>{{ $loop->iteration }}</td>
<td>{{ $value->name }}</td>
<td>{{ $value->order }}</td>
<td class="text-center">
<a href="{{ route('category.detail', ['id' => $value->id]) }}" class="btn btnlight">Chi tiết</a>
</td>
<td class="text-center">
<a href="{{ route('category.edit', ['id' => $value->id]) }}" class="btn btnwarning">Sửa</a>
</td>
<td class="text-center">
<a href="{{ route('category.delete', ['id' => $value->id]) }}" class="btn btndanger"
onclick="return confirm('Bạn có muốn xóa danh mục {{ $value->name }}
không?')">Xóa</a>
</td>
</tr>
@endforeach
</tbody>
</table>
</div>
@endsection