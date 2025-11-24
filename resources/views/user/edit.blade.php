@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-5">
        <div class="row g-0">
            <div class="col-md-3 text-center p-4 bg-light">
                <div class="rounded-circle overflow-hidden mb-3" style="width:120px; height:120px; margin:auto;">

                </div>
                <form action="{{ route('user.edit', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="avatar" class="form-label btn btn-outline-secondary btn-sm w-100">Đổi avatar</label>
                        <input type="file" id="avatar" name="avatar" class="form-control d-none" accept="image/*" onchange="previewAvatar(event)">
                    </div>
            </div>
            <div class="col-md-9 p-4">
                <h3 class="fw-bold mb-3">Chỉnh sửa hồ sơ</h3>
                
                <div class="mb-3">
                    <label for="name" class="form-label">Tên</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                </div>

                <div class="mb-3">
                    <label for="bio" class="form-label">Tiểu sử</label>
                    <textarea class="form-control" id="bio" name="bio" rows="4">{{ old('bio', $user->bio) }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
function previewAvatar(event) {
    const reader = new FileReader();
    reader.onload = function(){
        const output = document.getElementById('avatarPreview');
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>

@include('layouts.footer')
@endsection
