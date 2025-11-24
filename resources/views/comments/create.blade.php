@extends('layouts.app_admin')
@section('content')

<div class="container mt-4">
    @if(Auth::check() && Auth::user()->role == "0")
    <p><a href="{{ route('news') }}">Về danh sách</a></p>
    @endif
    <h3 class="text-info">Đăng tin</h3>

    <form action="{{ route('news.create') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label" for="category_id">Chủ đề</label>
            <select class="form-select" id="category_id" name="category_id">
                @foreach($category as $value)
                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label" for="title">Tiêu đề</label>
            <input type="text" class="form-control" id="title" name="title"  />
        </div>

        <div class="mb-3">
            <label class="form-label" for="description">Tóm tắt</label>
            <textarea class="form-control" id="description" name="description" ></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label" for="image">Hình</label>
            <input type="file" class="form-control" id="image" name="image" />
        </div>

        <div class="mb-3">
            <label class="form-label" for="content">Nội dung</label>
            <textarea class="form-control" id="content" name="content"  rows="10"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Lưu</button>
    </form>
</div>
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
<script>
ClassicEditor
    .create(document.querySelector('#content'), {
        ckfinder: {
            uploadUrl: "{{ route('ckeditor.upload').'?_token='.csrf_token() }}"
        }
    })
    .catch(error => {
        console.error(error);
    });
</script>

@endsection
