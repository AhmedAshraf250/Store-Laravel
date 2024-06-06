@extends('layouts.dashboard.app')

@section('title', 'Categories Trashes')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('dashboard.categories.index') }}">Categories</a></li>
    <li class="breadcrumb-item active">@yield('title')</li>
@endsection

@section('content')
    <a href="{{ route('dashboard.categories.index') }}" class=" mb-5 btn btn-group-lg btn-outline-primary">
        Back
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
                <th>Status</th>
                <th>Deleted_at</th>
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
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->status }}</td>
                    <td>{{ $category->deleted_at }}</td>
                    <td>
                        <form action="{{ route('dashboard.categories.restore', $category->id) }}" method="post">
                            @csrf
                            @method('put')
                            <input type="submit" class="btn btn-sm btn-info" value="Restore">
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('dashboard.categories.force-delete', $category->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <input type="submit" class="btn btn-sm btn-danger" value="Full Delete!">
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7"> No Categories Defined</td>
                </tr>
            @endforelse
        </tbody>

    </table>

    {{ $categories->withQueryString()->links() }}

@endsection
