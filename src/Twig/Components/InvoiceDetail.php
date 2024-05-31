<?php

namespace App\Twig\Components;

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
    public function getInvoice()
    {
        $invoiceId = $this->requestStack->getCurrentRequest()->attributes->get("id");
        return $this->invoiceRepository->find($invoiceId);
    }
}
