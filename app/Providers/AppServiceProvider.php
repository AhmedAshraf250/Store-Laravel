<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // إضافة رول جديده على الرولز سيستم تبع الفاليداتور
        // الفاليداتور فاساد بستدعيه من السيرفرس كونتانير
        // الإكستيند بتاخد 3 اجريومنت الاسم ثم اللوجيك وهو عبارة عن(اسم الكلاس او اسم فانكشن او الكلوجر فانكشن مباشرة) ثم نص رسالة الخطأ

        /*
        <input name="name" value=">
            - الاتريبيوت : بيمثل إسم الحقل, اى سيكون اسمه دائما "نايم"ك
            - الفاليو : هى القمية التى تم إدخالها فى هذا الحقل, اى القيمة التى كانت فى الريكوست
            - الباراميترز, القيم او الاجريومنتز اللى بنمررها للرول عند استخدامه فى الكود واللارافيل بتحولهم الى اراى حتى لو كان اجريومنت واحد
        */
        Validator::extend('filter', function ($attribute, $value, $parameters) {
            return !in_array(strtolower($value), $parameters);
        }, 'القيمة التى قمت بإدخالها محظورة');

        Paginator::useBootstrapFour();
        // Paginator::defaultView('pagination.custom'); // الابليكاشن كله هيستخدم هذا الملف كاالديفلت باجيناشن عند عمل باجيناشن لصفحة ما جوه الابليكاشن
    }
}
