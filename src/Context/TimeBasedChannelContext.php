<?php

namespace App\Context;

use App\DataTime\ClockInterface;
use Sylius\Component\Channel\Context\ChannelContextInterface;
use Sylius\Component\Channel\Model\ChannelInterface;
use Sylius\Component\Channel\Repository\ChannelRepositoryInterface;


class TimeBasedChannelContext implements ChannelContextInterface
{
    /** @var ChannelRepositoryInterface */
    private $channelRepostitory;

    /** @var ClockInterface */
    private $clock;

    public function __construct(ChannelRepositoryInterface $channelRepository, ClockInterface $clock)
    {

        $this->channelRepostitory = $channelRepository;
        $this->clock = $clock;
    }

    public function getChannel(): ChannelInterface
    {
        if ($this->clock->isNight()){
            return $this->channelRepostitory->findOneByCode('NIGHT');
        }

        return $this->channelRepostitory->findOneBy([]);

    }

}
