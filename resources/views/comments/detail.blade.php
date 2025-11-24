@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="mb-3">
        <a href="{{ route('news') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left"></i> Quay lại danh sách
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h2 class="fw-bold text-primary mb-3">{{ $news->title }}</h2>
                    
                    @if($news->image)
                        <div class="text-center mb-4">
                            <img src="{{ asset('storage/upload/' . $news->image) }}" 
                                 class="img-fluid rounded shadow-sm border" 
                                 style="max-height: 400px; width: 100%; object-fit: cover;" 
                                 alt="{{ $news->title }}">
                        </div>
                    @endif
                    <div class="content-body text-justify">
                        <h5 class="fw-bold border-start border-4 border-warning ps-2 mb-3">Nội dung chi tiết</h5>
                        <p class="text-break" style="white-space: pre-line;">
                            <div class="text-break">
    {!! $news->content !!}
</div>

                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 mt-4 mt-lg-0">
            <div class="card border-0 shadow-sm sticky-top" style="top: 20px;">
                <div class="card-header bg-white fw-bold border-bottom">
                    <i class="bi bi-info-circle me-2"></i>Thông tin quản lý
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span class="text-muted">Người đăng</span>
                            <span class="fw-bold text-dark">{{ $name }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span class="text-muted">Ngày tạo</span>
                            <span class="fw-bold">{{ $news->created_at->format('d/m/Y') }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span class="text-muted">Giờ tạo</span>
                            <span class="fw-bold">{{ $news->created_at->format('H:i') }}</span>
                        </li>
                        @if(isset($news->Category))
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span class="text-muted">Danh mục</span>
                            <span class="badge bg-info">{{ $news->Category->name }}</span>
                        </li>
                        @endif
                    </ul>

                    <hr class="my-4">

                    <div class="d-grid gap-2">
                        <a href="{{ route('news.edit', ['id' => $news->id]) }}" class="btn btn-warning fw-bold">
                            <i class="bi bi-pencil-square me-2"></i>Chỉnh sửa bài viết
                        </a>
                        
                        <a href="{{ route('news.delete', ['id' => $news->id]) }}" 
                           class="btn btn-outline-danger"
                           onclick="return confirm('Bạn có chắc chắn muốn xóa bài viết: {{ $news->title }} không?')">
                            <i class="bi bi-trash me-2"></i>Xóa bài viết này
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .ck-toolbar {
        display: none !important;
    }
</style>

<script>
    ClassicEditor
        .create( document.querySelector( '#content' ), {
            ckfinder: {
            }
        })
        .catch( error => {
            console.error( error );
        });
</script>

@endsection