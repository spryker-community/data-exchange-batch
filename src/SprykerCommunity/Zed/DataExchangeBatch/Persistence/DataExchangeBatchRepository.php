<?php

namespace SprykerCommunity\Zed\DataExchangeBatch\Persistence;

use Generated\Shared\Transfer\DataExchangeBachResourceEntryTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \SprykerCommunity\Zed\DataExchangeBatch\Persistence\DataExchangeBatchPersistenceFactory getFactory()
 */
class DataExchangeBatchRepository extends AbstractRepository implements DataExchangeBatchRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function fetchResourceEntriesByIds(int $id): DataExchangeBachResourceEntryTransfer
    {
        $data  = $this->getFactory()
            ->createResourceEntryQuery()
            ->filterByIdDataExchangeResourceEntry($id)
            ->findOne();

        return $this->getFactory()->createResourceEntryMapper()->mapResourceEntryTransfer($data);
    }
}
