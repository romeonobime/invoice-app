<?php

namespace App\Twig\Components;

use App\Entity\Invoice;
use App\Repository\InvoiceRepository;
use App\Repository\InvoiceStatusRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveArg;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\ComponentToolsTrait;

#[AsLiveComponent]
class InvoiceMarkAsPaid extends AbstractController
{
    use DefaultActionTrait;
    use ComponentToolsTrait;

    #[LiveProp]
    public string $invoiceId = "";

    public function __construct(
        private EntityManagerInterface $entityManager,
        private InvoiceRepository $invoiceRepository,
        private InvoiceStatusRepository $invoiceStatusRepository
    ) {
    }

    #[LiveAction]
    public function markAsPaid(EntityManagerInterface $entityManager, #[LiveArg] string $invoiceId)
    {
        /** @var Invoice $invoice */
        $invoice = $this->invoiceRepository->find($invoiceId);
        $invoiceStatusPaid = $this->invoiceStatusRepository->find(1);

        $invoice->setStatus($invoiceStatusPaid);
        $entityManager->persist($invoice);
        $entityManager->flush();
        $this->emit('getInvoice');
    }
}
