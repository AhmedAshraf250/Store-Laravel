<?php

namespace App\Models;

use App\Rules\Filter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Category extends Model
{
    use HasFactory;

    // white list
    protected $fillable = ['name', 'slug', 'parent_id', 'image', 'description', 'status'];
    // black list
    protected $guarded = [];


    public static function rules($id = 0)
    {
        return [

            // 'name'=> 'unique:table,column,except,id'
            // لابد ان نستثنى "الاسم" نفسه عند التعديل مثلا, فى حالة لو عاوز اعدل فى الحقول التانية بس هترك اسم الكاتوجرى كما هو, لن تتم عملية التعديل ودائما سيظهر خطأ يقول ان هذا الاسم موجود بالفعل فى الجدول فى عمود "النايم"ك

            // 'name' => "required|string|min:3|max:255|unique:categoires,name,$id",
            'name' => [
                'required',
                'string',
                'min:3',
                'max:255',
                Rule::unique('categories', 'name')->ignore($id),
                // لعمل كاستوم رول او رول خاص بنا يوجد 3 طرق
                /*
                1- اول طريقة وهى لو الرول هستخدمه هنا على مستوى هذا الفاليداشن وبعد كدا مش هحتاجه عن طريق -> كالباك او كلوشر فانكشن اى ليس لها اسم لكى استدعيها به ولكن اللارافيل هى من ستستدعيها وتمرر لها الاجريومنتس
                    هذه الفانكشن بتاخد 3 اجريومنت:ك
                    <input name="name" value=">
                        - الاتريبيوت : بيمثل إسم الحقل, اى سيكون اسمه دائما "نايم"ك
                        - الفاليو : هى القمية التى تم إدخالها فى هذا الحقل, اى القيمة التى كانت فى الريكوست
                        - الفايلز : هى ليست متغير بل كال باك فانكشن لارافيل هتستدعيها عند حدوث المشكلة, وتحتوى على رسالة الخطأ
                    اما بداخل هذه الفانكشن نكتب اللوجيك المراد تنفيذه
                */
                function ($attribute, $value, $fails) {
                    if (strtolower($value) == 'laravel') {
                        $fails('this name is Forbidden');
                    }
                },

                /*
                2- هذه الطريقة ستكون عامة ونقدر نستخدم الرول اللى هنعمله بهذه الطريقة فى اكثر من مكان وليس مقتصر فقط بداخل الملف الذى نعرفه به
                    > php artisan make:rule Filter          // make Class
                    - بنضيف لقائمة الرولز هنا اوبجيكت من الرول اللى انشئناه
                */
                new Filter(['php', 'html']),

                /*
                3- لارافيل اعطت ميزة تسمى نظام "الماكرز" لارافيل فى اغلت الاوبجيكت خاصتها من ضمنها "الفاليداتور" بتخلينا مثلا نزرع ميثود داخل الكلاس بدون ما نعدل على الكلاس وهذا هو نظام الماكروز
                     وبالطبع هذا الرول ايضا سيكون على مستوى الابليكاشن وبالتالى انسب مكان لكتابته سيكون فى فلدر "البروفايدرز"ك
                // look => '\app\Providers\AppServiceProvider.php'

                // فى النهاية لو الرول هستخدمه هنا بس ومش هحتاجه الا هنا مثلا يبقى استخدم الطريقة الاولى اما لو ممكن نحتاجه على مستوى الابليكاشن يبقى نستخدم الطريقة التانية والتالته
                */
                'filter:css,js,python'
            ],
            'parent_id' => ['nullable', 'integer', 'exists:categories,id'],
            'image' => ['image', 'max:1047576', 'dimensions:min_width=100,min_height=100', 'mimetypes:image/jpeg,image/png,image/jpg,image/gif,image/svg+xml'],
            'status' => 'in:active,archived'
        ];
    }
}
