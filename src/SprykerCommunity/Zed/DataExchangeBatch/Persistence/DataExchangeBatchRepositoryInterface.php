<?php

namespace SprykerCommunity\Zed\DataExchangeBatch\Persistence;

use Generated\Shared\Transfer\DataExchangeBachResourceEntryTransfer;

interface DataExchangeBatchRepositoryInterface
{
    /**
     * @param int $id
     * @return DataExchangeBachResourceEntryTransfer
     */
    public function fetchResourceEntriesByIds(int $id): DataExchangeBachResourceEntryTransfer;
}
