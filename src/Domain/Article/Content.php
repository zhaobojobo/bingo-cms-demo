<?php

namespace App\Domain\Article;

/**
 * Class Content
 *
 * @package App\Doman\Article
 */
class Content
{
    /**
     * @var string
     */
    private $image;

    /**
     * @var string
     */
    private $lang;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $summary;

    /**
     * @var string
     */
    private $content;

    /**
     * @var string
     */
    private $seo_title;

    /**
     * @var string
     */
    private $seo_keywords;

    /**
     * @var string
     */
    private $seo_description;

    /**
     * Content constructor.
     *
     * @param int    $post_id
     * @param string $lang
     * @param string $image
     * @param string $title
     * @param string $summary
     * @param string $content
     * @param string $seo_title
     * @param string $seo_keywords
     * @param string $seo_description
     */
    public function __construct(
        string $lang,
        string $image,
        string $title,
        string $summary,
        string $content,
        string $seo_title,
        string $seo_keywords,
        string $seo_description
    ) {
        $this->post_id = $lang;
        $this->post_id = $image;
        $this->post_id = $title;
        $this->post_id = $summary;
        $this->post_id = $content;
        $this->post_id = $seo_title;
        $this->post_id = $seo_keywords;
        $this->post_id = $seo_description;
    }

    /**
     * @return int|string
     */
    public function getPostId()
    {
        return $this->post_id;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @return string
     */
    public function getLang(): string
    {
        return $this->lang;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getSummary(): string
    {
        return $this->summary;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return string
     */
    public function getSeoTitle(): string
    {
        return $this->seo_title;
    }

    /**
     * @return string
     */
    public function getSeoKeywords(): string
    {
        return $this->seo_keywords;
    }

    /**
     * @return string
     */
    public function getSeoDescription(): string
    {
        return $this->seo_description;
    }
}
