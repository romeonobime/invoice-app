<?php

namespace App\Form;

use App\Entity\Address;
use App\Entity\Invoice;
use App\Entity\InvoiceStatus;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InvoiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('clientName')
            ->add('clientEmail')
            ->add('description')
            ->add('paymentTerms')
            ->add('createdAt', null, [
                'widget' => 'single_text',
            ])
            ->add('paymentDue', null, [
                'widget' => 'single_text',
            ])
            ->add('clientAddress',
            EntityType::class,
            ['class' => Address::class])
            ->add('senderAddress',
            EntityType::class,
            ['class' => Address::class])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Invoice::class,
        ]);
    }
}
