<?php

namespace App\Tests\Integration\Twig\Components;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\UX\LiveComponent\Test\InteractsWithLiveComponents;

class InvoiceTest extends KernelTestCase
{
    use InteractsWithLiveComponents;

    public function testGetInvoicesWhenPaidAndDraftAndPending()
    {
        $statuses = ["paid", "pending", "draft"];
        $expectedStatuses = ["paid", "pending", "draft"];
        $actualStatuses = [];

        $invoiceComponent = $this->createLiveComponent(
            'Invoice',
            ["statuses" => $statuses]
        );

        $invoices = $invoiceComponent->component()->getInvoices();

        foreach ($invoices as $invoice) {
            if ( ! in_array($invoice->getStatus()->getName(), $actualStatuses)) {
                $actualStatuses[] = $invoice->getStatus()->getName();
            }
        }

        foreach ($expectedStatuses as $expectedStatus) {
            $this->assertContains($expectedStatus, $actualStatuses, "$expectedStatus status not found");
        }
    }

    public function testGetInvoicesWhenPaidAndDraft()
    {
        $statuses = ["paid", "draft"];
        $expectedStatuses = ["paid", "draft"];
        $actualStatuses = [];

        $invoiceComponent = $this->createLiveComponent(
            'Invoice',
            ["statuses" => $statuses]
        );

        $invoices = $invoiceComponent->component()->getInvoices();

        foreach ($invoices as $invoice) {
            if ( ! in_array($invoice->getStatus()->getName(), $actualStatuses)) {
                $actualStatuses[] = $invoice->getStatus()->getName();
            }
        }

        foreach ($expectedStatuses as $expectedStatus) {
            $this->assertContains($expectedStatus, $actualStatuses, "$expectedStatus status not found");
        }
    }

    public function testGetInvoicesWhenPaidAndPending()
    {
        $statuses = ["paid", "pending"];
        $expectedStatuses = ["paid", "pending"];
        $actualStatuses = [];

        $invoiceComponent = $this->createLiveComponent(
            'Invoice',
            ["statuses" => $statuses]
        );

        $invoices = $invoiceComponent->component()->getInvoices();

        foreach ($invoices as $invoice) {
            if ( ! in_array($invoice->getStatus()->getName(), $actualStatuses)) {
                $actualStatuses[] = $invoice->getStatus()->getName();
            }
        }

        foreach ($expectedStatuses as $expectedStatus) {
            $this->assertContains($expectedStatus, $actualStatuses, "$expectedStatus status not found");
        }
    }

    public function testGetInvoicesWhenPaid()
    {
        $statuses = ["paid"];
        $expectedStatuses = ["paid"];
        $actualStatuses = [];

        $invoiceComponent = $this->createLiveComponent(
            'Invoice',
            ["statuses" => $statuses]
        );

        $invoices = $invoiceComponent->component()->getInvoices();

        foreach ($invoices as $invoice) {
            if ( ! in_array($invoice->getStatus()->getName(), $actualStatuses)) {
                $actualStatuses[] = $invoice->getStatus()->getName();
            }
        }

        foreach ($expectedStatuses as $expectedStatus) {
            $this->assertContains($expectedStatus, $actualStatuses, "$expectedStatus status not found");
        }
    }

    public function testGetInvoicesWhenDraftAndPending()
    {
        $statuses = ["draft", "pending"];
        $expectedStatuses = ["draft", "pending"];
        $actualStatuses = [];

        $invoiceComponent = $this->createLiveComponent(
            'Invoice',
            ["statuses" => $statuses]
        );

        $invoices = $invoiceComponent->component()->getInvoices();

        foreach ($invoices as $invoice) {
            if ( ! in_array($invoice->getStatus()->getName(), $actualStatuses)) {
                $actualStatuses[] = $invoice->getStatus()->getName();
            }
        }

        foreach ($expectedStatuses as $expectedStatus) {
            $this->assertContains($expectedStatus, $actualStatuses, "$expectedStatus status not found");
        }
    }

    public function testGetInvoicesWhenDraft()
    {
        $statuses = ["draft"];
        $expectedStatuses = ["draft"];
        $actualStatuses = [];

        $invoiceComponent = $this->createLiveComponent(
            'Invoice',
            ["statuses" => $statuses]
        );

        $invoices = $invoiceComponent->component()->getInvoices();

        foreach ($invoices as $invoice) {
            if ( ! in_array($invoice->getStatus()->getName(), $actualStatuses)) {
                $actualStatuses[] = $invoice->getStatus()->getName();
            }
        }

        foreach ($expectedStatuses as $expectedStatus) {
            $this->assertContains($expectedStatus, $actualStatuses, "$expectedStatus status not found");
        }
    }

    public function testGetInvoicesWhenPending()
    {
        $statuses = ["pending"];
        $expectedStatuses = ["pending"];
        $actualStatuses = [];

        $invoiceComponent = $this->createLiveComponent(
            'Invoice',
            ["statuses" => $statuses]
        );

        $invoices = $invoiceComponent->component()->getInvoices();

        foreach ($invoices as $invoice) {
            if ( ! in_array($invoice->getStatus()->getName(), $actualStatuses)) {
                $actualStatuses[] = $invoice->getStatus()->getName();
            }
        }

        foreach ($expectedStatuses as $expectedStatus) {
            $this->assertContains($expectedStatus, $actualStatuses, "$expectedStatus status not found");
        }
    }

    public function testGetInvoicesWhenEmpty()
    {
        $statuses = [];
        $expectedStatuses = ["paid", "pending", "draft"];
        $actualStatuses = [];

        $invoiceComponent = $this->createLiveComponent(
            'Invoice',
            ["statuses" => $statuses]
        );

        $invoices = $invoiceComponent->component()->getInvoices();

        foreach ($invoices as $invoice) {
            if ( ! in_array($invoice->getStatus()->getName(), $actualStatuses)) {
                $actualStatuses[] = $invoice->getStatus()->getName();
            }
        }

        foreach ($expectedStatuses as $expectedStatus) {
            $this->assertContains($expectedStatus, $actualStatuses, "$expectedStatus status not found");
        }
    }
}
