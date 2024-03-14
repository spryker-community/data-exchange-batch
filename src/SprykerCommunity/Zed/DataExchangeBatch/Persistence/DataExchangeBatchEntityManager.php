<?php

namespace SprykerCommunity\Zed\DataExchangeBatch\Persistence;

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
}
