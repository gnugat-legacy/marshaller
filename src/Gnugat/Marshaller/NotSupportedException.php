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

use Exception;

/**
 * Thrown if the $toMarshal given to Marshaller isn't supported by any of its
 * registered strategies.
 *
 * @api
 */
class NotSupportedException extends Exception
{
}
