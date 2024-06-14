<?php

namespace App\Entity;

use App\Doctrine\GenerateInvoiceId;
use App\Repository\InvoiceRepository;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InvoiceRepository::class)]
class Invoice
{
    #[ORM\Id]
    #[ORM\Column(type: 'string')]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: GenerateInvoiceId::class)]
    private ?string $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $paymentDue = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'invoices')]
    private ?InvoicePaymentTerms $paymentTerms = null;

    #[ORM\ManyToOne(inversedBy: 'invoices')]
    private ?InvoiceStatus $status = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Address $senderAddress = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Address $clientAddress = null;

    #[ORM\Column(nullable: true)]
    private ?float $total = null;

    /**
     * @var Collection<int, InvoiceItem>
     */
    #[ORM\OneToMany(targetEntity: InvoiceItem::class, mappedBy: 'invoice', cascade: ['persist', 'remove'])]
    private Collection $items;

    #[ORM\ManyToOne(inversedBy: 'invoices')]
    private ?Client $client = null;

    public function __construct()
    {
        $this->items = new ArrayCollection();
        $this->createdAt = new DateTimeImmutable("now");
    }

    public function getId(): ?string
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

    public function getPaymentTerms(): ?InvoicePaymentTerms
    {
        return $this->paymentTerms;
    }

    public function setPaymentTerms(?InvoicePaymentTerms $paymentTerms): static
    {
        $this->paymentTerms = $paymentTerms;

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

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(float $total): static
    {
        $this->total = $total;

        return $this;
    }

    /**
     * @return Collection<int, InvoiceItem>
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    public function addItem(InvoiceItem $item): static
    {
        if (!$this->items->contains($item)) {
            $this->items->add($item);
            $item->setInvoice($this);
        }

        return $this;
    }

    public function removeItem(InvoiceItem $item): static
    {
        if ($this->items->removeElement($item)) {
            // set the owning side to null (unless already changed)
            if ($item->getInvoice() === $this) {
                $item->setInvoice(null);
            }
        }

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): static
    {
        $this->client = $client;

        return $this;
    }

    public function calculateTotal()
    {
        foreach ($this->getItems() as $invoiceItem) {
            $this->total += $invoiceItem->getTotal();
        }
    }

    public function calculateTotalForEachItem()
    {
        foreach ($this->getItems() as $invoiceItem) {
            $invoiceItem->calculateTotal();
        }
    }
}
