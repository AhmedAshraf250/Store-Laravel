<?php
/**
 * # Commands for Laravel:
 *
 *     > php artisan key:generate // '.env' file to generate other key to the Application in that variable 'APP_KEY'
 *
 *     > php artisan config:cache
 *     > php artisan config:clear
 *
 *     > php artisan make:seeder UsersSeeder
 *     > php artisan db:seed --class=UserTableSeeder
 *     > php artisan db:seed
 *      ==> It will execute the code it finds in the "DatabaseSeeder.php" class (with "call" method) -> (for Use with many seeders if available)
 *
 *     > php artisan make:factory ProductFactory
 *     > php artisan db:seed
 *
 *     > php artisan make:controller Dashboard\CategoriesController -r
 *
 *     > php artisan route:list   // {very importat to know all application routes and their names}
 *
 *     > php artisan storage:link  // look 'config\filesystems.php'->['links']
 *
 *     > composer dump-autoload
 *
 *     > php artisan make:request CategoryRequest
 *
 *     > php artisan make:rule Filter
 *
 *     > php artisan make:component alert --view
 *     > php artisan make:component form.input --view  // 'resources\views\components\form\input.blade.php'
 *     > php artisan make:component Nav          // "Full Component" ->  look: 'app\View\Components\Nav.php' & 'resources\views\components\nav.blade.php'
 *
 *     > php artisan vendor:publish --tag=laravel-pagination // to make modifications on default pagination styles // LOOK: 'resources\views\vendor\pagination'Folder
 *
 *     > php artisan make:migration add_softDeletes_to_categories_table
 *
 *     > php artisan make:scope ProductScope
 *
 *     > composer require symfony/intl
 *
 *
 */

use Illuminate\Support\Facades\Auth;

?>

<?php
// categories (id (PK), parent_id (FK), name, slug (UQ), ...)
// stores (id (PK), name, ...)
// products (id (PK), name, slug (UQ), description, price, ...)

// orders (id (PK), number, user_id, status)
// orders_items (order_id (FK), product_id, quantity)

// هذه الطريقة هى افضل لو عندى تصنيفات كثيره ويوجد تصنيفات بها تصنيفات اخرى فرعية وذلك بدلا من عمل جداول اخرى وربطهم بعضهم البعض
// ---- categories table ---- //
/*
id, parent_id, name
1 , null     , clothes
2 , 1        , child_clothes
3 , 2        , child_clothes_boys
4 , 2        , child_clothes_girls
*/

?>
`
<?php
Auth::user()->name
    /*
     * هذا الاوث فاساد كلاس بكتبه فى اى مكان فى البروجيكت بيتم التعرف عليه بدون ما نلحق به النايم اسبايس خاصته
     * !! اى اوث فاساد كلاس تقريبا جميعهم متعرفين فى الجلوبال نايم اسبايس  !!
     * يوجد بلارافيل حاجه اسمها الايلياسيس مثلا لما نكون فى ملفات الفيوز وعشان نستدعى مثلا كلاسات بنستخدمها كثيرا مثلا وعشان ما نضطر فى كل مره نلحق بها النايم اسبايس
     * جاءت الايلياسيس وحلت هذه المشكلة يمكن النظر فى ملف :ك
     * "config" Folder -> "app.php"
     * كما يمكن ان ننشئ كلاس خاص بنا ونعطى له اسم ونستدعيه بهذا الإسم فى الجلوبال نايم اسبايس عادى داخل هذا الكى "إلياسيس" فى ملف الآب:ك
        'aliases' => Facade::defaultAliases()->merge([
            'Auth' => \Illuminate\Support\Facades\Auth::class
            'ExampleClass' => App\Example\ExampleClass::class,
            // ...
        ])->toArray(),
    */

    /*
     *      @if(Auth::check)
     *          // do something
     *      @endif
     *
     *      @if(Auth::check)
     *      @endif
     *      (===)
     *      @auth
     *      @endauth
     * the opposite of @auth ==> @guest
     *
     *
     *
     *
     */
    ?>
<?php

// object always returns true even if that object is null

?>
<?php ?>
<?php ?>
<?php ?>
<?php ?>
<?php ?>
<?php ?>
<?php ?>
<?php ?>
<?php ?>
<?php ?>
<?php ?>
<?php ?>
<?php ?>
<?php ?>
<?php ?>
<?php ?>
<?php ?>
<?php ?>
<?php ?>
<?php ?>
<?php ?>
