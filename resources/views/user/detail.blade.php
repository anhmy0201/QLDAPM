@extends('layouts.app_admin')

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
                            <img src="{{ asset('storage/image/' . $news->image) }}" 
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
                  <div> ------------------------------------------------------------------------------------------------------------------------------ </div>
                <!-- Danh sách bình luận -->
                @if($news->comments->count() > 0)
                  <ul class="list-group mb-4" id="commentList">
    @forelse($news->comments as $comment)
        <li class="list-group-item">
            <strong>{{ $comment->user->name ?? 'Khách' }}</strong>
            <small class="text-muted float-end">{{ $comment->created_at->format('d/m/Y H:i') }}</small>
            <p class="mb-0 mt-1">{{ $comment->content }}</p>
        </li>
    @empty
        {{-- chưa có comment --}}
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
    .content-body img { max-width: 100%; height: auto; border-radius: 0.5rem; margin: 1rem 0; }
    .breadcrumb a { text-decoration: none; }
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