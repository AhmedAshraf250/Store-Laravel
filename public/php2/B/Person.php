<?php


namespace B;

// define('AJYAL', true);
const LARAVEL = 'laravel B';

function hello()
{
    echo 'Hello B';
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
        self::MALE;                // deffrance between constant and static involke
    }




}




?>