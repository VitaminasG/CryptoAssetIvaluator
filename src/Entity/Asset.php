<?php

namespace App\Entity;

use App\DTO\Asset\Input\CurrencyIdEnum;
use App\DTO\Asset\Input\CurrencyNameEnum;
use App\DTO\Asset\Input\LabelEnum;
use App\Repository\AssetRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AssetRepository::class)]
class Asset
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\ManyToOne(targetEntity: User::class, cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: false)]
    private User $owner;

    #[ORM\Column(type: 'string', enumType: LabelEnum::class)]
    private LabelEnum $label;

    #[ORM\Column(type: 'string', enumType: CurrencyNameEnum::class)]
    private CurrencyNameEnum $currencyName;

    #[ORM\Column(type: 'string', enumType: CurrencyIdEnum::class)]
    private CurrencyIdEnum $currencyId;

    #[ORM\Column]
    #[Assert\GreaterThanOrEqual(
        value: 0,
        message: 'Value cannot be negative'
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

    public function getCurrencyName(): CurrencyNameEnum
    {
        return $this->currencyName;
    }

    public function setCurrencyName(CurrencyNameEnum $currencyName): static
    {
        $this->currencyName = $currencyName;

        return $this;
    }

    public function getCurrencyId(): CurrencyIdEnum
    {
        return $this->currencyId;
    }

    public function setCurrencyId(CurrencyIdEnum $currencyId): static
    {
        $this->currencyId = $currencyId;

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
