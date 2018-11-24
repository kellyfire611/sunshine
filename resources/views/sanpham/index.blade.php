@extends('backend.layouts.index')

@section('title')
Danh sach san pham
@endsection

@section('main-content')
<div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has('alert-' . $msg))
      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
      @endif
    @endforeach
</div>

<a href="{{ route('danhsachsanpham.create') }}" class="btn btn-primary">Thêm mới sản phẩm</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Mã</th>
            <th>Tên</th>
            <th>Hình ảnh</th>
            <th>Thuộc loại</th>
            <th>Sửa-Xóa</th>
        </tr>
    </thead>
    <tbody>
        @foreach($danhsachsanpham as $sp)
            <tr>
                <td>{{ $sp->sp_ma }}</td>
                <td>{{ $sp->sp_ten }}</td>
                <td><img src="{{ asset('storage/photos/' . $sp->sp_hinh) }}" class="img-list" /></td>
                <td>{{ $sp->loaisanpham->l_ten }}</td>
                <td>
                    <a href="{{ route('danhsachsanpham.edit', ['id' => $sp->sp_ma]) }}" class="btn btn-primary pull-left">Sửa</a>
                    <form method="post" action="{{ route('danhsachsanpham.destroy', ['id' => $sp->sp_ma]) }}" class="pull-left">
                        <input type="hidden" name="_method" value="DELETE" />
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger">Xoa</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection