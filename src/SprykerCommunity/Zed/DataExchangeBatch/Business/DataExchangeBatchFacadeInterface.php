<?php

declare(strict_types = 1);

namespace SprykerCommunity\Zed\DataExchangeBatch\Business;

interface DataExchangeBatchFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\EventEntityTransfer[] $queueMessageTransfers
     *
     * @return void
     */
    public function createDataExchangeResource(array $queueMessageTransfers): void;
}
