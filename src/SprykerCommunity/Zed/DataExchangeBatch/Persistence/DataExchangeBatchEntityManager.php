<?php

namespace SprykerCommunity\Zed\DataExchangeBatch\Persistence;

use Generated\Shared\Transfer\SpyDataExchangeResourceEntryEntityTransfer;
use Orm\Zed\DataExchangeBatch\Persistence\SpyDataExchangeBatch;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \SprykerCommunity\Zed\DataExchangeBatch\Persistence\DataExchangeBatchPersistenceFactory getFactory()
 */
class DataExchangeBatchEntityManager extends AbstractEntityManager implements DataExchangeBatchEntityManagerInterface
{
    /**
     * @inheritDoc
     */
    public function removeResourceEntryById(int $id): void
    {
        $this->getFactory()->createResourceEntryQuery()->filterByIdDataExchangeResourceEntry($id)->delete();
    }

    public function createNewBatch(int $count): array
    {
        $batch = new SpyDataExchangeBatch();
        $batch->setTaskNumber(sha1(uniqid("", true)));
        $batch->setCount($count);
        $batch->save();

        return $batch->toArray();
    }

    public function addItem(array $batch, string $resource, array $content)
    {
        $item = new SpyDataExchangeResourceEntryEntityTransfer();
        $item->setFkDataExchangeBatch($batch['id_data_exchange_batch']);
        $item->setResource($resource);
        $item->setContent(json_encode($content));

        $this->save($item);
    }
}
