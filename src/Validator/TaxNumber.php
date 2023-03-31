<?php

namespace App\Validator;

use Attribute;
use Symfony\Component\Validator\Constraint;

#[Attribute]
class TaxNumber extends Constraint
{
    /** @var string  */
    public string $message = 'Введите допустимый TAX-номер ( {{ taxNumber }} )';
}