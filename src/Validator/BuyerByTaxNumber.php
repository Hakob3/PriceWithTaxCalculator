<?php

namespace App\Validator;

use Attribute;
use Symfony\Component\Validator\Constraint;

#[Attribute]
class BuyerByTaxNumber extends Constraint
{
    /** @var string  */
    public string $message = 'Пользователь по этому TAX-номеру не найден';
}