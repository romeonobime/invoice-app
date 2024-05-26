<?php

namespace App\Twig\Components;

use App\Repository\InvoiceRepository;
use Doctrine\Common\Collections\Criteria;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
class Invoice
{
    use DefaultActionTrait;

    #[LiveProp(writable: true)]
    public array $status = [];

    public function __construct(private InvoiceRepository $invoiceRepository)
    {
    }

    #[ExposeInTemplate]
    public function getInvoices(): array
    {
        if(empty($this->status)) {
            return $this->invoiceRepository->findAll();
        }

        return $this->invoiceRepository->findByStatus($this->status);
    }
}