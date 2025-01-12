<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Messenger;

use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Exception\LogicException;
use Symfony\Component\Messenger\Stamp\HandledStamp;

final class MessengerHelper
{
    /**
     * @see https://github.com/symfony/messenger/blob/3db7dbe4ca40c15afd5ee519193703e97ae4868d/HandleTrait.php
     *
     * @return mixed
     */
    public static function extractResultFromEnvelope(Envelope $envelope)
    {
        /** @var HandledStamp[] $handledStamps */
        $handledStamps = $envelope->all(HandledStamp::class);

        if ($handledStamps === []) {
            throw new LogicException(
                sprintf(
                    'Message of type "%s" was handled zero times. Exactly one handler is expected when using "%s::%s()".',
                    get_class($envelope->getMessage()),
                    self::class,
                    __FUNCTION__,
                ),
            );
        }

        if (count($handledStamps) > 1) {
            $handlers = implode(
                ', ',
                array_map(
                    static fn (HandledStamp $stamp): string => sprintf('"%s"', $stamp->getHandlerName()),
                    $handledStamps,
                ),
            );

            throw new LogicException(
                sprintf(
                    'Message of type "%s" was handled multiple times. Only one handler is expected when using "%s::%s()", got %d: %s.',
                    get_class($envelope->getMessage()),
                    self::class,
                    __FUNCTION__,
                    count($handledStamps),
                    $handlers,
                ),
            );
        }

        return $handledStamps[0]->getResult();
    }
}
