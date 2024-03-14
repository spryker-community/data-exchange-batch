<?php

namespace SprykerCommunity\Glue\DataExchangeBatch;

use Spryker\Glue\Kernel\AbstractBundleConfig;

class DataExchangeBatchConfig extends AbstractBundleConfig
{

    /**
     * @var string
     * @see \Spryker\Glue\DynamicEntityBackendApi\DynamicEntityBackendApiConfig::ROUTE_PREFIX
     */
    protected const ROUTE_PREFIX = 'dynamic-entity';

    /**
     * Specification:
     * - Returns a route prefix value for a dynamic entity.
     *
     * @api
     *
     * @return string
     */
    public function getRoutePrefix(): string
    {
        return static::ROUTE_PREFIX;
    }

}
