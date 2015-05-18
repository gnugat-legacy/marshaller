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
 * Converts from one format to another, using the appropriate MarshallerStrategy.
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
     */
    public function marshal($toMarshal, $category = null)
    {
        if (!$this->isSorted) {
            $this->sortStrategies();
        }
        foreach ($this->prioritizedStrategies as $priority => $strategies) {
            foreach ($strategies as $strategy) {
                if ($strategy->supports($toMarshal, $category)) {
                    return $strategy->marshal($toMarshal);
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
