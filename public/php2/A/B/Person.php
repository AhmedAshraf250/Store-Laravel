<?php


namespace A\B;


define('AJYAL', true); // هذا الثابت تابع للجلوبال نايم اسبايس وليس للنايم اسبايس هذه
const LARAVEL = 'laravel A'; // أما هذا الثابت تابع للنايم إسبايس هذا, ويعد هذا هو الفرق بينهم

function hello()
{
    echo 'Hello A';
}

class Person
{

    const MALE = 'm';
    const FEMALE = 'f';
    public $name;
    public $gender;
    public $age;

    public static $country;

    public function __construct()
    {
        echo __CLASS__;
    }

    public function setAge($age)
    {
        $this->age = $age;
        return $this; // return this object
    }
    public function setGender($gender)
    {
        $this->gender = $gender;
        return $this;
    }

    public static function setCountry($country)
    {
        self::$country = $country;
        static::$country = $country;
        // يعتبر الكى ورد استاتيك هذا اعم واشمل فهو اولا بيدور عليها فى الكلاس اللى هوا فيها لو مش موجوده بيدور عليها فى الاب
        // طب لو فيه بروبيرتى فى الابن وعاوز اوصل لها وانا ساعتها فى الاب فى هذه الحالة بستخدم الإستاتيك
        self::MALE;                // deffrance between constant and static involke
        // parent::setCountry($country);
    }

    public function name()
    {
        return $this->name;
    }
    public function age()
    {
        return $this->age;
    }




}




?>