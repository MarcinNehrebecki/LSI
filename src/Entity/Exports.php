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

    #[ORM\Column]
    private ?\DateTime $exportAt = null;

    #[ORM\ManyToOne(inversedBy: 'exports')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $author = null;

    #[ORM\ManyToOne(inversedBy: 'exports')]
    private Locals $local;

    public function __construct()
    {
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


    public function getExportAt(): ?\DateTime
    {
        return $this->exportAt;
    }

    public function setExportAt(\DateTime $exportAt): static
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

    public function getLocal(): locals
    {
        return $this->local;
    }

    public function setLocal(locals $local): static
    {
        $this->local = $local;

        return $this;
    }
}
