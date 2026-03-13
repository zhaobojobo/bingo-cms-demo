<?php

namespace App\Domain\Article;

/**
 * Class Article
 *
 * @package App\Doman\Article
 */
class Article
{
    /**
     * @var null|int
     */
    private $id;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $publish_time;

    /**
     * @var string
     */
    private $create_time;

    /**
     * @var string
     */
    private $image;

    /**
     * @var int
     */
    private $review;

    /**
     * @var int
     */
    private $hidden;

    /**
     * @var string
     */
    private $template;

    /**
     * @var int
     */
    private $model_id;

    /**
     * @var int
     */
    private $cache;

    /**
     * Article constructor.
     *
     * @param null|int $id
     * @param string   $slug
     * @param string   $type
     * @param string   $publish_time
     * @param string   $create_time
     * @param string   $image
     * @param int      $review
     * @param int      $hidden
     * @param string   $template
     * @param int      $model_id
     * @param int      $cache
     */
    public function __construct(
        ?int $id,
        string $slug,
        string $type,
        string $publish_time,
        string $create_time,
        string $image,
        int $review,
        int $hidden,
        string $template,
        int $model_id,
        int $cache
    ) {
        $this->id           = $id;
        $this->slug         = $slug;
        $this->type         = $type;
        $this->publish_time = $publish_time;
        $this->create_time  = $create_time;
        $this->image        = $image;
        $this->review       = $review;
        $this->hidden       = $hidden;
        $this->template     = $template;
        $this->model_id     = $model_id;
        $this->cache        = $cache;
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
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getPublishTime(): string
    {
        return $this->publish_time;
    }

    /**
     * @return string
     */
    public function getCreateTime(): string
    {
        return $this->create_time;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @return int
     */
    public function getReview(): int
    {
        return $this->review;
    }

    /**
     * @return int
     */
    public function getHidden(): int
    {
        return $this->hidden;
    }

    /**
     * @return string
     */
    public function getTemplate(): string
    {
        return $this->template;
    }

    /**
     * @return int
     */
    public function getModelId(): int
    {
        return $this->model_id;
    }

    /**
     * @return int
     */
    public function getCache(): int
    {
        return $this->cache;
    }
}
