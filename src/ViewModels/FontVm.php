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

    public function __construct(string $name, string $author, int $size) {
        $this->name = $name;
        $this->author = $author;
        $this->size = $size;
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

    public static function createFromModel(Font $font): FontVm
    {
        return new FontVm($font->getName(), $font->getAuthor(), $font->getSize());
    }
}