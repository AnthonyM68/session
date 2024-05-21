<?php

namespace App\Entity;

use App\Repository\CourseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CourseRepository::class)]
class Course
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(targetEntity: Program::class, mappedBy: 'course')]
    private Collection $programs;

    #[ORM\Column(length: 50)]
    private ?string $nameCourse = null;

    // #[ORM\Column]
    #[ORM\ManyToOne(targetEntity: Category::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null; // Renommé et changé de type



    public function __construct()
    {
        $this->programs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Program>
     */
    public function getPrograms(): Collection
    {
        return $this->programs;
    }

    public function addProgram(Program $program): static
    {
        if (!$this->programs->contains($program)) {
            $this->programs->add($program);
            $program->setCourse($this);
        }

        return $this;
    }

    public function removeProgram(Program $program): static
    {
        if ($this->programs->removeElement($program)) {
            // set the owning side to null (unless already changed)
            if ($program->getCourse() === $this) {
                $program->setCourse(null);
            }
        }

        return $this;
    }

    public function getNameCourse(): ?string
    {
        return $this->nameCourse;
    }

    public function setNameCourse(string $nameCourse): static
    {
        $this->nameCourse = $nameCourse;

        return $this;
    }
    public function getCategory(): ?Category // Renommé et changé de type
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self // Renommé et changé de type
    {
        $this->category = $category;

        return $this;
    }

    public function __toString()
    {
        return $this->nameCourse;
    }
}
