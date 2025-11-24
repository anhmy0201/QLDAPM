@extends('layouts.app')

@section('content')
<div class="container my-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb bg-light p-2 rounded">
            <li class="breadcrumb-item"><a href="{{ route('news') }}">Trang chủ</a></li>
            @if(isset($news->Category))
            <li class="breadcrumb-item"><a href="#">{{ $news->Category->name }}</a></li>
            @endif
            <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($news->title, 50) }}</li>
        </ol>
    </nav>

    <!-- Article -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-5">
        @if($news->image)
        <img src="{{ asset('storage/image/' . $news->image) }}" class="img-fluid w-100" style="max-height:500px; object-fit:cover;" alt="{{ $news->title }}">
        @endif

        <div class="card-body px-4 py-5">
            <h1 class="fw-bold mb-2">{{ $news->title }}</h1>
            <div class="text-muted mb-4 small">
                <span>{{ $news->created_at->format('d/m/Y H:i') }}</span>
                @if(isset($news->Category))
                    | <span>{{ $news->Category->name }}</span>
                @endif
            </div>

            <div class="content-body mb-5" style="line-height: 1.8; font-size: 1.05rem;">
                {!! $news->content !!}
            </div>

            <!-- Bình luận -->
            <div class="comments">
                <h5 class="fw-bold mb-3">Bình luận</h5>
                  <!-- Form thêm bình luận -->
                <form id="commentForm">
    @csrf
      <div class="mb-3">
<label for="commentContent" class="form-label d-flex align-items-center cursor-pointer">
    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm me-2" 
         style="width: 36px; height: 36px; font-weight: bold; font-size: 16px;">
        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
    </div>
    
    <div class="d-flex flex-column">
        <span class="fw-bold text-dark lh-1">{{ Auth::user()->name }}</span>
    </div>
</label>
                            <textarea class="form-control" id="commentContent" name="content" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-send-fill me-1"></i> Gửi bình luận</button>
                </form>
</form>
                  <div> --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- </div>
                <!-- Danh sách bình luận -->
                @if($news->comments->count() > 0)
                  <ul class="list-group mb-4" id="commentList">
    @forelse($news->comments as $comment)
        <li class="list-group-item position-relative">

    <strong>{{ $comment->user->name ?? 'Khách' }}</strong>
    <small class="text-muted float-end">{{ $comment->created_at->format('d/m/Y H:i') }}</small>
    <p class="mb-0 mt-1">{{ $comment->content }}</p>
    <div class="dropdown position-absolute top-0 end-0 mt-4 me-2">
        <button class="btn btn-sm border-0 bg-transparent text-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-three-dots-vertical fs-5"></i>
        </button>

        <ul class="dropdown-menu dropdown-menu-end">
            <li>
                <button class="dropdown-item text-danger report-btn" data-id="{{ $comment->id }}">
                    <i class="bi bi-flag-fill me-1"></i> Báo cáo
                </button>
            </li>
        </ul>
    </div>
</li>
    @empty
    @endforelse
</ul>
                @else
                    <p class="text-muted">Chưa có bình luận nào.</p>
                @endif
    <!-- Related news -->
    @if(isset($relatedNews) && $relatedNews->count() > 0)
    <div class="mt-5">
        <h5 class="fw-bold mb-3">Bài viết liên quan</h5>
        <div class="row g-3">
            @foreach($relatedNews as $item)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm rounded-3 overflow-hidden">
                    @if($item->image)
                    <img src="{{ asset('storage/image/' . $item->image) }}" class="card-img-top" style="height:200px; object-fit:cover;" alt="{{ $item->title }}">
                    @endif
                    <div class="card-body">
                        <h6 class="card-title">
                            <a href="{{ route('news.show', ['id' => $item->id]) }}" class="text-decoration-none text-dark">
                                {{ Str::limit($item->title, 50) }}
                            </a>
                        </h6>
                        <small class="text-muted">{{ $item->created_at->format('d/m/Y') }}</small>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>

<style>
    .content-body img { max-width: 100%; height: auto; border-radius: 0.5rem; margin: 1rem 0; }
    .breadcrumb a { text-decoration: none; }
</style>
<script>
document.getElementById('commentForm').addEventListener('submit', function(e){
    e.preventDefault();

    let content = document.getElementById('commentContent').value;
    let newsId = {{ $news->id }};
    let token = document.querySelector('input[name="_token"]').value;

    fetch(`/comments/create/${newsId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        },
        body: JSON.stringify({ content: content })
    })
    .then(res => res.json())
    .then(data => {
        if(data.success){
            let commentList = document.getElementById('commentList');
            if(commentList){
                commentList.insertAdjacentHTML('beforeend', `
                    <li class="list-group-item">
                        <strong>${data.user_name}</strong>
                        <small class="text-muted float-end">${data.created_at}</small>
                        <p class="mb-0 mt-1">${data.content}</p>
                    </li>
                `);
            }
            document.getElementById('commentContent').value = '';
        }
    })
    .catch(err => console.log(err));
});


</script>

@endsection
