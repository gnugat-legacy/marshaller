<?php

/*
 * This file is part of the gnugat/marshaller package.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Gnugat\Marshaller;

use Gnugat\Marshaller\MarshallerStrategy;
use PhpSpec\ObjectBehavior;
use stdClass;

class MarshallerSpec extends ObjectBehavior
{
    function it_sorts_registered_strategies(
        MarshallerStrategy $marshallerStrategy1,
        MarshallerStrategy $marshallerStrategy2,
        MarshallerStrategy $marshallerStrategy3
    ) {
        $toMarshal = new stdClass();

        $marshallerStrategy1->supports($toMarshal, null)->willReturn(true);
        $marshallerStrategy2->supports($toMarshal, null)->willReturn(true);
        $marshallerStrategy3->supports($toMarshal, null)->willReturn(true);

        $this->add($marshallerStrategy1, 10);
        $this->add($marshallerStrategy2, 0);
        $this->add($marshallerStrategy3, 20);

        $marshallerStrategy3->marshal($toMarshal)->shouldBeCalled();

        $this->marshal($toMarshal);
    }

    function it_executes_the_appropriate_strategy(
        MarshallerStrategy $marshallerStrategy1,
        MarshallerStrategy $marshallerStrategy2,
        MarshallerStrategy $marshallerStrategy3
    ) {
        $toMarshal = new stdClass();

        $marshallerStrategy1->supports($toMarshal, null)->willReturn(false);
        $marshallerStrategy2->supports($toMarshal, null)->willReturn(false);
        $marshallerStrategy3->supports($toMarshal, null)->willReturn(true);

        $this->add($marshallerStrategy1);
        $this->add($marshallerStrategy2);
        $this->add($marshallerStrategy3);

        $marshallerStrategy3->marshal($toMarshal)->shouldBeCalled();

        $this->marshal($toMarshal);
    }

    function it_can_handle_collections(MarshallerStrategy $marshallerStrategy)
    {
        $toMarshal = new stdClass();
        $collection = array($toMarshal);

        $this->add($marshallerStrategy);

        $marshallerStrategy->supports($toMarshal, null)->willReturn(true);
        $marshallerStrategy->marshal($toMarshal)->shouldBeCalled();

        $this->marshalCollection($collection);
    }

    function it_fails_when_no_strategy_support_the_given_input()
    {
        $toMarshal = new stdClass();

        $notSupportedException = 'Gnugat\Marshaller\NotSupportedException';
        $this->shouldThrow($notSupportedException)->duringMarshal($toMarshal);
    }
}
