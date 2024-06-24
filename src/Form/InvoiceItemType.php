<?php

namespace App\Form;

use App\Entity\InvoiceItem;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InvoiceItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                    'label' => 'Item Name'])
            ->add('quantity', TextType::class, [
                'label' => 'Qty.'])
            ->add('price', TextType::class)
            ->add('total', TextType::class, [
                'disabled' => true,
                'attr' => [
                    'value' => '0.00'
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => InvoiceItem::class]);
    }
}
