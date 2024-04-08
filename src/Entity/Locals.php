<?php

namespace App\Entity;

use App\Repository\LocalsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LocalsRepository::class)]
class Locals
{
    use DataEntityTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(targetEntity: Exports::class, mappedBy: 'local')]
    private Collection $exports;

    public function __construct()
    {
        $this->exports = new ArrayCollection();
        $this->createdAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Exports>
     */
    public function getExports(): Collection
    {
        return $this->exports;
    }

    public function addExport(Exports $export): static
    {
        if (!$this->exports->contains($export)) {
            $this->exports->add($export);
            $export->setLocal($this);
        }

        return $this;
    }
}
