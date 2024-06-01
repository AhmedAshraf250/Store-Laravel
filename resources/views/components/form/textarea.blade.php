@props(['label' => false, 'name', 'value' => ''])

@if ($label)
    <label for="">{{ $label }}</label>
@endif

<textarea name={{ $name }}
    {{ $attributes->class(['form-control', 'is-invalid' => $errors->has($name)]) }}>{{ old($name, $value) }}
</textarea>


@error($name)
    <div class="invalid-feedback">{{ $message }}</div>
@enderror




{{-- OLD CODE BEFORE COMPONENT --}}

{{-- <label for="">Category Description</label>
<textarea class="form-control" name="description" id="">
    {{ old('description', $category->description ?? '') }}
</textarea> --}}
