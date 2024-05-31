<?php

namespace App\Twig\Components;

use App\Entity\Invoice;
use App\Repository\InvoiceRepository;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;
use Symfony\Component\HttpFoundation\RequestStack;

#[AsLiveComponent]
class InvoiceDetail
{
    use DefaultActionTrait;

    public function __construct(
        private InvoiceRepository $invoiceRepository,
        protected RequestStack $requestStack
        )
    {
    }

    #[ExposeInTemplate]
    public function getInvoice(): Invoice
    {
        $invoiceId = $this->requestStack->getCurrentRequest()->attributes->get("id");

        /** @var Invoice $invoice */
        $invoice = $this->invoiceRepository->find($invoiceId);

        return $invoice;
    }
}
