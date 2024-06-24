<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Invoice;
use App\Repository\InvoicePaymentTermsRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\LiveComponent\Form\Type\LiveCollectionType;

class InvoiceType extends AbstractType
{

    public function __construct(private InvoicePaymentTermsRepository $invoicePaymentTermsRepository)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $paymentTerms = $this->invoicePaymentTermsRepository->findAll();
        $choices = [];
        $defaultChoice = null;

        foreach($paymentTerms as $choice) {
            $label = "Net " . $choice->getValue() . " " . ($choice->getValue() == 1 ? "Day" : "Days");
            $choices[$label] = $choice;

            if ($label === 'Net 1 Day') {
                $defaultChoice = $choice;
            }
        }

        $builder
            ->add('senderAddress', AddressType::class, [
                'label' => 'Bill From',
            ])
            ->add('client', ClientType::class, [
                'label' => 'Bill To',
            ])
            ->add('paymentDue', DateType::class, [
                'widget' => 'single_text',
                'data' => (new \DateTime()),
            ])
            ->add('paymentTerms', ChoiceType::class, [
                'choices'  => $choices,
                'expanded' => true,
                'multiple' => false,
                'data' => $defaultChoice
            ])
            ->add('description', TextType::class, [
                'label' => 'Project Description',
                'attr' => ['placeholder' => 'e.g. Graphic Design Service'],
            ])
            ->add('items', LiveCollectionType::class, [
                'entry_type' => InvoiceItemType::class,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Invoice::class,
        ]);
    }
}
