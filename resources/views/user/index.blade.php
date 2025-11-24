@extends('layouts.app_admin')
@section('content')
<div class="container mt-4">
<h3 class="text-info">Danh sách người dùng</h3>
<div class="table-responsive">

<table class="table table-bordered table-hover">
<thead>
<tr class="text-center">
<th width="5%">STT</th>
<th width="45%">Họ tên</th>
<th width="20%">email</th>
<th width="15%">Loại</th>
<th width="10%">Chi tiết</th>
<th width="10%">Xóa</th>
</tr>
</thead>
<tbody>
@foreach($user as $value)
<tr valign="middle">
<td>{{ $loop->iteration }}</td>
<td>{{ $value->name }}</td>
<td>{{ $value->email }}</td>
@if($value->role == 1)
<td>Độc giả</td>
@elseif($value->role == 2)
<td>Tác giả</td>
@else
<td>admin</td>
@endif
<td class="text-center">
<a href="{{ route('news.detail', ['id' => $value->id]) }}" class="btn btnlight">Chi tiết</a>
</td>
<td class="text-center">
<a href="{{ route('user.delete', ['id' => $value->id]) }}" class="btn btn-danger"
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