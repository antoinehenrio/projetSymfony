<?php

namespace App\Entity;

use App\Repository\ProduitsRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ProduitsRepository::class)
 */
class Produits
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @Gedmo\Slug(fields={"Titre", "DateCreated"}, updatable=false, dateFormat="d/m/Y", unique=true)
     * @ORM\Column(type="string", length=128, unique=true, nullable=true)
     */
    private $slug;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Titre;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Description;

    /**
     * @ORM\Column(type="float")
     */
    private $PriceTTC;

    /**
     * @ORM\Column(type="float")
     */
    private $Poids;

    /**
     * @ORM\Column(type="integer")
     */
    private $Couleur;

    /**
     * @ORM\Column(type="datetime")
     */
    private $DateCreated;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(min="3", max="100", notInRangeMessage="Attention il faut que ça soit entre {{ min }} et {{ max }} et vous avez écrit {{ value }}")
     */
    private $StockQte;

    /**
     * @ORM\Column(type="boolean", options={"default":false})
     */
    private $Actif;

    public function __construct()
    {
        $this->Actif = false;
        $this->DateCreated = new \Datetime();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->Titre;
    }

    public function setTitre(string $Titre): self
    {
        $this->Titre = $Titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getPriceTTC(): ?float
    {
        return $this->PriceTTC;
    }

    public function setPriceTTC(float $PriceTTC): self
    {
        $this->PriceTTC = $PriceTTC;

        return $this;
    }

    public function getPoids(): ?float
    {
        return $this->Poids;
    }

    public function setPoids(float $Poids): self
    {
        $this->Poids = $Poids;

        return $this;
    }

    public function getCouleur(): ?int
    {
        return $this->Couleur;
    }

    public function setCouleur(int $Couleur): self
    {
        $this->Couleur = $Couleur;

        return $this;
    }

    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->DateCreated;
    }

    public function setDateCreated(\DateTimeInterface $DateCreated): self
    {
        $this->DateCreated = $DateCreated;

        return $this;
    }

    public function getStockQte(): ?int
    {
        return $this->StockQte;
    }

    public function setStockQte(int $StockQte): self
    {
        $this->StockQte = $StockQte;

        return $this;
    }

    public function getActif(): ?bool
    {
        return $this->Actif;
    }

    public function setActif(bool $Actif): self
    {
        $this->Actif = $Actif;

        return $this;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     * @return Produits
     */
    public function setSlug(string $slug): Produits
    {
        $this->slug = $slug;
        return $this;
    }
}
