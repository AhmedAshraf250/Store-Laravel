@props(['options', 'name', 'checked', 'i' => 1])


@foreach ($options as $value => $text)
    <div class="form-check">

        <input type="radio" name={{ $name }} value={{ $value }}
            id="statusRadio{{ $i }}" @checked(old($name, $checked) == $value)
            {{ $attributes->class(['form-check-input', 'is-invalid' => $errors->has($name)]) }}>

        <label for="statusRadio{{ $i++ }}" class="form-check-label">
            {{ $text }}
        </label>
    </div>
@endforeach


{{-- Old One Befor Components --}}

{{--
    <div class="form-check">
    <input
        class="form-check-input @error('status') is-invalid @enderror"
        type="radio" name="status" value="archived" id="statusRadio2"
        @checked(old('status', $category->status ?? '') === 'archived')>
    <label class="form-check-label" for="statusRadio2">Archived</label>
</div>
--}}



{{-- @if (isset($category)) @checked(old('status', $category->status ?? '') === 'active') @else checked @endif> --}}
