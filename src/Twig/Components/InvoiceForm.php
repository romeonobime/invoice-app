<?php

namespace App\Twig\Components;

use App\Entity\Invoice;
use App\Form\InvoiceType;
use App\Repository\InvoiceStatusRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveArg;
use Symfony\UX\LiveComponent\LiveCollectionTrait;
use Symfony\UX\LiveComponent\ComponentToolsTrait;

#[AsLiveComponent]
class InvoiceForm extends AbstractController
{
    use DefaultActionTrait;
    use LiveCollectionTrait;
    use ComponentToolsTrait;

    #[LiveProp]
    public ?Invoice $initialFormData = null;

    public function __construct(
        private InvoiceStatusRepository $invoiceStatusRepository
    )
    {
    }

    protected function instantiateForm(): FormInterface
    {
        return $this->createForm(InvoiceType::class, $this->initialFormData);
    }

    #[LiveAction]
    public function create(EntityManagerInterface $entityManager, #[LiveArg] int $statusId, #[LiveArg] string $paymentDue): void
    {
        $this->submitForm();

        if($statusId == 0) {
            $this->resetForm();
            $this->dispatchBrowserEvent('dialog:close');
            return;
        }

        /** @var InvoiceStatus $invoice */
        $invoiceStatus = $this->invoiceStatusRepository->find($statusId);

        /** @var Invoice $invoice */
        $invoice = $this->getForm()->getData();
        $invoice->setPaymentDue(new DateTimeImmutable($paymentDue));
        $invoice->setStatus($invoiceStatus);
        $invoice->calculateTotalForEachItem();
        $invoice->calculateTotal();

        $entityManager->persist($invoice);
        $entityManager->flush();
        $this->resetForm();
        $this->emit('getInvoices');
    }
}
