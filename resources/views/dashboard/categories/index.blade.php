@extends('layouts.dashboard.app')

@section('title', 'Categories')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">@yield('title')</li>
@endsection

@section('content')
    <a href="{{ route('dashboard.categories.create') }}" class=" mb-5 btn btn-group-lg btn-outline-primary">
        Create Category
    </a>
    <a href="{{ route('dashboard.categories.trash') }}" class=" mb-5 btn btn-group-lg btn-outline-info">
        Trash
    </a>


    <x-alert type="success" />
    <x-alert type="info" />

    <form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mb-4">
        <x-form.input name="name" placeholder="Name" class="form-control mx-2" :value="request('name')" />
        <select name="status" class="form-control mx-2">
            <option value="">All</option>
            <option value="active" @selected(request('status') == 'active')>Active</option>
            <option value="archived" @selected(request('status') == 'archived')>Archived</option>
        </select>
        <button class="bth btn-dark mx-2" type="submit">Filter</button>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>Image</th>
                <th>ID</th>
                <th>Name</th>
                <th>Parent</th>
                <th>Products #</th>
                <th>Status</th>
                <th>Created_at</th>
                <th colspan="2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
                <tr>
                    <td>
                        <img src="{{ $category->image ? asset('storage/' . $category->image) : asset('storage/uploads/cate.jpg') }}"
                            alt="" height="50" srcset="">
                    </td>
                    <td>{{ $category->id }}</td>
                    <td><a href="{{ route('dashboard.categories.show', $category->id) }}"> {{ $category->name }}</a></td>
                    <td>
                        {{-- {{ $category->parent_id ? $parents[$category->parent_id] : 'Praimary Parent' }} --}}
                        {{ $category->parent->name }}
                    </td>
                    <td>{{ $category->products_count }}</td>
                    <td>{{ $category->status }}</td>
                    <td>{{ $category->created_at }}</td>
                    <td>
                        <a href="{{ route('dashboard.categories.edit', $category->id) }}"
                            class="btn btn-sm btn-outline-success">Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('dashboard.categories.destroy', $category->id) }}" method="post">
                            @csrf
                            @method('delete')
                            {{--                        <input type="hidden" name="_method" value="delete"> --}}
                            <input type="submit" class="btn btn-sm btn-outline-danger" value="Delete">
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9"> No Categories Defined</td>
                </tr>
            @endforelse
        </tbody>

    </table>

    {{-- must pass to this current file "paginate()" method, To "links()" works --}}

    {{-- Default pagination Style --}}
    {{ $categories->withQueryString()->links() }} {{-- === --}} {{-- $categories->appends(request()->all())->links() --}}
    {{ $categories->withQueryString()->links('pagination.custom') }} {{-- Custom Pagination (only here in this page or view file) --}}
    {{-- The withQueryString method appends the current query string parameters to each pagination link. This ensures that any filters, search terms, or other query parameters present in the URL are retained when navigating between paginated pages. --}}
    {{-- "> php artisan vendor:publish --tag=laravel-pagination" --}}
    {{-- LOOK: 'resources\views\vendor\pagination\bootstrap-4.blade.php' For more Info about pagination work --}}
@endsection
