<?php

namespace SprykerCommunity\Zed\DataExchangeBatch\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\DataExchangeBachResourceEntryTransfer;
use Orm\Zed\DataExchangeBatch\Persistence\Base\SpyDataExchangeResourceEntry;

interface ResourceEntryMapperInterface
{
    /**
     * @param SpyDataExchangeResourceEntry $resourceEntry
     * @return DataExchangeBachResourceEntryTransfer
     */
    public function mapResourceEntryTransfer(SpyDataExchangeResourceEntry $resourceEntry): DataExchangeBachResourceEntryTransfer;
}
