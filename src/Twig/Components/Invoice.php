<?php

namespace App\Twig\Components;

use App\Repository\InvoiceRepository;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveListener;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;

#[AsLiveComponent]
class Invoice
{
    use DefaultActionTrait;

    #[LiveProp(writable: true)]
    public array $statuses = [];

    public function __construct(private InvoiceRepository $invoiceRepository)
    {
    }

    #[ExposeInTemplate]
    #[LiveListener('getInvoices')]
    public function getInvoices(): array
    {
        if(empty($this->statuses))
            return $this->invoiceRepository->findAll();

        return $this->invoiceRepository->findByStatus($this->statuses);
    }
}
