<?php

namespace App\Entity;

use App\Repository\FormationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormationRepository::class)]
class Formation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\OneToMany(targetEntity: Session::class, mappedBy: 'formation', orphanRemoval: true)]
    private Collection $sessions;

    #[ORM\Column(length: 50)]
    private ?string $nameFormation = null;

    public function __construct()
    {
        $this->sessions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    /**
     * @return Collection<int, Session>
     */
    public function getSessions(): Collection
    {
        return $this->sessions;
    }

    public function addSession(Session $session): static
    {
        if (!$this->sessions->contains($session)) {
            $this->sessions->add($session);
            $session->setFormation($this);
        }

        return $this;
    }

    public function removeSession(Session $session): static
    {
        if ($this->sessions->removeElement($session)) {
            // set the owning side to null (unless already changed)
            if ($session->getFormation() === $this) {
                $session->setFormation(null);
            }
        }

        return $this;
    }

    public function getNameFormation(): ?string
    {
        return $this->nameFormation;
    }

    public function setNameFormation(string $nameFormation): static
    {
        $this->nameFormation = $nameFormation;

        return $this;
    }
    public function __toString()
    {
        return $this->nameFormation;
    }
}
