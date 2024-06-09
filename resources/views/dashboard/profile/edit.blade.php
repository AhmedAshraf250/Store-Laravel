@extends('layouts.dashboard.app')

@section('title', 'Edit Profile')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard.profile.edit') }}">Profile</a>
    </li>
    <li class="breadcrumb-item active">@yield('title')</li>
@endsection

@section('content')

    <x-alert type="success" />
    <x-alert type="info" />

    <form action="{{ route('dashboard.profile.update') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('patch') <!-- method 'put' for 'update' -->

        <div class="form-row">
            <div class="col-md-6">
                <x-form.input class="form-control" name="first_name" label="First Name" :value="$user->profile->first_name" />
            </div>
            <div class="col-md-6">
                <x-form.input class="form-control" name="last_name" label="Last Name" :value="$user->profile->last_name" />
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-6">
                <x-form.input class="form-control" name="birthday" type="date" label="Birthday" :value="$user->profile->birthday" />
            </div>
            <div class="col-md-6">
                <x-form.radio name="gender" label="Gender" :options="['male' => 'Male', 'female' => 'Female']" :checked="$user->profile->gender" />
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-4">
                <x-form.input class="form-control" name="street_address" label="Street Address" :value="$user->profile->street_address" />
            </div>
            <div class="col-md-4">
                <x-form.input class="form-control" name="city" label="City" :value="$user->profile->city" />
            </div>
            <div class="col-md-4">
                <x-form.input class="form-control" name="state" label="State" :value="$user->profile->state" />
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-4">
                <x-form.input class="form-control" name="postal_code" label="Postal Code" :value="$user->profile->postal_code" />
            </div>
            <div class="col-md-4">
                <x-form.select name="country" label="Country" :options="$countries" :selected="$user->profile->country" />
            </div>
            <div class="col-md-4">
                <x-form.select name="locale" label="Locale" :options="$locales" :selected="$user->profile->locale" />
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>

@endsection
