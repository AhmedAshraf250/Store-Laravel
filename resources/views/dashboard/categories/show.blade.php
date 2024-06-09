@extends('layouts.dashboard.app')

@section('title', $category->name)

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard.categories.index') }}">Categories</a>
    </li>
    <li class="breadcrumb-item active">@yield('title')</li>
@endsection

@section('content')

    <table class="table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Store</th>
                <th>Status</th>
                <th>Created_at</th>

            </tr>
        </thead>
        <tbody>


            @php
                $products = $category->products()->withoutGlobalScope('store')->with('store')->paginate(5);
            @endphp

            @forelse($products as $product)
                <tr>
                    <td>
                        <img src="{{ $product->image ? $product->image : asset('storage/uploads/cate.jpg') }}" alt=""
                            height="50" srcset="">
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>
                        {{ $product->store->name ?? 'Store Not Found' }}
                    </td>
                    <td>{{ $product->status }}</td>
                    <td>{{ $product->created_at }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5"> No Products Defined</td>
                </tr>
            @endforelse
        </tbody>

    </table>

    {{ $products->links() }}

@endsection
