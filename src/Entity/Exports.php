<?php

namespace App\Entity;

use App\Repository\ExportsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExportsRepository::class)]
class Exports
{
    use DataEntityTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $localName = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $exportAt = null;

    #[ORM\ManyToOne(inversedBy: 'exports')]
    #[ORM\JoinColumn(nullable: false)]
    private ?user $author = null;

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

    public function getLocalName(): ?string
    {
        return $this->localName;
    }

    public function setLocalName(string $localName): static
    {
        $this->localName = $localName;

        return $this;
    }

    public function getExportAt(): ?\DateTimeImmutable
    {
        return $this->exportAt;
    }

    public function setExportAt(\DateTimeImmutable $exportAt): static
    {
        $this->exportAt = $exportAt;

        return $this;
    }

    public function getAuthor(): ?user
    {
        return $this->author;
    }

    public function setAuthor(?user $author): static
    {
        $this->author = $author;

        return $this;
    }
}
