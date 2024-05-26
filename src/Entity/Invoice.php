<?php

namespace App\Entity;

use App\Repository\InvoiceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InvoiceRepository::class)]
class Invoice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $paymentDue = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $paymentTerms = null;

    #[ORM\Column(length: 255)]
    private ?string $clientName = null;

    #[ORM\Column(length: 255)]
    private ?string $clientEmail = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?InvoiceStatus $status = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Address $senderAddress = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Address $clientAddress = null;

    #[ORM\Column]
    private ?int $total = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getPaymentDue(): ?\DateTimeImmutable
    {
        return $this->paymentDue;
    }

    public function setPaymentDue(\DateTimeImmutable $paymentDue): static
    {
        $this->paymentDue = $paymentDue;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPaymentTerms(): ?int
    {
        return $this->paymentTerms;
    }

    public function setPaymentTerms(int $paymentTerms): static
    {
        $this->paymentTerms = $paymentTerms;

        return $this;
    }

    public function getClientName(): ?string
    {
        return $this->clientName;
    }

    public function setClientName(string $clientName): static
    {
        $this->clientName = $clientName;

        return $this;
    }

    public function getClientEmail(): ?string
    {
        return $this->clientEmail;
    }

    public function setClientEmail(string $clientEmail): static
    {
        $this->clientEmail = $clientEmail;

        return $this;
    }

    public function getStatus(): ?InvoiceStatus
    {
        return $this->status;
    }

    public function setStatus(?InvoiceStatus $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getSenderAddress(): ?Address
    {
        return $this->senderAddress;
    }

    public function setSenderAddress(?Address $senderAddress): static
    {
        $this->senderAddress = $senderAddress;

        return $this;
    }

    public function getClientAddress(): ?Address
    {
        return $this->clientAddress;
    }

    public function setClientAddress(?Address $clientAddress): static
    {
        $this->clientAddress = $clientAddress;

        return $this;
    }

    public function getTotal(): ?int
    {
        return $this->total;
    }

    public function setTotal(int $total): static
    {
        $this->total = $total;

        return $this;
    }
}
