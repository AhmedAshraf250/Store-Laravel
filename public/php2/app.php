<?php


// http://127.0.0.1:8000/php/app.php

namespace A;

use A\B\Person;
use PersonFacade;
use ServiceContainer;

//      $person2 = new B\Person;    ===> A/B/Person
//      $person2 = new \B\Person;   ===> /B/Person       !start from the root!

//      use B\Person;               ===> public\php2\B\Person
//      with (use) is start always from the root   we should not use (use \B\Person;)


// __DIR__ ---> "d:\\Programming\\Laravel Course\\24-STORE\\public\\php"
// include __DIR__ . '/A/Person.php';
// include __DIR__ . '/B/Person.php';

include __DIR__ . '/autoload.php';

// use B\Person;

// =================================================================

// تبسيط وشرح لفكرة السيرفرس كونتينر فى اللارافيل

$person = new Person;
$person->name = 'Ahmed';
$person->setAge(50);

// هنا فى هذه الخطوة انشانا اوبجيكت من كلاس البيرسون وحفظناه داخل السيرفر كونتينر

ServiceContainer::bind('person_facade', $person);

echo PersonFacade::name(); // 'Ahmed'
echo PersonFacade::age(); // 50

// =================================================================
exit;


use function B\hello;
use const B\LARAVEL;

hello();
echo LARAVEL;

$person = new \A\B\Person;
$person2 = new \B\Person;

$person->name = 'Mohammed';
$person2->name = 'Ahmed';

if ($person instanceof \A\B\Person) {
    // هل اوبجيكت البيرسون هذا ابن لهذا الكلاس ؟
    echo 'yes!';
}

$person::$country = 'Palestine';
$person2::$country = 'misr';

echo '<pre>';
var_dump($person);
echo '</pre>';


echo B\Person::$country; // will invloke "A\B\Person"
echo $person::MALE;
