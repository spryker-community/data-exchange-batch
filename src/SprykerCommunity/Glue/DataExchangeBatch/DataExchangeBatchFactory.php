<?php

namespace SprykerCommunity\Glue\DataExchangeBatch;

use Spryker\Glue\Kernel\Backend\AbstractFactory;
use Spryker\Zed\DynamicEntity\Business\DynamicEntityFacadeInterface;
use SprykerCommunity\Glue\DataExchangeBatch\Builder\Route\RouteBuilder;
use SprykerCommunity\Glue\DataExchangeBatch\Processor\Batching\BatchProcessor;
use SprykerCommunity\Glue\DataExchangeBatch\Processor\Status\StatusReader;
use SprykerCommunity\Glue\DataExchangeBatch\Processor\Status\StatusReaderInterface;
use SprykerCommunity\Zed\DataExchangeBatch\Business\DataExchangeBatchFacadeInterface;

/**
 * @method \SprykerCommunity\Glue\DataExchangeBatch\DataExchangeBatchFactory getFactory()
 * @method \SprykerCommunity\Glue\DataExchangeBatch\DataExchangeBatchConfig getConfig()
 */
class DataExchangeBatchFactory extends AbstractFactory
{

    public function createRouteBuilder()
    {
        return new RouteBuilder(
            $this->getDynamicEntityFacade(),
            $this->getConfig()
        );
    }

    public function createBatchProcessor(): BatchProcessor
    {
        return new BatchProcessor(
            $this->getDataExchangeBatchFacade()
        );
    }

    public function createStatusReader(): StatusReaderInterface
    {
        return new StatusReader(
            $this->getDataExchangeBatchFacade(),
            $this->getConfig(),
        );
    }

    protected function getDataExchangeBatchFacade(): DataExchangeBatchFacadeInterface
    {
        return $this->getProvidedDependency(DataExchangeBatchDependencyProvider::FACADE_DATA_EXCHANGE_BATCH);
    }

    protected function getDynamicEntityFacade(): DynamicEntityFacadeInterface
    {
        return $this->getProvidedDependency(DataExchangeBatchDependencyProvider::FACADE_DYNAMIC_ENTITY);
    }

}
