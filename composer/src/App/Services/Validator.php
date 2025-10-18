<?php

namespace App\Services;

class Validator
{
    public function isValidContactNumber($contactNumber)
    {
        return preg_match('/^\d{10}$/', $contactNumber);
    }
}
