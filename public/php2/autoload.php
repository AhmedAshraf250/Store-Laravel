<?php


// مبدأ الـ PSR-4
// Php standard recomantions
// الشروط

// لازم كل اسماء الكلاسات يكون بنفس اسم الفايل من الخارج
// النايم سباس الذى يشمل هذه الكلاسات لابد ان يكون اسمه على اسم المجدات بالخارج


function load_class($classname)
{
    include __DIR__ . "/{$classname}.php";
}

spl_autoload_register('load_class');

// =================================================================

// spl_autoload_register(
//     function ($classname) {
//         include __DIR__ . "/{$classname}.php";
//     }
// );



// وليكن انا عاوز استدعى الكلاس اللى فى نايم اسباس ايه\بى واسمه بيرسون
// لما بذكره فى الصفحة هذه الفانكشن بتشتغل ويكون بالشكل دا

// function load_class(A\B\Person)
// {
//     include __DIR__ . "/A\B\Person.php";
// }

// =================================================================

// class Autoloder
// {
//     public function register($classname)
//     {
//         include __DIR__ . "/{$classname}.php";
//     }
// }
// $a = new Autoloder;
// spl_autoload_register([$a, 'register']);
