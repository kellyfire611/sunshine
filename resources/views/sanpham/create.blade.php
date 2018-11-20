@extends('backend.layouts.index')

@section('title')
Them moi san pham
@endsection

@section('main-content')
<form method="post" action="{{ route('danhsachsanpham.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="l_ma">Loại sản phẩm</label>
        <select name="l_ma">
            @foreach($danhsachloai as $loai)
            <option value="{{ $loai->l_ma }}">{{ $loai->l_ten }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="sp_ten">Tên sả phẩm</label>
        <input type="text" class="form-control" id="sp_ten" name="sp_ten" placeholder="Ma">
    </div>
    <div class="form-group">
        <label for="sp_giaGoc">Giá gốc</label>
        <input type="text" class="form-control" id="sp_giaGoc" name="sp_giaGoc" placeholder="Ten">
    </div>
    <div class="form-group">
        <label for="sp_hinh">Hình đại diện</label>
        <input type="file" name="sp_hinh" />
    </div>

    <button type="submit" class="btn btn-primary">Luu</button>
</form>
@endsection