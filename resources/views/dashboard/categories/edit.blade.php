@extends('layouts.dashboard.app')

@section('title', 'Edit Categories')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard.categories.index') }}">Categories</a>
    </li>
    <li class="breadcrumb-item active">@yield('title')</li>
@endsection

@section('content')

    <form action="{{ route('dashboard.categories.update', $category->id) }}" method="post"
        enctype="multipart/form-data">
        @csrf
        @method('put') <!-- method 'put' for 'update' -->
        @include('dashboard.categories._form', [
            'button_label' => 'update',
        ])
    </form>

@endsection
