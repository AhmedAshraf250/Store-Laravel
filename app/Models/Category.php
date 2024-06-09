<?php

namespace App\Models;

use App\Rules\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    // white list
    protected $fillable = ['name', 'slug', 'parent_id', 'image', 'description', 'status'];
    // black list
    protected $guarded = [];


    public static function rules($id = 0)
    {
        return [

            // 'name'=> 'unique:table,column,except,id'
            // 'name' => "required|string|min:3|max:255|unique:categoires,name,$id",
            'name' => [
                'required',
                'string',
                'min:3',
                'max:255',
                Rule::unique('categories', 'name')->ignore($id),

                // CUSTOM RULE :-      (3 Ways)

                //      1- Closure & anonymous function
                function ($attribute, $value, $fails) {
                    if (strtolower($value) == 'laravel') {
                        $fails('this name is Forbidden');
                    }
                },

                //      2-  > php artisan make:rule Filter          // make Class
                new Filter(['php', 'html']),


                //      3- ServiceProvider (Global rule)
                //          look => '\app\Providers\AppServiceProvider.php'
                'filter:css,js,python'
            ],


            'parent_id' => ['nullable', 'integer', 'exists:categories,id'],
            'image' => ['image', 'max:1047576', 'dimensions:min_width=100,min_height=100', 'mimetypes:image/jpeg,image/png,image/jpg,image/gif,image/svg+xml'],
            'status' => 'in:active,archived'
        ];
    }



    //                                  [ SCOPES ]
    // \Illuminate\Database\Query\Builder (Scopes always returns Builder Object, Even if I don't pass it on or define it)
    // ضفت اسم الجدول قبل كل اسم كولوم عشان لو استخدم جملة جوين قبل الاسكوب, تجنبا لبعض الكونفلكتات الغير متوقعه
    public function scopeActive(Builder $builder)
    {
        $builder->where('categories.status', 'active');
        // Category::active(); // to call and apply it
    }

    public function scopeStatus(Builder $builder, $status) // Dynamic Scope
    {
        $builder->where('categories.status', $status);
        // Category::status('active'); // to call and apply it
    }

    public function scopeFilter(Builder $builder, $filters)
    {
        if ($name = $filters['name'] ?? false) { // النايم هنا اساين وليست كومباريشن
            $builder->where('categories.name', 'LIKE', "%{$name}%");
        }
        if ($status = $filters['status'] ?? false) {
            $builder->where('categories.status', '=', $status);
        }
        // $categories = Category::filter(request()->query())->Paginate(2); // example in controller
    }


    //                                  [ Relationships ]

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id')->withDefault([
            'name' => '-',
        ]);
    }

    public function childern()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }


    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}
