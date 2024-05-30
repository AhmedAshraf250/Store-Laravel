<?php

// الفاساد كلاسيس فى اللارافيل بيشتغل على مبدأ "الماجيك ميثودز" اللى موجود فى كلاسات البى اتش بى

class PersonFacade
{
    protected static $container = 'person_facade';

    public static function __callStatic($name, $arguments)
    {
        $person = ServiceContainer::make(self::$container);
        return $person->$name(...$arguments);
    }

}



PersonFacade::name(1, 2, 3);
//                          public static function __callStatic(name, [1,2,3])
//                              {
//                                  $person = ServiceContainer::make('person_facade');
//                                  $person->name([1,2,3]);
//                              }
PersonFacade::age(1, 2, 3);
//                          public static function __callStatic(age, [1,2,3])
//                              {
//                                  $person = ServiceContainer::make('person_facade');
//                                  $person->age([1,2,3]);
//                              }
// لو انا مثلا جيت استدعى هذه الميثود داخل هذا الكلاس ولكن هذه الميثود لا توجد بداخله
// فى هذه الحالة يتم تمرير إسم هذه الميثود الى الماجيك ميثود "كال-استاتيك" الموجوده داخل هذا الكلاس


