<?php

namespace SprykerCommunity\Zed\DataExchangeBatch\Persistence;

use Orm\Zed\DataExchangeBatch\Persistence\SpyDataExchangeResourceEntryQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;
use SprykerCommunity\Zed\DataExchangeBatch\Persistence\Propel\Mapper\ResourceEntryMapper;
use SprykerCommunity\Zed\DataExchangeBatch\Persistence\Propel\Mapper\ResourceEntryMapperInterface;

class DataExchangeBatchPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return SpyDataExchangeResourceEntryQuery
     */
    public function createResourceEntryQuery(): SpyDataExchangeResourceEntryQuery
    {
        return new SpyDataExchangeResourceEntryQuery();
    }

    /**
     * @return ResourceEntryMapperInterface
     */
    public function createResourceEntryMapper(): ResourceEntryMapperInterface
    {
        return new ResourceEntryMapper();
    }
}
