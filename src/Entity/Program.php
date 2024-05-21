<?php

namespace App\Entity;

use App\Repository\ProgramRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProgramRepository::class)]
class Program
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'programs')]
    private ?Session $session = null;

    #[ORM\ManyToOne(inversedBy: 'programs')]
    private ?Course $course = null;

    #[ORM\Column]
    private ?int $days = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSession(): ?Session
    {
        return $this->session;
    }

    public function setSession(?Session $session): static
    {
        $this->session = $session;

        return $this;
    }

    public function getCourse(): ?Course
    {
        return $this->course;
    }


    public function setCourse(?Course $course): static
    {
        $this->course = $course;

        return $this;
    }
    public function getDays(): ?int
    {
        return $this->days;
    }

    
    public function setDays(int $days): static
    {
        $this->days = $days;

        return $this;
    }
    // public function __toString()
    // {
    //     return $this->id;
    // }
}
