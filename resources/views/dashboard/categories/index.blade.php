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


    <x-alert type="success" />
    <x-alert type="info" />

    <table class="table">
        <thead>
            <tr>
                <th>Image</th>
                <th>ID</th>
                <th>Name</th>
                <th>Parent</th>
                <th>Created_at</th>
                <th colspan="2">Actions</th>
            </tr>
        </thead>
        <tbody>
            {{--        ميثود الكاونت هذا يوجد فى اوبجيكت "الكوليكشن" الذى يوجد فى متغير الكاتيجوريز --}}
            {{--        @if ($categories) --> objects always return true -> even they were null or empty --}}

            {{--        @if ($categories->count()) --}}
            {{--            @foreach ($categories as $category) --}}
            {{--                <tr> --}}
            {{--                    <td></td> --}}
            {{--                    <td>{{$category->id}}</td> --}}
            {{--                    <td>{{$category->name}}</td> --}}
            {{--                    <td>{{$category->parent_id}}</td> --}}
            {{--                    <td>{{$category->created_at}}</td> --}}
            {{--                    <td> --}}
            {{--                        <a href="{{route('categories.edit')}}" class="btn btn-sm btn-outline-success">Edit</a> --}}
            {{--                    </td> --}}
            {{--                    <td> --}}
            {{--                        <form action="{{route('$categories.destroy')}}" method="post"> --}}
            {{--                            @csrf --}}
            {{--                            @method('delete') --}}
            {{--                            --}}{{--                        <input type="hidden" name="_method" value="delete"> --}}
            {{--                            <input type="submit" class="btn btn-sm btn-outline-danger" value="Delete"> --}}
            {{--                        </form> --}}
            {{--                    </td> --}}
            {{--                </tr> --}}
            {{--            @endforeach --}}
            {{--        @else --}}
            {{--            <tr> --}}
            {{--                <td colspan="7"> No Categories Defined</td> --}}
            {{--            </tr> --}}
            {{--        @endif --}}
            <!--=========================================================================-->
            {{-- @forelse()  empty  @endforelse --}} {{-- empty Must exist --}}
            {{--        طبعا لابد من وجود "إمتى" فى جمل "الفورإيلس" حيث تقوم بعمل اللوب وعرضه وتنفيذه ان وجد فى الاوبجيكت او الاراى وان لم يوجد تقوم بتنفيذ وعرض ما بعد "إمتى" --}}
            @forelse($categories as $category)
                <tr>
                    <td><img src="{{ $category->image ? asset('storage/' . $category->image) : asset('storage/uploads/cate.jpg') }}"
                            alt="" height="50" srcset="">
                    </td>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->parent_id ? $parents[$category->parent_id] : 'Primary Parent' }}</td>
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
                    <td colspan="7"> No Categories Defined</td>
                </tr>
            @endforelse
        </tbody>

    </table>

@endsection
