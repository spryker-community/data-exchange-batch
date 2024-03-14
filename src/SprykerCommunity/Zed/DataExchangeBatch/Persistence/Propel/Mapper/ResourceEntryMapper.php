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
        $resultTransfer = new DataExchangeBachResourceEntryTransfer();
        $resultTransfer->setIdDataExchangeBachResourceEntry($resourceEntry->getIdDataExchangeResourceEntry());
        $resultTransfer->setContent($resourceEntry->getContent());

        return $resultTransfer;
    }
}
