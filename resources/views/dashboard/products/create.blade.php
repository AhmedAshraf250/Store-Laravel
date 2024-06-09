@extends('layouts.dashboard.app')

@section('title', 'Create Products')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item "><a href="{{ route('dashboard.products.index') }}">Products</a></li>
    <li class="breadcrumb-item active">@yield('title')</li>
@endsection

@section('content')

    <form action="{{ route('dashboard.products.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @include('dashboard.products._form')
    </form>

@endsection
