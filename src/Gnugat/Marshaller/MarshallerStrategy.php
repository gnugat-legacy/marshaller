<?php

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
