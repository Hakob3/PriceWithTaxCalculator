<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class TaxNumberValidator extends ConstraintValidator
{

    /**
     * @param mixed $value
     * @param Constraint $constraint
     * @return void
     */
    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!preg_match('/^([A-Z]){2}([0-9]){9}$/', $value, $matches)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ taxNumber }}', 'AA000000000')
                ->addViolation();
        }
    }
}