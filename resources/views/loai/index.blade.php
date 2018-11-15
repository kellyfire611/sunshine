@extends('backend.layouts.index')

@section('title')
Danh sach loai san pham
@endsection

@section('main-content')
<h1>Hello first action from <span style="color: red;">LoaiController</span></h1>

<div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has('alert-' . $msg))
      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
      @endif
    @endforeach
</div>

<table border="1">
    <thead>
        <tr>
            <th>Ma</th>
            <th>Ten</th>
            <td>Sua</td>
            <td>Xoa</td>
        </tr>
    </thead>
    <tbody>
        @foreach($danhsachloai as $loai)
            <tr>
                <td>{{ $loai->l_ma }}</td>
                <td>{{ $loai->l_ten }}</td>
                <td><a href="{{ route('danhsachloai.edit', ['id' => $loai->l_ma]) }}">Sua</a></td>
                <td>
                    <form method="post" action="{{ route('danhsachloai.destroy', ['id' => $loai->l_ma]) }}">
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