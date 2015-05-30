<?php

/*
 * This file is part of the gnugat/marshaller package.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\Marshaller\Tests;

use Gnugat\Marshaller\Marshaller;
use Gnugat\Marshaller\Tests\Fixtures\Article;
use Gnugat\Marshaller\Tests\Fixtures\ArticleMarshaller;
use Gnugat\Marshaller\Tests\Fixtures\PartialArticleMarshaller;
use PHPUnit_Framework_TestCase;

class MarshallerTest extends PHPUnit_Framework_TestCase
{
    const TITLE = 'Nobody expects...';
    const CONTENT = '... The Spanish Inquisition!';

    protected function setUp()
    {
        $this->marshaller = new Marshaller();
        $this->marshaller->add(new ArticleMarshaller());
        $this->marshaller->add(new PartialArticleMarshaller(), 1);
    }

    /**
     * @test
     */
    public function it_converts_article_to_array()
    {
        $article = Article::draft(self::TITLE, self::CONTENT);

        $expected = array(
            'title' => self::TITLE,
            'content' => self::CONTENT,
        );
        self::assertSame($expected, $this->marshaller->marshal($article));
    }

    /**
     * @test
     */
    public function it_converts_collection_of_articles_to_collection_of_array()
    {
        $articles = array(Article::draft(self::TITLE, self::CONTENT));

        $expected = array(
            array(
                'title' => self::TITLE,
                'content' => self::CONTENT,
            ),
        );
        self::assertSame($expected, $this->marshaller->marshalCollection($articles));
    }

    /**
     * @test
     */
    public function it_partially_converts_article_to_array()
    {
        $article = Article::draft(self::TITLE, self::CONTENT);

        $expected = array(
            'title' => self::TITLE,
        );
        self::assertSame($expected, $this->marshaller->marshal($article, 'partial'));
    }
}
