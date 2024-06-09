{{-- @props(['attribute' => 'defualt value']) --}}
@props([
    'label' => false,
    'type' => 'text',
    'name',
    'value' => '',
])

@if ($label)
    <label for="">{{ $label }}</label>
@endif

<input type={{ $type }} name={{ $name }} value="{{ old($name, $value) }}" {{-- @class(['form-control', 'is-invalid' => $errors->has($name)]) --}}
    {{ $attributes->class(['is-invalid' => $errors->has($name)]) }}>

{{-- @if ($errors->has('name')) --}}
@error($name)
    <div class="invalid-feedback">{{ $message }}</div>
@enderror










{{-- <input @class(['form-control', 'is-invalid' => $errors->has('name')]) type="text" name="name" id=""
    value="{{ old('name', $category->name ?? '') }}"> --}}

{{-- @if ($errors->has('name')) --}}


{{-- @error('name') --}}
{{-- <div class="invalid-feedback">{{ $message }}</div> --}}
{{-- @enderror --}}
