<?php

namespace App\Validator;

use App\Repository\BuyerRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class BuyerByTaxNumberValidator extends ConstraintValidator
{
    /**
     * @param BuyerRepository $buyerRepository
     */
    public function __construct(private readonly BuyerRepository $buyerRepository)
    {
    }

    /**
     * @param mixed $value
     * @param Constraint $constraint
     * @return void
     */
    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$this->buyerRepository->findOneBy(['taxNumber' => $value])) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}