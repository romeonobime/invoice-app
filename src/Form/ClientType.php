<?php

namespace App\Form;

use App\Entity\Address;
use App\Entity\Client;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Client\'s Name',
                'attr' => ['placeholder' => 'e.g. John Appleseed']
            ])
            ->add('email', TextType::class, [
                'label' => 'Client\'s Email',
                'attr' => ['placeholder' => 'e.g. email@example.com']
            ])
            ->add('address', AddressType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
