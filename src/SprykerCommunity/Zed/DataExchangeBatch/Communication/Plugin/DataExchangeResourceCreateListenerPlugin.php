<?php

declare(strict_types=1);

namespace SprykerCommunity\Zed\DataExchangeBatch\Communication\Plugin;

use Spryker\Shared\Kernel\Transfer\TransferInterface;
use Spryker\Zed\Event\Dependency\Plugin\EventHandlerInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \SprykerCommunity\Zed\DataExchangeBatch\Business\DataExchangeBatchFacadeInterface getFacade()
 */
class DataExchangeResourceCreateListenerPlugin extends AbstractPlugin implements EventHandlerInterface
{
    /**
     * @inheritDoc
     */
    public function handle(TransferInterface $transfer, $eventName)
    {
        $this->getFacade()->createDataExchangeResource($transfer);
    }
}
