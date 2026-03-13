<?php

namespace App\Domain\Slideshow;

class Slide
{
    private $id;

    private $image;

    private $title;

    private $description;

    private $link;

    private $slideshow_id;

    public function __construct(
        ?int $id,
        string $image,
        string $title,
        string $description,
        string $link,
        int $slideshow_id
    ) {
        $this->id           = $id;
        $this->image        = $image;
        $this->title        = $title;
        $this->description  = $description;
        $this->link         = $link;
        $this->slideshow_id = $slideshow_id;
    }

    public function id()
    {
        return $this->id;
    }

    public function image()
    {
        return $this->image;
    }

    public function title()
    {
        return $this->title;
    }

    public function description()
    {
        return $this->description;
    }

    public function link()
    {
        return $this->link;
    }

    public function slideshow_id()
    {
        return $this->slideshow_id;
    }
}
