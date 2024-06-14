<?php

namespace App\Form;

use App\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('street', TextType::class, [
                'label' => 'Street Address',
                'attr' => ['placeholder' => 'e.g. 123 Example Str'],
            ])
            ->add('city', TextType::class, [
                'attr' => ['placeholder' => 'e.g. London']
            ])
            ->add('postCode', TextType::class, [
                'attr' => ['placeholder' => 'e.g. 10000']
            ])
            ->add('country', TextType::class, [
                'attr' => ['placeholder' => 'e.g. 123 UK']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
            'label' => false
        ]);
    }
}
