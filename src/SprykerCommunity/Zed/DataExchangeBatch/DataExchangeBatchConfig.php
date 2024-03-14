<?php

declare(strict_types = 1);

namespace SprykerCommunity\Zed\DataExchangeBatch;

use Spryker\Zed\Kernel\AbstractBundleConfig;

class DataExchangeBatchConfig extends AbstractBundleConfig
{
    public const EVENT_QUEUE_NAME = 'event.data_exchange_resource';
}
