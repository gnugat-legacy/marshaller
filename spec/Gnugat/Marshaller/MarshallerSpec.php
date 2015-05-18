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

class MarshallerSpec extends ObjectBehavior
{
    function it_sort_registered_strategies(
        MarshallerStrategy $marshallerStrategy1,
        MarshallerStrategy $marshallerStrategy2,
        MarshallerStrategy $marshallerStrategy3
    ) {
        $toMarshall = array();

        $marshallerStrategy1->supports($toMarshall, null)->willReturn(true);
        $marshallerStrategy2->supports($toMarshall, null)->willReturn(true);
        $marshallerStrategy3->supports($toMarshall, null)->willReturn(true);

        $this->add($marshallerStrategy1, 10);
        $this->add($marshallerStrategy2, 0);
        $this->add($marshallerStrategy3, 20);

        $marshallerStrategy3->marshal($toMarshall)->shouldBeCalled();

        $this->marshal($toMarshall);
    }

    function it_executes_the_appropriate_strategy(
        MarshallerStrategy $marshallerStrategy1,
        MarshallerStrategy $marshallerStrategy2,
        MarshallerStrategy $marshallerStrategy3
    ) {
        $toMarshall = array();

        $marshallerStrategy1->supports($toMarshall, null)->willReturn(false);
        $marshallerStrategy2->supports($toMarshall, null)->willReturn(false);
        $marshallerStrategy3->supports($toMarshall, null)->willReturn(true);

        $this->add($marshallerStrategy1);
        $this->add($marshallerStrategy2);
        $this->add($marshallerStrategy3);

        $marshallerStrategy3->marshal($toMarshall)->shouldBeCalled();

        $this->marshal($toMarshall);
    }

    function it_fails_when_no_strategy_support_the_given_input()
    {
        $toMarshall = array();

        $notSupportedException = 'Gnugat\Marshaller\NotSupportedException';
        $this->shouldThrow($notSupportedException)->duringMarshal($toMarshall);
    }
}
