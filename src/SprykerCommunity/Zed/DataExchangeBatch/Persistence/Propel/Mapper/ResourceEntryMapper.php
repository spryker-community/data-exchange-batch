<?php

namespace SprykerCommunity\Zed\DataExchangeBatch\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\DataExchangeBachResourceEntryTransfer;
use Orm\Zed\DataExchangeBatch\Persistence\Base\SpyDataExchangeResourceEntry;

class ResourceEntryMapper implements ResourceEntryMapperInterface
{
    /**
     * @inheritDoc
     */
    public function mapResourceEntryTransfer(SpyDataExchangeResourceEntry $resourceEntry): DataExchangeBachResourceEntryTransfer
    {
        return (new DataExchangeBachResourceEntryTransfer())
            ->fromArray(
                $resourceEntry->toArray(),
                true
            );
    }
}
