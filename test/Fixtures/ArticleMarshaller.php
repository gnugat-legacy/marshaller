<?php

/*
 * This file is part of the gnugat/marshaller package.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\Marshaller\Tests\Fixtures;

use Gnugat\Marshaller\MarshallerStrategy;

class ArticleMarshaller implements MarshallerStrategy
{
    /**
     * {@inheritDoc}
     */
    public function supports($toMarshal, $category = null)
    {
        return $toMarshal instanceof Article;
    }

    /**
     * {@inheritDoc}
     */
    public function marshal($toMarshal)
    {
        return array(
            'title' => $toMarshal->getTitle(),
            'content' => $toMarshal->getContent(),
        );
    }
}
