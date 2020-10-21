<?php

namespace Modules\User\Http\Requests;

use Illuminate\Contracts\Validation\Rule;

class RulePassword implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param string $attribute
     * @param mixed $value
     * @param $validator
     *
     * @return bool
     */
    public function passes($attribute, $value)
    {
        dd($this);
        if(!empty($value)){
            return is_numeric($value);
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Ccc';
    }
}
