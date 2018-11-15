@extends('backend.layouts.index')

@section('title')
Them moi loai san pham
@endsection

@section('main-content')
<form>
    <div class="form-group">
        <label for="l_ma">Email address</label>
        <input type="text" class="form-control" id="l_ma" name="l_ma" placeholder="Ma">
    </div>
    <div class="form-group">
        <label for="l_ten">Email address</label>
        <input type="text" class="form-control" id="l_ten" name="l_ten" placeholder="Ten">
    </div>
</form>
@endsection