@extends('layouts.app_admin')
@section('content')
<div class="container mt-4">
    <h3 class="text-info">Danh sách bình luận</h3>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr class="text-center">
                    <th width="5%">STT</th>
                    <th width="25%">Tin tức</th>
                    <th width="15%">Người gửi</th>
                    <th width="35%">Nội dung</th>
                    <th width="10%">Chi tiết</th>
                    <th width="10%">Xóa</th>
                    <th width="10%">duyệt</th>
                </tr>
            </thead>
            <tbody>
                @foreach($commentsall as $value)
                @if($value->status == 0)
                <tr valign="middle">
                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $value->news->title}}</td>

                    <td>{{ $value->user->name}}</td>

                    <td>{{ $value->content }}</td>

                    <td class="text-center">
                        <a href="{{ route('news.detail', $value->new_id) }}" class="btn btn-light">
                            Chi tiết
                        </a>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('comment.delete', $value->id) }}"
                           class="btn btn-danger"
                           onclick="return confirm('Bạn có muốn xóa bình luận này không?')">
                           Xóa
                        </a>
                    </td>
                    <td class="Text-center">
                            <a href="{{ route('comment.duyet', ['id' => $value->id]) }}" class="btn btn-success"
                        onclick="return confirm('Bạn có muốn duyệt bình luận {{ $value->content }}
                        không?')">Duyệt</a>
                        </td>
                </tr>
                  @endif
                @endforeach
              
            </tbody>

        </table>
    </div>
</div>
@endsection
