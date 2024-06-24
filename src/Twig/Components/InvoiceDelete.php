<?php

namespace App\Twig\Components;

use App\Entity\Invoice;
use App\Repository\InvoiceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveArg;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[AsLiveComponent]
class InvoiceDelete extends AbstractController
{
    use DefaultActionTrait;

    public function __construct(
        private EntityManagerInterface $entityManager,
        private InvoiceRepository $invoiceRepository
    ) {
    }

    #[LiveAction]
    public function delete(EntityManagerInterface $entityManager, #[LiveArg] string $invoiceId)
    {
        /** @var Invoice $invoice */
        $invoice = $this->invoiceRepository->find($invoiceId);

        $entityManager->remove($invoice);
        $entityManager->flush();

        return $this->redirectToRoute('app_invoice');
    }
}
