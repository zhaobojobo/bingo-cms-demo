<?php

namespace App\Domain\ArticleType;

use App\Domain\Data;

/**
 * Class ArticleType
 *
 * @package App\Doman\Permission\ArticleType
 */
class ArticleType extends Data
{
    /**
     * @var null|int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var bool
     */
    private $has_content;

    /**
     * @var bool
     */
    private $has_summary;

    /**
     * @var bool
     */
    private $has_seo;

    /**
     * @var bool
     */
    private $has_slug;

    /**
     * @var bool
     */
    private $has_tags;

    /**
     * @var bool
     */
    private $has_image;

    /**
     * @var bool
     */
    private $image_sensitive;

    /**
     * @var bool
     */
    private $has_top;


    /**
     * ArticleType constructor.
     *
     * @param null|int $id
     * @param string   $name
     */
    public function __construct(
        ?int $id,
        string $name,
        int $has_content,
        int $has_summary,
        int $has_seo,
        int $has_slug,
        int $has_tags,
        int $has_image,
        int $image_sensitive,
        int $has_top
    ) {
        $this->id              = $id;
        $this->name            = strtolower($name);
        $this->has_content     = (bool)$has_content;
        $this->has_summary     = (bool)$has_summary;
        $this->has_seo         = (bool)$has_seo;
        $this->has_slug        = (bool)$has_slug;
        $this->has_tags        = (bool)$has_tags;
        $this->has_image       = (bool)$has_image;
        $this->image_sensitive = (bool)$image_sensitive;
        $this->has_top         = (bool)$has_top;
    }

    public function __toString()
    {
        return $this->name;
    }

    /**
     * @return null|int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return bool
     */
    public function getHasContent(): bool
    {
        return $this->has_content;
    }

    /**
     * @return bool
     */
    public function getHasSummary(): bool
    {
        return $this->has_summary;
    }

    /**
     * @return bool
     */
    public function getHasSeo(): bool
    {
        return $this->has_seo;
    }

    /**
     * @return bool
     */
    public function getHasSlug(): bool
    {
        return $this->has_slug;
    }

    /**
     * @return bool
     */
    public function getHasTags(): bool
    {
        return $this->has_tags;
    }

    /**
     * @return bool
     */
    public function getHasImage(): bool
    {
        return $this->has_image;
    }

    /**
     * @return bool
     */
    public function getImageSensitive(): bool
    {
        return $this->image_sensitive;
    }

    /**
     * @return bool
     */
    public function getHasTop(): bool
    {
        return $this->has_top;
    }

    /**
     * @return array|mixed
     */
    public function jsonSerialize()
    {
        return [
            'id'              => $this->id,
            'name'            => $this->name,
            'has_content'     => $this->has_content,
            'has_summary'     => $this->has_summary,
            'has_seo'         => $this->has_seo,
            'has_slug'        => $this->has_slug,
            'has_tags'        => $this->has_tags,
            'has_image'       => $this->has_image,
            'image_sensitive' => $this->image_sensitive,
        ];
    }
}
