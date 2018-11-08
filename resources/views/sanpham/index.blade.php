@extends('backend.layouts.index')

@section('title')
Danh sach san pham
@endsection

@section('main-content')
<table border="1">
    <thead>
        <tr>
            <th>Ma</th>
            <th>Ten</th>
            <th>Hinh anh</th>
            <th>Thuoc loai</th>
        </tr>
    </thead>
    <tbody>
        @foreach($danhsachsanpham as $sp)
            <tr>
                <td>{{ $sp->sp_ma }}</td>
                <td>{{ $sp->sp_ten }}</td>
                <td>{{ storage_path($sp->sp_hinh) }}</td>
                <td>{{ $sp->loaisanpham->l_ten }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection