{{-- View này sẽ kế thừa giao diện từ `frontend.layouts.index` --}}
@extends('frontend.layouts.index')

{{-- Thay thế nội dung vào Placeholder `title` của view `frontend.layouts.index` --}}
@section('title')
Giỏ hàng Shop Hoa tươi - Sunshine
@endsection

{{-- Thay thế nội dung vào Placeholder `custom-css` của view `frontend.layouts.index` --}}
@section('custom-css')
@endsection

{{-- Thay thế nội dung vào Placeholder `main-content` của view `frontend.layouts.index` --}}
@section('main-content')

<!-- Hiển thị giỏ hàng -->
<ngcart-cart template-url="{{ asset('vendor/ngCart/template/ngCart/cart.html') }}" ></ngcart-cart>

@endsection

{{-- Thay thế nội dung vào Placeholder `custom-scripts` của view `frontend.layouts.index` --}}
@section('custom-scripts')
@endsection