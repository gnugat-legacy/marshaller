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

use Traversable;

/**
 * Converts from one format to another, using the appropriate MarshallerStrategy.
 *
 * @api
 */
class Marshaller
{
    /**
     * @var array
     */
    private $prioritizedStrategies = array();

    /**
     * @var bool
     */
    private $isSorted = false;

    /**
     * @param MarshallerStrategy $strategy
     * @param int                $priority
     *
     * @api
     */
    public function add(MarshallerStrategy $strategy, $priority = 0)
    {
        $this->prioritizedStrategies[$priority][] = $strategy;
        $this->isSorted = false;
    }

    /**
     * @param mixed  $toMarshal
     * @param string $category
     *
     * @return mixed
     *
     * @throws NotSupportedException If the given $toMarshal isn't supported by any registered strategies
     *
     * @api
     */
    public function marshal($toMarshal, $category = null)
    {
        if (!$this->isSorted) {
            $this->sortStrategies();
        }
        if (!is_array($toMarshal) && !$toMarshal instanceof Traversable) {
            return $this->marshalResource($toMarshal, $category);
        }
        $marshalledCollection = array();
        foreach ($toMarshal as $resource) {
            $marshalledCollection[] = $this->marshalResource($resource, $category);
        }

        return $marshalledCollection;
    }

    /**
     * @param mixed  $toMarshal
     * @param string $category
     *
     * @return mixed
     *
     * @throws NotSupportedException If the given $toMarshal isn't supported by any registered strategies
     */
    private function marshalResource($toMarshal, $category = null)
    {
        foreach ($this->prioritizedStrategies as $priority => $marshallerStrategies) {
            foreach ($marshallerStrategies as $marshallerStrategy) {
                if ($marshallerStrategy->supports($toMarshal, $category)) {
                    return $marshallerStrategy->marshal($toMarshal);
                }
            }
        }

        throw new NotSupportedException('The given $toMarshal is not supported by any registered strategies.');
    }

    /**
     * Sort registered strategies according to their priority.
     */
    private function sortStrategies()
    {
        krsort($this->prioritizedStrategies);
        $this->isSorted = true;
    }
}
