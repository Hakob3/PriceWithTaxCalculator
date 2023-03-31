<?php

namespace App\Entity;

use App\Repository\CountryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CountryRepository::class)]
class Country
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?int $tax = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $taxNumberPrefix = null;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return $this
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getTax(): ?int
    {
        return $this->tax;
    }

    /**
     * @param int|null $tax
     * @return $this
     */
    public function setTax(?int $tax): self
    {
        $this->tax = $tax;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTaxNumberPrefix(): ?string
    {
        return $this->taxNumberPrefix;
    }

    /**
     * @param string|null $taxNumberPrefix
     * @return $this
     */
    public function setTaxNumberPrefix(?string $taxNumberPrefix): self
    {
        $this->taxNumberPrefix = $taxNumberPrefix;

        return $this;
    }
}
