<?php

namespace App\Validator;

use Attribute;
use Symfony\Component\Validator\Constraint;

#[Attribute]
class CountryByTaxNumber extends Constraint
{
    /** @var string  */
    public string $message = 'TAX-номер не соответствует ни одной из стран';
}