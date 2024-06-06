@if ($errors->any())
    <div class="alert alert-danger">
        <h3>Errors Occured!</h3>
        <ul>
            @foreach ($errors->all() as $error)
                <li> {{ $error }} </li>
            @endforeach
        </ul>
    </div>
@endif

{{-- old() --}}
{{-- الاولد فانكشن وظيفتها بترجع القيمة التى كانت فى حقل ما فى الريكوست السابق, وعشان نحدد القيم اكيد بنعطى هذه الفانكشن اسم الانبت بداخلها --}}
{{-- اما الاجريومنت التانى الذى بداخلها فهترجع قيمته لو ما وجدت قيمة لاسم الحقل الذى يوجد فى الاجريومنت الاول, الذى نحصل عليه بالطبع من الريكوست السابق --}}

{{-- Category Name Field --}}
<div class="form-group">
    <x-form.input label="Category Name" class="form-control form-control-lg" type="text" name="name"
        :value="$category->name ?? ''" />
</div>


{{-- Select Field --}}
<div class="form-group form-select">
    <label for="">Category Parent</label>
    <select class="form-control @error('parent_id') is-invalid @enderror" name="parent_id" id="">
        <option value="">As a Master Parent</option>
        @foreach ($cate_parents as $parent)
            <option value="{{ old('parent_id', $parent->id ?? '') }}"
                @if (isset($category)) @selected($category->parent_id == $parent->id) @endif>
                {{ $parent->name }}
            </option>
        @endforeach
    </select>
    @error('parent_id')
        <div class="text-danger">{{ $errors->first('parent_id') }}</div>
    @enderror
</div>


{{-- Category Description Field --}}
<div class="form-group">
    <x-form.textarea label="Category Description" name="description" :value="$category->description ?? ''" />
</div>


{{-- Image Upload 'FILE' Field --}}
<div class="form-group">
    <x-form.label id="image">Upload image</x-form.label>
    <x-form.input {{-- label="Upload image" --}} class="form-control-file" type="file" name="image" accept="image/*" />
</div>

<div class="form-group">
    <img src="{{ isset($category->image) ? asset('storage/' . $category->image) : asset('storage/uploads/cate.jpg') }}"
        alt="" height="200" srcset="">
</div>


{{-- Status 'Radio check' Field --}}
<div class="form-group">
    <label for="">Status</label>
    <div>
        <x-form.radio name="status" :checked="$category->status ?? 'active'" :options="['active' => 'Active', 'archived' => 'Archived']" />
    </div>
    @error('status')
        <div class="text-danger">{{ $errors->first('status') }}</div>
    @enderror
</div>


{{-- SUBMIT --}}
<div class="form-group">
    <button class=" form-control btn btn-success" type="submit" id="">{{ $button_label ?? 'Save' }}</button>
</div>
