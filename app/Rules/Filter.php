<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Filter implements Rule
{
    protected $forbidden;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($forbidden)
    {
        $this->forbidden = $forbidden;
        // dd($this->forbidden);
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        /*
        <input name="name" value=">
            - الاتريبيوت : بيمثل إسم الحقل, اى سيكون اسمه دائما "نايم"ك
            - الفاليو : هى القمية التى تم إدخالها فى هذا الحقل, اى القيمة التى كانت فى الريكوست
        */



        // هنا بنحط اللوجيك بتاع الفحص




        // if (strtolower($value) == 'laravel') {
        //     return false;
        // }
        // return true;

        // for Clean Code we can write like this:
        // return !(strtolower($value) === 'php');




        // is_string($this->forbidden) ? $this->forbidden = [$this->forbidden] : null;
        return !in_array(strtolower($value), $this->forbidden);



    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        // return 'The validation error message.';
        return 'this Value is Not Allowed.';
    }
}
