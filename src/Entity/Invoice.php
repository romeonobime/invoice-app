<?php

namespace App\Entity;

use App\Repository\InvoiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InvoiceRepository::class)]
class Invoice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?string $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $paymentDue = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'invoices')]
    private ?PaymentTerms $paymentTerms = null;

    #[ORM\ManyToOne(inversedBy: 'invoices')]
    private ?Client $client = null;

    #[ORM\ManyToOne(inversedBy: 'invoices')]
    private ?InvoiceStatus $status = null;

    #[ORM\Column]
    private ?float $total = null;

    /**
     * @var Collection<int, Item>
     */
    #[ORM\ManyToMany(targetEntity: Item::class, inversedBy: 'invoices')]
    private Collection $items;

    #[ORM\ManyToOne(inversedBy: 'invoices')]
    private ?Address $senderAddress = null;

    public function __construct()
    {
        $this->items = new ArrayCollection();
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

    public function getPaymentTerms(): ?PaymentTerms
    {
        return $this->paymentTerms;
    }

    public function setPaymentTerms(?PaymentTerms $paymentTerms): static
    {
        $this->paymentTerms = $paymentTerms;

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

    public function getStatus(): ?InvoiceStatus
    {
        return $this->status;
    }

    public function setStatus(?InvoiceStatus $status): static
    {
        $this->status = $status;

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
     * @return Collection<int, Item>
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    public function addItem(Item $item): static
    {
        if (!$this->items->contains($item)) {
            $this->items->add($item);
        }

        return $this;
    }

    public function removeItem(Item $item): static
    {
        $this->items->removeElement($item);

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
}
