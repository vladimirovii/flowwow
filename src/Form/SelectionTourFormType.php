<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints;

final class SelectionTourFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $formBuilder, array $options): void
    {
        $formBuilder
            ->add('amount', Type\MoneyType::class, [
                'label' => 'Базовая стоимость',
                'currency' => 'RUB',
            ])
            ->add('birthdate', Type\DateType::class, [
                'label' => 'Дата рождения',
                'constraints' => [
                    new Constraints\Range([
                        'max' => (new \DateTimeImmutable('today')),
                    ]),
                ],
            ])
            ->add('tourdate', Type\DateType::class, [
                'label' => 'Дата старта путешествия',
                'constraints' => [
                    new Constraints\Range([
                        'min' => (new \DateTimeImmutable('today')),
                    ]),
                ],
            ])
            ->add('paymentdate', Type\DateType::class, [
                'required' => false,
                'label' => 'Дата оплаты',
            ])
        ;
    }
}
