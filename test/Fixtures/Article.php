<?php

namespace Gnugat\Marshaller\Tests\Fixtures;

class Article
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $content;

    /**
     * @param string $title
     * @param string $content
     */
    private function __construct()
    {
    }

    /**
     * @param string $title
     * @param string $content
     *
     * @return Article
     */
    public static function draft($title, $content)
    {
        $article = new self();
        $article->title = $title;
        $article->content = $content;

        return $article;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }
}
