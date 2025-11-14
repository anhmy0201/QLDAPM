@extends('layouts.app')
@section('content')
<div class="container">
<div class="row">
<div class="col-9">
<h4 class="text-primary fw-bold mb-4">TIN MỚI NHẤT</h4>
@foreach($news as $item)
<div class="rounded m-3 p-3 shadow">
<a asp-action="Chude" asp-route-id="@item.Chudeid" class="text-decoration-none">
<h5 class="text-warning border-bottom">
{{ $item->Category->name ?? 'Chung' }}
</h5>
</a>
<a asp-action="Details" asp-route-id="@item.Bantinid" class="text-decoration-none">
<h6 class="text-info">
{{ $item->title }}
</h6>
</a>
<div class="row">
<div class="col-4">
<img src="{{ asset('storage/app/private/' . $item->image) }}" class="imgthumbnail"/>
</div>
<div class="col">
<p class="text-black-50">{{ $item->created_at->format('d/m/Y H:i') }}</p>
<p>{{ Str::limit($item->description, 100) }}</p>
<p class="text-end"><a href="{{ route('news.detail', $item->id) }}"
class="btn btn-info">Xem thêm</a></p>
</div>
</div>
</div>
@endforeach
</div>
<div class="col-3">
<h4 class="text-center text-warning fw-bold mb-4">TIN NỔI BẬT</h4>
@foreach($news as $item)
<a asp-action="Details" asp-route-id="@t.Bantinid" class="text-decoration-none">
<div class="row p-1 mt-3 bg-light shadow">
<div class="col">
<img src="{{ asset('storage/app/private/' . $item->image) }}" class="imgthumbnail"/>
</div>
<div class="col">
nmvi@agu.edu.vn 8
<p>
{{ $item->title }}
<span class="text-muted">{{ $item->created_at->format('d/m/Y H:i')
}}</span>
</p>
</div>
</div>
</a>
@endforeach
</div>
</div>
</div>
@endsection