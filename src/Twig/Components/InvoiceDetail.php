<?php

namespace App\Twig\Components;

use App\Entity\Invoice;
use App\Repository\InvoiceRepository;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\UX\LiveComponent\Attribute\LiveListener;
use Symfony\UX\LiveComponent\Attribute\LiveProp;

#[AsLiveComponent]
class InvoiceDetail
{
    use DefaultActionTrait;

    #[LiveProp]
    public string $invoiceId = "";

    public function __construct(
        private InvoiceRepository $invoiceRepository,
        protected RequestStack $requestStack
        )
    {
    }

    #[ExposeInTemplate]
    #[LiveListener('getInvoice')]
    public function getInvoice(): Invoice
    {
        /** @var Invoice $invoice */
        $invoice = $this->invoiceRepository->find(["id" => $this->invoiceId]);

        return $invoice;
    }
}
