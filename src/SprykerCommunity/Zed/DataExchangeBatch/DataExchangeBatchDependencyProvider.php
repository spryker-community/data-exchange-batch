<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerCommunity\Zed\DataExchangeBatch;

use Spryker\Glue\DynamicEntityBackendApi\Dependency\Service\DynamicEntityBackendApiToUtilEncodingServiceBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class DataExchangeBatchDependencyProvider extends AbstractBundleDependencyProvider
{
    const FACADE_DYNAMIC_ENTITY = 'FACADE_DYNAMIC_ENTITY';

    const SERVICE_UTIL_ENCODING = 'SERVICE_UTIL_ENCODING';

    /**
     * @inheritDoc
     */
    public function provideBusinessLayerDependencies(Container $container)
    {
        parent::provideBusinessLayerDependencies($container);

        $this->addDynamicEntityFacade($container);
        $this->addUtilEncodingService($container);
    }

    /**
     * @param Container $container
     * @return void
     * @throws \Spryker\Service\Container\Exception\FrozenServiceException
     */
    private function addDynamicEntityFacade(Container $container): void
    {
        $container->set(static::FACADE_DYNAMIC_ENTITY, function (Container $container) {
            return $container->getLocator()->dynamicEntity()->facade();
        });
    }

    /**
     * @param Container $container
     *
     * @return void
     */
    protected function addUtilEncodingService(Container $container): void
    {
        $container->set(static::SERVICE_UTIL_ENCODING, function (Container $container) {
            return new DynamicEntityBackendApiToUtilEncodingServiceBridge(
                $container->getLocator()->utilEncoding()->service(),
            );
        });
    }
}
