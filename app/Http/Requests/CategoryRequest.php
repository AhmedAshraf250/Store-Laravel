<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        // return [
        //     'name' => ['required', 'string', 'min:3', 'max:255', Rule::unique('categories', 'name')->ignore($id)],
        //     'parent_id' => ['nullable', 'integer', 'exists:categories,id'],
        //     'image' => ['image', 'max:1047576', 'dimensions:min_width=100,min_height=100', 'mimetypes:image/jpeg,image/png,image/jpg,image/gif,image/svg+xml'],
        //     'status' => 'in:active,archived'
        // ];

        // OR

        // > php artisan route:list
        // -----GET|HEAD        dashboard/categories/{category}/edit
        // $this->route('categories'); => return 11 //
        // ---------- http://localhost:8000/dashboard/categories/11/edit

        // look "> php artisan route:list"    // i get the "parameter name" form url [dashboard/categories/{category}]
        $id = $this->route('category');

        // فى مودل الكاتيجورى عرفنا بداخله هذه الميثود "رولز" وبتحتاج بداخلها اجريومينت, طب كيف امرر هذا الاجريومنت لها ؟ .. بالاعلى
        return Category::rules($id);
    }

    public function messages()
    {
        return [
            // 'required' => 'This Field(:attribute) is required',
            // 'unique' => 'This Field(:attribute) is Already Exists',
            // 'image.max' => 'الصورة التى قمت برفعهاأكبر من 2 ميجابايت'
        ];
    }
}
