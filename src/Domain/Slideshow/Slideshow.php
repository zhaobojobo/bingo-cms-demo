<?php

namespace App\Domain\Slideshow;

class Slideshow
{
    private $id;

    private $lang;

    private $slug;

    private $name;

    private $review;

    private $create_time;

    private $update_time;

    private $slides;

    public function __construct(
        ?int $id,
        string $lang,
        string $slug,
        string $name,
        int $review,
        string $create_time,
        string $update_time
    ) {
        $this->id          = $id;
        $this->lang        = $lang;
        $this->slug        = $slug;
        $this->name        = $name;
        $this->review      = $review;
        $this->create_time = $create_time;
        $this->update_time = $update_time;
        $this->slides      = [];
    }

    public function id()
    {
        return $this->id;
    }

    public function lang()
    {
        return $this->lang;
    }

    public function slug()
    {
        return $this->slug;
    }

    public function name()
    {
        return $this->name;
    }

    public function review()
    {
        return $this->review;
    }

    public function create_time()
    {
        return $this->create_time;
    }

    public function update_time()
    {
        return $this->update_time;
    }

    public function slides()
    {
        return $this->slides;
    }

    public function setSlides(array $slides)
    {
        $this->slides = $slides;
    }
}
