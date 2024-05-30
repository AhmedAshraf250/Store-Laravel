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
<div class="form-group">
    <label for="">Category Name</label>
    <input @class(['form-control', 'is-invalid' => $errors->has('name')]) type="text" name="name" id=""
        value="{{ old('name', $category->name ?? '') }}">


    {{-- @if ($errors->has('name')) --}} <!-- معناها هل يوجد اخطاء لحقل النايم او به اخطاء؟, لو به هتعطى ترو  -->
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
        {{-- متغير "الماسيج" يكون معترف به فقط داخل دياريكتف "الإيرور", وبتكون وظيفته عرض اول رسالة خطا تكون داخل اسم هذا الحقل --}}
    @enderror
</div>



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



<div class="form-group">
    <label for="">Category Description</label>
    <textarea class="form-control" name="description" id="">{{ old('description', $category->description ?? '') }}</textarea>
</div>



<div class="form-group">
    <label for="">Image</label>
    <input class="form-control-file @error('image') is-invalid @enderror" type="file" name="image" id="">
    @error('image')
        <div class="text-danger">{{ $errors->first('image') }}</div>
    @enderror
</div>
<div class="form-group">
    <img src="{{ isset($category->image) ? asset('storage/' . $category->image) : asset('storage/uploads/cate.jpg') }}"
        alt="" height="200" srcset="">
</div>



<div class="form-group">
    <label for="">Status</label>
    <div>
        <div class="form-check">
            <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status"
                value="active" id="statusRadio1" @checked(old('status', $category->status ?? 'active') === 'active') {{-- @if (isset($category)) @checked(old('status', $category->status ?? '') === 'active') @else checked @endif> --}}>
            <label class="form-check-label" for="statusRadio1">Active</label>
        </div>
        <div class="form-check">
            <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status"
                value="archived" id="statusRadio2" @checked(old('status', $category->status ?? '') === 'archived')>
            <label class="form-check-label" for="statusRadio2">Archived</label>
        </div>
    </div>
    @error('status')
        <div class="text-danger">{{ $errors->first('status') }}</div>
    @enderror
</div>



<div class="form-group">
    <button class=" form-control btn btn-success" type="submit" id="">{{ $button_label ?? 'Save' }}</button>
</div>
