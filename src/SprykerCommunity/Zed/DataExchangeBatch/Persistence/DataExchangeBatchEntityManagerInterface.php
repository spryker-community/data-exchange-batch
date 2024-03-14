<?php

namespace SprykerCommunity\Zed\DataExchangeBatch\Persistence;

interface DataExchangeBatchEntityManagerInterface
{
    /**
     * @param int $id
     * @return void
     */
    public function removeResourceEntryById(int $id): void;
}
