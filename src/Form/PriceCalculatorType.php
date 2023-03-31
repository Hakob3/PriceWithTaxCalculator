<?php

namespace App\Form;

use App\Entity\Product;
use App\Validator\BuyerByTaxNumber;
use App\Validator\CountryByTaxNumber;
use App\Validator\TaxNumber;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Type;

class PriceCalculatorType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $notNullConstraintMessage = 'Значение не должно быть пустым';

        $builder
            ->add('product', EntityType::class, [
                'label' => 'Товар',
                'placeholder' => 'Выберите товар',
                'required' => false,
                'class' => Product::class,
                'attr' => [
                    'class' => 'form-control',
                ],
                'choice_label' => 'name',
                'constraints' => [
                    new NotNull(message: $notNullConstraintMessage),
                    new Type(Product::class),
                ],
            ])
            ->add('taxNumber', TextType::class, [
                'label' => 'TAX номер покупателя',
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Введите TAX номер',
                ],
                'constraints' => [
                    new NotNull(message: $notNullConstraintMessage),
                    new TaxNumber(),
                    new BuyerByTaxNumber(),
                    new CountryByTaxNumber()
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Рассчитать стоимость',
                'attr' => [
                    'class' => 'form-control btn btn-primary',
                ],
            ]);
    }
}
