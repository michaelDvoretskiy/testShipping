<?php

namespace Mdvor\TestOneNofw\Controller;

class Validator
{
    function validateForm()
    {
        $errors = [];
        if (!isset($_POST['postcode'])) {
            $errors[] = 'Postal code is required';
        } elseif (strlen($_POST['postcode']) != 5) {
            $errors[] = 'Postal code is invalid';
        }
        if (!isset($_POST['amount'])) {
            $errors[] = 'Order amount is required';
        }
        return $errors;
    }
}