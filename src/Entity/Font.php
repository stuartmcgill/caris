<?php

namespace App\Entity;

use App\ViewModels\FontVm;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FontRepository")
 */
class Font
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $author;

    /**
     * @ORM\Column(type="integer")
     */
    private $size;

    public function __construct(FontVm $fontVm = null) {
        $this->name = $fontVm ? $fontVm->getName() : '';
        $this->author = $fontVm ? $fontVm->getAuthor() : '';
        $this->size = $fontVm ? $fontVm->getSize() : 0;
        $this->id = $fontVm ? $fontVm->getId() : null;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function setSize(int $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function update(FontVm $fontVm)
    {
        $this->name = $fontVm->getName();
        $this->author = $fontVm->getAuthor();
        $this->size = $fontVm->getSize();
    }
}
