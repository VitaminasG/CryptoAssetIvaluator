<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\DTO\Asset\CurrencyEnum;
use App\DTO\Asset\LabelEnum;
use App\Repository\AssetRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AssetRepository::class)]
#[ApiResource]
class Asset
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\ManyToOne(targetEntity: User::class, cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $owner = null;

    #[ORM\Column(type: 'string', enumType: LabelEnum::class)]
    private LabelEnum $label;

    #[ORM\Column(type: 'string', enumType: CurrencyEnum::class)]
    private CurrencyEnum $currency;

    #[ORM\Column]
    #[Assert\GreaterThanOrEqual(
        value: 0,
        message: "Value cannot be negative"
    )]
    private float $value;

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): LabelEnum
    {
        return $this->label;
    }

    public function setLabel(LabelEnum $label): static
    {
        $this->label = $label;

        return $this;
    }

    public function getCurrency(): CurrencyEnum
    {
        return $this->currency;
    }

    public function setCurrency(CurrencyEnum $currency): static
    {
        $this->currency = $currency;

        return $this;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function setValue(float $value): static
    {
        $this->value = $value;

        return $this;
    }
}
