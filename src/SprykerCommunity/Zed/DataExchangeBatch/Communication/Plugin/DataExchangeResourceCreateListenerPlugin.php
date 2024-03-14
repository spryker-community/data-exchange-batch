<?php

declare(strict_types=1);

namespace SprykerCommunity\Zed\DataExchangeBatch\Communication\Plugin;

use Spryker\Zed\Event\Dependency\Plugin\EventBulkHandlerInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \SprykerCommunity\Zed\DataExchangeBatch\Business\DataExchangeBatchFacadeInterface getFacade()
 */
class DataExchangeResourceCreateListenerPlugin extends AbstractPlugin implements EventBulkHandlerInterface
{
    /**
     * @inheritDoc
     */
    public function handleBulk(array $eventEntityTransfers, $eventName)
    {
        $this->getFacade()->createDataExchangeResource($eventEntityTransfers);
    }
}
