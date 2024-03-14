<?php

declare(strict_types = 1);

namespace SprykerCommunity\Zed\DataExchangeBatch\Business;

use Spryker\Glue\DynamicEntityBackendApi\DynamicEntityBackendApiDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use SprykerCommunity\Zed\DataExchangeBatch\Business\Mapper\GlueRequestDynamicEntityMapper;
use SprykerCommunity\Zed\DataExchangeBatch\Business\Mapper\GlueRequestTransferMapper;
use SprykerCommunity\Zed\DataExchangeBatch\Business\Mapper\GlueRequestTransferMapperInterface;
use SprykerCommunity\Zed\DataExchangeBatch\Business\Processor\DataExchangeBatchProcessor;
use SprykerCommunity\Zed\DataExchangeBatch\Business\Processor\DataExchangeBatchProcessorInterface;
use SprykerCommunity\Zed\DataExchangeBatch\Business\Status\StatusReader;
use SprykerCommunity\Zed\DataExchangeBatch\Business\Status\StatusReaderInterface;
use SprykerCommunity\Zed\DataExchangeBatch\DataExchangeBatchDependencyProvider;

/**
 * @method \SprykerCommunity\Zed\DataExchangeBatch\Persistence\DataExchangeBatchRepositoryInterface getRepository()
 */
class DataExchangeBatchBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return DataExchangeBatchProcessorInterface
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function createDataExchangeBachProcessor(): DataExchangeBatchProcessorInterface
    {
        return new DataExchangeBatchProcessor(
            $this->getRepository(),
            $this->createGlueRequestTransferMapper(),
            $this->createGlueRequestDynamicEntityMapper(),
            $this->getProvidedDependency(DataExchangeBatchDependencyProvider::FACADE_DYNAMIC_ENTITY)
        );
    }

    /**
     * @return GlueRequestTransferMapperInterface
     */
    public function createGlueRequestTransferMapper(): GlueRequestTransferMapperInterface
    {
        return new GlueRequestTransferMapper();
    }

    /**
     * @return GlueRequestDynamicEntityMapper
     */
    public function createGlueRequestDynamicEntityMapper(): GlueRequestDynamicEntityMapper
    {
        return new GlueRequestDynamicEntityMapper(
            $this->getProvidedDependency(DataExchangeBatchDependencyProvider::SERVICE_UTIL_ENCODING),

        );
    }

    /**
     * @return StatusReaderInterface
     */
    public function createStatusReader(): StatusReaderInterface
    {
        return new StatusReader(
            $this->getRepository()
        );
    }
}
