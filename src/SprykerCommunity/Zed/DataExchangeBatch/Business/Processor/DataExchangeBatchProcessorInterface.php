<?php

namespace SprykerCommunity\Zed\DataExchangeBatch\Business\Processor;

use Generated\Shared\Transfer\EventEntityTransfer;

interface DataExchangeBatchProcessorInterface
{

    /**
     * @param \Generated\Shared\Transfer\EventEntityTransfer $queueMessageTransfers
     *
     * @return void
     */
    public function process(EventEntityTransfer $queueMessageTransfers): void;
}
