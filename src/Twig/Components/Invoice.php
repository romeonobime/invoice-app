<?php

namespace App\Twig\Components;

use App\Repository\InvoiceRepository;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;

#[AsLiveComponent]
class Invoice
{
    use DefaultActionTrait;

    public function __construct(private InvoiceRepository $invoiceRepository)
    {
    }

    #[ExposeInTemplate]
    public function getInvoices(): array
    {
        return $this->invoiceRepository->findAll();
    }
}
