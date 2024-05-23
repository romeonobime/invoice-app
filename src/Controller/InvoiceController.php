<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class InvoiceController extends AbstractController
{
    #[Route('/', name: 'app_invoice')]
    public function index(): Response
    {
        return $this->render('pages/invoice.html.twig');
    }
}