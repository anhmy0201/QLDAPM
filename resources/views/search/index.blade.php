@extends('layouts.app')
@section('content')
<div class="container mt-4">
<h3 class="text-info">Danh sách từ khóa tìm kiếm</h3>
<div class="table-responsive">

<table class="table table-bordered table-hover">
<thead>
<tr class="text-center">
<th width="5%">STT</th>
<th width="20%">Họ tên</th>
<th width="25%">Nội dung</th>
<th width="10%">Chi tiết</th>
<th width="10%">Xóa</th>
</tr>
</thead>
<tbody>
@foreach($search as $value)
<tr valign="middle">
<td>{{ $loop->iteration }}</td>
<td>{{ $value->user->name }}</td>
<td>{{ $value->keyword }}</td>
<td class="text-center">
<a href="{{ route('search.detail', ['id' => $value->id]) }}" class="btn btnlight">Chi tiết</a>
</td>
<td class="text-center">
<a href="{{ route('search.delete', ['id' => $value->id]) }}" class="btn btn-danger"
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