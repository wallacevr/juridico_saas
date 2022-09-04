<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class DocumentId implements Rule
{
    protected $value = null;
    protected $blacklist = [
        '00000000000000',
        '11111111111111',
        '22222222222222',
        '33333333333333',
        '44444444444444',
        '55555555555555',
        '66666666666666',
        '77777777777777',
        '88888888888888',
        '99999999999999'
    ];
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
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $this->value = preg_replace('/[^0-9]/', '', $value); 
    
        return $this->isValidCnpj() || $this->isValidCpf();
    }
    private function isValidCpf()
    {
        // Check the size
        if (strlen($this->value) != 11) {
            return false;
        }

        // Check if it is blacklisted
        if (in_array($this->value, $this->blacklist)) {
            return false;
        }

        // Validate first check digit
        for ($i = 0, $j = 10, $sum = 0; $i < 9; $i++, $j--) {
            $sum += $this->value[$i] * $j;
        }

        $result = $sum % 11;

        if ($this->value[9] != ($result < 2 ? 0 : 11 - $result)) {
            return false;
        }

        // Validate first second digit
        for ($i = 0, $j = 11, $sum = 0; $i < 10; $i++, $j--) {
            $sum += $this->value[$i] * $j;
        }

        $result = $sum % 11;

        return $this->value[10] == ($result < 2 ? 0 : 11 - $result);
    }
    private function isValidCnpj()
    {
        // Check the size
        if (strlen($this->value) != 14) {
            return false;
        }

        // Check if it is blacklisted
        if (in_array($this->value, $this->blacklist)) {
            return false;
        }

        // Validate first check digit
        for ($i = 0, $j = 5, $sum = 0; $i < 12; $i++) {
            $sum += $this->value[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $result = $sum % 11;


        if ($this->value[12] != ($result < 2 ? 0 : 11 - $result)) {
            return false;
        }

        // Validate second check digit
        for ($i = 0, $j = 6, $sum = 0; $i < 13; $i++) {
            $sum += $this->value[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $result = $sum % 11;


        return $this->value[13] == ($result < 2 ? 0 : 11 - $result);
    }
    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('Document number invalid');
    }
}
