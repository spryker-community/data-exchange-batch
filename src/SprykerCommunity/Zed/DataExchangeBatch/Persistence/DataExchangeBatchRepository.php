<?php

namespace SprykerCommunity\Zed\DataExchangeBatch\Persistence;

use Generated\Shared\Transfer\DataExchangeBachResourceEntryTransfer;
use Generated\Shared\Transfer\DataExchangeBatchStatusRequestTransfer;
use Orm\Zed\DataExchangeBatch\Persistence\SpyDataExchangeBachTask;
use Orm\Zed\DataExchangeBatch\Persistence\SpyDataExchangeBachTaskQuery;
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
        $data = $this->getFactory()
            ->createResourceEntryQuery()
            ->filterByIdDataExchangeResourceEntry($id)
            ->findOne();

        return $this->getFactory()->createResourceEntryMapper()->mapResourceEntryTransfer($data);
    }

    public function fetchBatchStatus(DataExchangeBatchStatusRequestTransfer $batchDetatils)
    {
        $query = SpyDataExchangeBachTaskQuery::create()
            ->filterByTaskNumber($batchDetatils->getId())
            ->joinWithSpyDataExchangeResourceEntry()
            ->useSpyDataExchangeResourceEntryQuery()
                ->filterByResource($batchDetatils->getResourceOrFail())
            ->endUse();

        dd($query->find());
    }
}
