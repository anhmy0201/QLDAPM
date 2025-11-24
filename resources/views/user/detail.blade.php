@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-5">
        <div class="row g-0 align-items-center">
            {{-- Cột avatar --}}
           <div class="col-md-3 text-center p-4 bg-light">
    <div class="rounded-circle overflow-hidden mb-3" 
         style="width:120px; height:120px; margin:auto; display:flex; align-items:center; justify-content:center; background:#f0f0f0;">
        @if($user->avatar==null)
            <img src="{{ asset('storage/upload/default-avatar.jpg') }}" 
                 class="img-fluid" alt="{{ $user->name }}" 
                 style="width:100%; height:100%; object-fit:cover;">
        @else
            <img src="{{ asset('storage/upload/' . $user->avatar) }}" 
                 style="width:100%; height:100%; object-fit:cover;">
        @endif
    </div>
</div>

            {{-- Cột thông tin người dùng --}}
            <div class="col-md-9 p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h3 class="fw-bold mb-1">{{ $user->name }}</h3>
                        <p class="text-muted mb-1"><i class="bi bi-envelope-fill me-2"></i>{{ $user->email }}</p>
                        @if($user->bio==null)
                        <p class="text-muted small">{{'Chưa cập nhật tiểu sử.' }}</p>
                        @else
                        <p class="text-muted small">{{ $user->bio }}</p>
                        @endif
                        <div class="mt-2">
                            <span class="badge bg-primary me-2">Bài viết: {{ $user->news->count() }}</span>
                            <span class="badge bg-success">Tham gia: {{ $user->created_at->format('d/m/Y') }}</span>
                        </div>
                    </div>
                    @if(Auth::id() === $user->id)
                          <div class="mt-auto">
            <a href="{{ route('user.edit', ['id' => $user->id]) }}" class="btn btn-outline-primary btn-sm">Chỉnh sửa hồ sơ</a>
        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-13">
            <h5 class="text-secondary fw-semibold mb-3">Các bài viết gần đây</h5>
            <div class="row row-cols-1 row-cols-md-4 g-4">
                @foreach($user->news as $post)
                @if($post->status == 1)
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm hover-shadow transition-card">
                        <div class="ratio ratio-4x3">
                            <img src="{{ asset('storage/upload/' . $post->image) }}" 
                                 class="card-img-top object-fit-cover" alt="{{ $post->title }}">
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold">
                                <a href="{{ route('news.chitiet', $post->id) }}" class="text-decoration-none text-dark stretched-link">
                                    {{ Str::limit($post->title, 60) }}
                                </a>
                            </h5>
                            <p class="card-text text-muted small flex-grow-1">
                                {{ Str::limit($post->description, 80) }}
                            </p>
                        </div>
                        <div class="card-footer bg-transparent border-top-0 d-flex justify-content-between align-items-center pb-3">
                            <small class="text-muted"><i class="bi bi-calendar3"></i> {{ $post->created_at->format('d/m/Y') }}</small>
                            <small class="text-primary fw-bold">Xem chi tiết <i class="bi bi-arrow-right"></i></small>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
</div>

<style>
.hover-shadow:hover {
    transform: translateY(-5px);
    box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
}
.transition-card {
    transition: all 0.3s ease;
}
</style>

@include('layouts.footer')
@endsection
