<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;

class Nav extends Component
{
    // Class-based components allow you to define both the template and the behavior of the component in a class.

    // البروبيرتى أيتيمس بدل اسكوبها بابليك هنا يبقى هتكون بطبيعة الحال متضمنه تلقائيا فى ملف الفيو اللى فى ميثود الريندر
    // اما لو بروتيكتيد فأكيد لازم نمررها ونضمنها يديويا داخل ملف الفيو هذا
    public $items;
    public $active;



    /**
     * Create a new component instance.
     *
     * @return void
     */

    // <x-nav context="side" />
    // عند تمرير باراميترز او اتريبيوتس لكومبوننت له كلاس, يتم استقبالهم فى "كونستراكت" اللى فى هذا الكلاس بنفس الإسم ونفس الترتيبب
    // public function __construct($context = 'side'){//logic}

    public function __construct()
    {
        // هننشئ ملف "الناف" وطبعا ملفات الكونفج بترجع دائما اراى, يعنى هحتفظ بالاراى  هنا داخل الايتمس بروبيرتى
        $this->items = config('nav');
        $this->active = Route::currentRouteName();
        // بترجع اليو-ار-ال الحالى بالظبط كما هو, يعنى لو فى داخل مجال الكاتيجوريز ودخلت على فرع انشاء كاتيجورى جديد مثلا اليو-ار-ال بتاع الانشاء طبعا بيكون له يو-ار-ال خاص له ومعرف له, وهنا المشكلة ,
        // وبالتالى استخدام هذه الفكره لطباعة كلمة "اكتيف" لتحديد اى التابات هى اللى نشطة , لن يكون دقيقاً, وبالتالى عرفنا كى الـ "اكتيف" داخل ملف "ناف" فى فلدر "كونفج"ك

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        //الريندر ميثود مسئول عن ارجاع ملف الفيو المسئول عن عرض هذا الكومبوننت
        return view('components.nav');
    }
}
