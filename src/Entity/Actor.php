<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ActorRepository")
 */
class Actor extends Person
{

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $birthDate;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Film", mappedBy="actors")
     */
    private $films;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photo='https://www.legumes-transformation.qc.ca/wp-content/uploads/2017/12/profil-vide.jpg';


    public function __construct()
    {
        $this->films = new ArrayCollection();
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(?\DateTimeInterface $birthDate): self
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * @return Collection|Film[]
     */
    public function getFilms(): Collection
    {
        return $this->films;
    }

    public function addFilm(Film $film): self
    {
        if (!$this->films->contains($film)) {
            $this->films[] = $film;
            $film->addActeur($this);
        }

        return $this;
    }

    public function removeFilm(Film $film): self
    {
        if ($this->films->contains($film)) {
            $this->films->removeElement($film);
            $film->removeActeur($this);
        }

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }
}
