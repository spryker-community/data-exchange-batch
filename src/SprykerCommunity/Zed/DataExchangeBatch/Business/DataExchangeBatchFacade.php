<?php

declare(strict_types = 1);

namespace SprykerCommunity\Zed\DataExchangeBatch\Business;

use Generated\Shared\Transfer\DataExchangeBatchStatusRequestTransfer;
use Generated\Shared\Transfer\DataExchangeBatchStatusResponseTransfer;
use Generated\Shared\Transfer\EventEntityTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \SprykerCommunity\Zed\DataExchangeBatch\Business\DataExchangeBatchBusinessFactory getFactory()
 */
class DataExchangeBatchFacade extends AbstractFacade implements DataExchangeBatchFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\EventEntityTransfer $queueMessageTransfers
     *
     */
    public function createDataExchangeResource(EventEntityTransfer $queueMessageTransfers): void
    {
         $this->getFactory()->createDataExchangeBachProcessor()->process($queueMessageTransfers);
    }

    public function getStatusOnBatch(DataExchangeBatchStatusRequestTransfer $batchDetails): DataExchangeBatchStatusResponseTransfer
    {
        return $this->getFactory()->createStatusReader()->getStatusOnBatch($batchDetails);
    }

    public function processBatch(string $resource, string $payload): array
    {
        return $this->getFactory()->createBatchProcessor()->process($resource, $payload);
    }
}
