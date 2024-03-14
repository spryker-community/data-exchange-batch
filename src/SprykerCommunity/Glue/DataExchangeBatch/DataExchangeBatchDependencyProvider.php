<?php

namespace SprykerCommunity\Glue\DataExchangeBatch;

use Spryker\Glue\Kernel\Backend\AbstractBundleDependencyProvider;
use Spryker\Glue\Kernel\Backend\Container;
use Spryker\Glue\Kernel\Container as GlueContainer;

class DataExchangeBatchDependencyProvider extends AbstractBundleDependencyProvider
{

    public const FACADE_DATA_EXCHANGE_BATCH = 'FACADE_DATA_EXCHANGE_BATCH';

    public const FACADE_DYNAMIC_ENTITY = 'FACADE_DYNAMIC_ENTITY';

    public function provideDependencies(GlueContainer $container)
    {
        $container = parent::provideDependencies($container);
        $this->addDataExchangeBatchFacade($container);
        $this->addDynamicEntityFacade($container);

        return $container;
    }

    public function provideBackendDependencies(Container $container): Container
    {
        $container = parent::provideBackendDependencies($container);
        $this->addDataExchangeBatchFacade($container);
        $this->addDynamicEntityFacade($container);

        return $container;
    }

    /**
     * @param Container $container
     * @return void
     * @throws \Spryker\Service\Container\Exception\FrozenServiceException
     */
    protected function addDataExchangeBatchFacade(Container $container): void
    {
        $container->set(static::FACADE_DATA_EXCHANGE_BATCH, $container->getLocator()->dataExchangeBatch()->facade());
    }

    /**
     * @param Container $container
     * @return void
     * @throws \Spryker\Service\Container\Exception\FrozenServiceException
     */
    protected function addDynamicEntityFacade(Container $container): void
    {
        $container->set(static::FACADE_DYNAMIC_ENTITY, $container->getLocator()->dynamicEntity()->facade());
    }

}
