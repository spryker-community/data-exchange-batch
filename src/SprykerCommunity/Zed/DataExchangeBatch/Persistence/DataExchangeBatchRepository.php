<?php

namespace SprykerCommunity\Zed\DataExchangeBatch\Persistence;

use Generated\Shared\Transfer\DataExchangeBachResourceEntryTransfer;
use Generated\Shared\Transfer\DataExchangeBatchStatusRequestTransfer;
use Orm\Zed\DataExchangeBatch\Persistence\SpyDataExchangeBatchQuery;
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

    public function fetchBatchStatus(DataExchangeBatchStatusRequestTransfer $batchDetatils): array
    {
        $query = SpyDataExchangeBatchQuery::create()
            ->filterByTaskNumber($batchDetatils->getId())
            ->joinWithSpyDataExchangeResourceEntry()
            ->useSpyDataExchangeResourceEntryQuery()
                ->filterByResource($batchDetatils->getResourceOrFail())
            ->endUse();

        return $this->mapBatchStatus($query->find());
    }

    protected function mapBatchStatus($data)
    {
        $raw_data = $data->toArray();
        return array_pop($raw_data);
    }
}
