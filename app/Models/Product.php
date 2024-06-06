<?php

namespace App\Models;

use App\Models\Scopes\ProductScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class Product extends Model
{
    use HasFactory;

    // GLOBAL SCOPE
    // هذه الميثود لارافيل بتستخدمها لكى تعمل تهيئه او إنشيليزاشن للمودل هذا يعنى بووت مع انطلاقه وتشغيله
    // زى ما فى على مستوى الابليكاشن "الآب سيرفيسس بروفيدرز" عشان نعمل بوت إستراب للأبليكشان, كمان لو بعمل بوت إستراب للمودل نفسه زى لو فيه عمليات هضيفها على المودل بشكل اساسى وتلقائى
    // لذلك يوجد به استاتيك ميثود بنعرفها وبنضيف بها الاكواد اللى عاوزينها تتنفذ مع كل مره يتم إستخدام هذا المودل
    public static function booted()
    {
        // static::addGlobalScope('store', function (Builder $builder) {
        //     $user = Auth::user();
        //     if ($user->store_id) {
        //         $builder->where('store_id', '=', $user->store_id);
        //     }
        // });
        // // بمرر له كلاس وابجيكت منه او كلوشر فانكشن عادى


        // > php artisan make:scope ProductScope
        static::addGlobalScope('store', new ProductScope());

    }
}
