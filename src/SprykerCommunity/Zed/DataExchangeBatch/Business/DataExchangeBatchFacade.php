<?php

declare(strict_types = 1);

namespace SprykerCommunity\Zed\DataExchangeBatch\Business;

use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \SprykerCommunity\Zed\DataExchangeBatch\Business\DataExchangeBatchBusinessFactory getFactory()
 */
class DataExchangeBatchFacade extends AbstractFacade implements DataExchangeBatchFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\EventEntityTransfer[] $queueMessageTransfers
     *
     */
    public function createDataExchangeResource(array $queueMessageTransfers): void
    {
        // return $this->getFactory()->createExampleQueueMessageProcessor()->processMessages($queueMessageTransfers);
    }
}
