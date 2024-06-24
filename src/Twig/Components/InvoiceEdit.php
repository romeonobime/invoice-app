<?php

namespace App\Twig\Components;

use App\Entity\Invoice;
use App\Form\InvoiceType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\LiveCollectionTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveArg;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\ComponentToolsTrait;

#[AsLiveComponent]
class InvoiceEdit extends AbstractController
{
    use DefaultActionTrait;
    use LiveCollectionTrait;
    use ComponentToolsTrait;

    #[LiveProp]
    public ?Invoice $initialFormData = null;

    protected function instantiateForm(): FormInterface
    {
        return $this->createForm(InvoiceType::class, $this->initialFormData);
    }

    #[LiveAction]
    public function edit(EntityManagerInterface $entityManager, #[LiveArg] string $clicked): void
    {
        $this->submitForm();

        if($clicked == "cancel") {
            return;
        }

        /** @var Invoice $invoice */
        $invoice = $this->getForm()->getData();
        $invoice->calculateTotalForEachItem();
        $invoice->calculateTotal();

        $entityManager->persist($invoice);
        $entityManager->flush();
        $this->resetForm();
        $this->emit("getInvoice");
    }
}
