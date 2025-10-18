<?php

namespace Models;

use App\Services\Validator;
use Exception;

class ContactValidator
{
    private $contactNumber;
    private $validator;

    // Constructor Injection
    public function __construct($contactNumber, Validator $validator)
    {
        $this->validator = $validator;
        $this->setContactNumber($contactNumber);
    }

    public function getContactNumber()
    {
        return $this->contactNumber;
    }

    public function setContactNumber($contactNumber)
    {
        if (!$this->validator->isValidContactNumber($contactNumber)) {
            throw new Exception("Invalid Contact Number. Please enter a 10-digit number.");
        }
        $this->contactNumber = $contactNumber;
    }
}
