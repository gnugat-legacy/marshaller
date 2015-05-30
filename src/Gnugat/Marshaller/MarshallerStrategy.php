<?php

/*
 * This file is part of the gnugat/marshaller package.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\Marshaller;

/**
 * The service that actually converts from one format to another.
 *
 * @api
 */
interface MarshallerStrategy
{
    /**
     * @param mixed  $toMarshal
     * @param string $category
     *
     * @return bool
     *
     * @api
     */
    public function supports($toMarshal, $category = null);

    /**
     * @param mixed $toMarshal
     *
     * @return mixed
     *
     * @api
     */
    public function marshal($toMarshal);
}
