<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

// https://www.doctrine-project.org/projects/doctrine-orm/en/2.6/reference/association-mapping.html

/**
 * @ORM\Entity(repositoryClass="App\Repository\MorceauRepository")
 */
class Morceau
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $titre;

    /**
     * @ORM\Column(type="time")
     * @Assert\NotBlank()
     * @Assert\Time()
     */
    private $duree;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * //@Assert\Choice("Electro-Swing", "Rock", "Pop")
     */
    private $genre;

    /**
     * @ORM\ManyToOne(targetEntity="Artiste")
     * @ORM\JoinColumn(name="artiste_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $artiste;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank()
     * @Assert\Date()
     */
    private $date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDuree(): ?\DateTimeInterface
    {
        return $this->duree;
    }

    public function setDuree(\DateTimeInterface $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getArtiste(): ?Artiste
    {
        return $this->artiste;
    }

    //sauvez par Ludo :)
    public function setArtiste(?Artiste $artiste): self
    {
        $this->artiste = $artiste;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }
}
