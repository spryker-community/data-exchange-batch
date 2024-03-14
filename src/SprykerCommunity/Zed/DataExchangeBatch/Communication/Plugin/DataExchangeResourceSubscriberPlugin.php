<?php

declare(strict_types=1);

namespace SprykerCommunity\Zed\DataExchangeBatch\Communication\Plugin;

use Spryker\Zed\Event\Dependency\EventCollectionInterface;
use Spryker\Zed\Event\Dependency\Plugin\EventSubscriberInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use SprykerCommunity\Zed\DataExchangeBatch\DataExchangeBatchConfig;

class DataExchangeResourceSubscriberPlugin extends AbstractPlugin implements EventSubscriberInterface
{

    /**
     * @inheritDoc
     */
    public function getSubscribedEvents(EventCollectionInterface $eventCollection)
    {
        $this->addDataExchangeResourceListener($eventCollection);

        return $eventCollection;
    }

    /**
     * @param EventCollectionInterface $eventCollection
     *
     * @return void
     */
    private function addDataExchangeResourceListener(EventCollectionInterface $eventCollection): void
    {
        $eventCollection->addListenerQueued(
            'data_exchange_resource.create',
            new DataExchangeResourceCreateListenerPlugin(),
            0,
            null,
            DataExchangeBatchConfig::EVENT_QUEUE_NAME
        );
    }
}
