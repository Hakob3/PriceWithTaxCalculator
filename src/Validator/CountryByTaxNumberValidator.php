<?php

namespace App\Validator;

use App\Repository\CountryRepository;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class CountryByTaxNumberValidator extends ConstraintValidator
{
    /**
     * @param CountryRepository $countryRepository
     */
    public function __construct(private readonly CountryRepository $countryRepository)
    {
    }

    /**
     * @param mixed $value
     * @param Constraint $constraint
     * @return void
     * @throws NonUniqueResultException
     */
    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$this->countryRepository->findCountryByTaxNumber($value ?? '')) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}