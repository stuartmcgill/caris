<?php

namespace App\ViewModels;

use App\Entity\Font;

class FontVm
{
    /** @var string  */
    protected $name;

    /** @var string  */
    protected $author;

    /** @var int  */
    protected $size;

    /** @var int  */
    protected $id;

    public function __construct(string $name, string $author, $size, $id = null) {
        $this->name = $name;
        $this->author = $author;
        $this->size = $size;
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function setAuthor($author)
    {
        $this->author = $author;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function setSize($size)
    {
        $this->size = $size;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public static function createFromModel(Font $font): FontVm
    {
        return new FontVm($font->getName(), $font->getAuthor(), $font->getSize(), $font->getId());
    }
}