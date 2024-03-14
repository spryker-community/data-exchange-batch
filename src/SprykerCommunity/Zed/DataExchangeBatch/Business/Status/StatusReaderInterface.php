<?php

namespace SprykerCommunity\Zed\DataExchangeBatch\Business\Status;

use Generated\Shared\Transfer\DataExchangeBatchStatusRequestTransfer;
use Generated\Shared\Transfer\DataExchangeBatchStatusResponseTransfer;

interface StatusReaderInterface
{

    public function getStatusOnBatch(DataExchangeBatchStatusRequestTransfer $batchDetails): DataExchangeBatchStatusResponseTransfer;

}
