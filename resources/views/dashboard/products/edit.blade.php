@extends('layouts.dashboard.app')

@section('title', 'Edit Products')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard.products.index') }}">Products</a>
    </li>
    <li class="breadcrumb-item active">@yield('title')</li>
@endsection

@section('content')

    <form action="{{ route('dashboard.products.update', $product->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put') <!-- method 'put' for 'update' -->
        @include('dashboard.products._form', ['button_label' => 'update'])
    </form>

@endsection
