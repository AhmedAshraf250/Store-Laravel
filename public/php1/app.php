<?php


// __DIR__ ---> "d:\\Programming\\Laravel Course\\24-STORE\\public\\php"
include __DIR__ . '/Person.php';

$person = new Person;  // http://127.0.0.1:8000/php/app.php
$person2 = new Person;

$person->name = 'Mohammed';
$person2->name = 'Ahmed';

$person::$country = 'Palestine';
$person2::$country = 'misr';

var_dump($person, $person2); // سيكون الاوتبوت بهذا الشكل ولن يظهر بهم الاستاتيك بروبيرتى لانها بتكون على مستوى الكلاس وليس الاوبجيكت
/*
object(Person)#1 (3) {
    ["name"]=>
    string(8) "Mohammed"
    ["gender"]=>
    NULL
    ["age"]=>
    NULL
  }
object(Person)#2 (3) {
    ["name"]=>
    string(5) "Ahmed"
    ["gender"]=>
    NULL
    ["age"]=>
    NULL
  }
*/

echo $person::$country; // 'misr' // مصر وليس فلسطين .. لماذا ؟
// هنا سوف تظهر اخر قيمة استاتيك تم تحديثها لانها بتكون ثابته على مستوى الكلاس وبتتغير فى كل الاوبجيكت اللى معمول اخذ نسخة من هذا الكلاس
echo Person::$country; // 'misr'
echo $person::MALE; // 'm'
