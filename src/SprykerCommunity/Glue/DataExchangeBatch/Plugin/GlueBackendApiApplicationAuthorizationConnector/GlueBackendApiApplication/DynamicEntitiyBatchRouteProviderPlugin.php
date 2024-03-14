<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerCommunity\DataExchangeBatch\Plugin\GlueBackendApiApplicationAuthorizationConnector\GlueBackendApiApplication;

use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\RouteProviderPluginInterface;
use Spryker\Glue\Kernel\Backend\AbstractPlugin;
use Symfony\Component\Routing\RouteCollection;

/**
 * @method \Spryker\Glue\DynamicEntityBackendApi\DynamicEntityBackendApiFactory getFactory()
 * @method \Spryker\Glue\DynamicEntityBackendApi\DynamicEntityBackendApiConfig getConfig()
 */
class DynamicEntitiyBatchRouteProviderPlugin extends AbstractPlugin implements RouteProviderPluginInterface
{
    /**
     * {@inheritDoc}
     * - Adds routes for the provided dynamic entity to the RouteCollection.
     *
     * @api
     * @param \Symfony\Component\Routing\RouteCollection $routeCollection
     *
     * @return \Symfony\Component\Routing\RouteCollection
     */
    public function addRoutes(RouteCollection $routeCollection): RouteCollection
    {
        return $this->getFactory()->createRouteBuilder()->buildRouteCollection($routeCollection);
    }
}
