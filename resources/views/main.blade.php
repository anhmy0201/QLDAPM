@extends('layouts.app')

@section('content')
<div class="container mt-4">
    
    @if($news->count() > 0)
        @php $firstNews = $news->first(); @endphp
        <div class="card border-0 shadow-sm mb-5 overflow-hidden">
            <div class="row g-0">
                <div class="col-md-8">
                    <div class="ratio ratio-16x9 h-100">
                         <img src="{{ asset('storage/image/' . $firstNews->image) }}" 
                              class="object-fit-cover" alt="{{ $firstNews->title }}">
                    </div>
                </div>
                <div class="col-md-4 d-flex align-items-center bg-dark text-white">
                    <div class="card-body p-4">
                        <span class="badge bg-warning text-dark mb-2">Mới nhất</span>
                        <h3 class="card-title fw-bold">{{ $firstNews->title }}</h3>
                        <p class="card-text text-light opacity-75">{{ Str::limit($firstNews->description, 150) }}</p>
                        <p class="card-text"><small class="text-muted">{{ $firstNews->created_at->format('d/m/Y') }}</small></p>
                        <a href="{{ route('news.chitiet', $firstNews->id) }}" class="btn btn-outline-light mt-2">Đọc ngay</a>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-8">
            <h4 class="border-start border-4 border-primary ps-2 mb-4 fw-bold text-uppercase">Tin tức tổng hợp</h4>
            
            <div class="row row-cols-1 row-cols-md-2 g-4">
                @foreach($news->skip(1) as $item)
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm hover-shadow transition-card">
                        {{-- Ảnh bài viếtttt --}}
                        <div class="ratio ratio-4x3">
                            <img src="{{ asset('storage/image/' . $item->image) }}" 
                                 class="card-img-top object-fit-cover" alt="{{ $item->title }}">
                        </div>
                        
                        <div class="card-body d-flex flex-column">
                            {{-- Danh mục --}}
                            <div class="mb-2">
                                <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-10">
                                    {{ $item->Category->name ?? 'Tin tức' }}
                                </span>
                            </div>

                            {{-- Tiêu đề --}}
                            <h5 class="card-title fw-bold">
                                <a href="{{ route('news.chitiet', $item->id) }}" class="text-decoration-none text-dark stretched-link">
                                    {{ Str::limit($item->title, 60) }}
                                </a>
                            </h5>
                            
                            {{-- Mô tả ngắn --}}
                            <p class="card-text text-muted small flex-grow-1">
                                {{ Str::limit($item->description, 80) }}
                            </p>
                        </div>

                        {{-- Footer card --}}
                        <div class="card-footer bg-transparent border-top-0 d-flex justify-content-between align-items-center pb-3">
                            <small class="text-muted">
                                <i class="bi bi-calendar3"></i> {{ $item->created_at->format('d/m/Y') }}
                            </small>
                            <small class="text-primary fw-bold">Xem chi tiết <i class="bi bi-arrow-right"></i></small>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="col-lg-4 mt-5 mt-lg-0">
            <div class="sticky-top" style="top: 20px; z-index: 1;">
                <h4 class="border-start border-4 border-warning ps-2 mb-4 fw-bold text-uppercase">Đáng chú ý</h4>
                
                <div class="list-group list-group-flush shadow-sm rounded">
                    @foreach($news->take(5) as $item)
                    <a href="{{ route('news.chitiet', $item->id) }}" class="list-group-item list-group-item-action p-3 d-flex align-items-start">
                        <div class="flex-shrink-0 me-3" style="width: 80px;">
                            <div class="ratio ratio-1x1">
                                <img src="{{ asset('storage/image/' . $item->image) }}" 
                                     class="img-fluid rounded object-fit-cover" alt="...">
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-1 fw-bold text-dark">{{ Str::limit($item->title, 50) }}</h6>
                            <small class="text-muted d-block">{{ $item->created_at->diffForHumans() }}</small>
                        </div>
                    </a>
                    @endforeach
                </div>

                <div class="mt-4 p-4 bg-light rounded text-center border border-dashed">
                    <p class="text-muted mb-0">Khu vực quảng cáo</p>
                </div>
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