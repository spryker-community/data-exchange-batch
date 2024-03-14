<?php

declare(strict_types = 1);

namespace SprykerCommunity\Zed\DataExchangeBatch\Business;

use Generated\Shared\Transfer\DataExchangeBatchStatusRequestTransfer;
use Generated\Shared\Transfer\DataExchangeBatchStatusResponseTransfer;
use Generated\Shared\Transfer\EventEntityTransfer;

interface DataExchangeBatchFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\EventEntityTransfer $queueMessageTransfers
     *
     * @return void
     */
    public function createDataExchangeResource(EventEntityTransfer $queueMessageTransfers): void;

    /**
     * @param DataExchangeBatchStatusRequestTransfer $batchDetails
     *
     * @return DataExchangeBatchStatusResponseTransfer
     */
    public function getStatusOnBatch(DataExchangeBatchStatusRequestTransfer $batchDetails): DataExchangeBatchStatusResponseTransfer;
}
