<?php

namespace SprykerCommunity\Glue\DataExchangeBatch\Builder\Route;

use Generated\Shared\Transfer\DynamicEntityConfigurationConditionsTransfer;
use Generated\Shared\Transfer\DynamicEntityConfigurationCriteriaTransfer;
use Generated\Shared\Transfer\DynamicEntityConfigurationTransfer;
use Spryker\Zed\DynamicEntity\Business\DynamicEntityFacadeInterface;
use SprykerCommunity\Glue\DataExchangeBatch\Controller\DataExchangeBatchBatchingController;
use SprykerCommunity\Glue\DataExchangeBatch\Controller\DataExchangeBatchStatusController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use Spryker\Glue\DynamicEntityBackendApi\Builder\Route\RouteBuilder as DynamicEntityBackendApiRouteBuilder;

/**
 * see {@link \Spryker\Glue\DynamicEntityBackendApi\Builder\Route\RouteBuilder}
 * This class is heavily inspired from the RouteBuilder in DynamicEntityBackendApi as it is just adding the status route
 */
class RouteBuilder
{

    protected const STATUS_ROUTE_PATTERN = '/%s/%s/status/{id}';

    protected const STATUS_ROUTE_SUFFIX = 'status';
    protected const BATCH_ROUTE_SUFFIX = 'batch';

    /**
     * @var string
     */
    protected const BATCH_ROUTE_PATTERN = '/%s/%s/batch';

    /**
     * @var string
     */
    protected const ROUTE_NAME_PLACEHOLDER = '%s%s%s';

    /**
     * @var string
     */
    protected const CONTROLLER = '_controller';

    /**
     * @var string
     */
    protected const METHOD = '_method';

    /**
     * @var string
     */
    protected const STRATEGIES_AUTHORIZATION = '_authorization_strategies';

    /**
     * @uses {@link \Spryker\Zed\ApiKeyAuthorizationConnector\Communication\Plugin\Authorization\ApiKeyAuthorizationStrategyPlugin::STRATEGY_NAME}
     *
     * @var string
     */
    protected const STRATEGY_AUTHORIZATION_API_KEY = 'ApiKey';

    /**
     * @var string
     */
    protected const GET_ACTION = 'getAction';

    /**
     * @var string
     */
    protected const POST_ACTION = 'postAction';

    /**
     * @var DynamicEntityFacadeInterface
     */
    protected DynamicEntityFacadeInterface $dynamicEntityFacade;

    /**
     * @var \Spryker\Glue\DynamicEntityBackendApi\DynamicEntityBackendApiConfig
     */
    protected $config;

    /**
     */
    public function __construct(
        DynamicEntityFacadeInterface $dynamicEntityFacade,
        /*DataExchangeBatchConfig*/ $config
    ) {
        $this->dynamicEntityFacade = $dynamicEntityFacade;
        $this->config = $config;
    }

    public function buildRouteCollection(RouteCollection $routeCollection): RouteCollection
    {
        $dynamicEntityConfigurationCollectionTransfer = $this->dynamicEntityFacade->getDynamicEntityConfigurationCollection(
            $this->createDynamicEntityConfigurationCriteriaTransfer(),
        );

        foreach ($dynamicEntityConfigurationCollectionTransfer->getDynamicEntityConfigurations() as $dynamicEntityConfiguration) {
            $routeCollection = $this->addDynamicEntityRouteForStatus($dynamicEntityConfiguration, $routeCollection);
            $routeCollection = $this->addDynamicEntityRouteForBatch($dynamicEntityConfiguration, $routeCollection);
        }

        return $routeCollection;
    }

    /**
     * @param string $action
     * @param string $method
     * @param string $path
     *
     * @return \Symfony\Component\Routing\Route
     */
    protected function buildRoute(string $controller, string $action, string $method, string $path): Route
    {
        $route = new Route($path);
        $route->setDefault(static::CONTROLLER, [$controller, $action])
            ->setDefault(static::METHOD, $method)
            ->setDefault(static::STRATEGIES_AUTHORIZATION, [static::STRATEGY_AUTHORIZATION_API_KEY])
            ->setMethods($method);

        return $route;
    }

    /**
     * @param \Generated\Shared\Transfer\DynamicEntityConfigurationTransfer $dynamicEntityConfigurationTransfer
     * @param \Symfony\Component\Routing\RouteCollection $routeCollection
     *
     * @return \Symfony\Component\Routing\RouteCollection
     */
    protected function addDynamicEntityRouteForStatus(
        DynamicEntityConfigurationTransfer $dynamicEntityConfigurationTransfer,
        RouteCollection $routeCollection
    ): RouteCollection {
        $route = $this->buildRoute(
            DataExchangeBatchStatusController::class,
            static::GET_ACTION,
            Request::METHOD_GET,
            $this->formatPath(static::STATUS_ROUTE_PATTERN, $dynamicEntityConfigurationTransfer->getTableAliasOrFail()),
        );

        $routeCollection->add(
            $this->formatName(static::ROUTE_NAME_PLACEHOLDER, $dynamicEntityConfigurationTransfer->getTableAliasOrFail(), Request::METHOD_GET, static::STATUS_ROUTE_SUFFIX),
            $route,
        );

        return $routeCollection;
    }

    /**
     * @param \Generated\Shared\Transfer\DynamicEntityConfigurationTransfer $dynamicEntityConfigurationTransfer
     * @param \Symfony\Component\Routing\RouteCollection $routeCollection
     *
     * @return \Symfony\Component\Routing\RouteCollection
     */
    protected function addDynamicEntityRouteForBatch(
        DynamicEntityConfigurationTransfer $dynamicEntityConfigurationTransfer,
        RouteCollection $routeCollection
    ): RouteCollection {
        $route = $this->buildRoute(
            DataExchangeBatchBatchingController::class,
            static::POST_ACTION,
            Request::METHOD_POST,
            $this->formatPath(static::BATCH_ROUTE_PATTERN, $dynamicEntityConfigurationTransfer->getTableAliasOrFail()),
        );

        $routeCollection->add(
            $this->formatName(static::ROUTE_NAME_PLACEHOLDER, $dynamicEntityConfigurationTransfer->getTableAliasOrFail(), Request::METHOD_GET, static::BATCH_ROUTE_SUFFIX),
            $route,
        );

        return $routeCollection;
    }

    /**
     * @return \Generated\Shared\Transfer\DynamicEntityConfigurationCriteriaTransfer
     */
    protected function createDynamicEntityConfigurationCriteriaTransfer(): DynamicEntityConfigurationCriteriaTransfer
    {
        $dynamicEntityConfigurationCriteriaTransfer = new DynamicEntityConfigurationCriteriaTransfer();
        $dynamicEntityConfigurationCriteriaTransfer->setDynamicEntityConfigurationConditions(
            (new DynamicEntityConfigurationConditionsTransfer())
                ->setIsActive(true),
        );

        return $dynamicEntityConfigurationCriteriaTransfer;
    }

    protected function formatPath(string $placeholder, string $tableAlias): string
    {
        return sprintf($placeholder, $this->config->getRoutePrefix(), $tableAlias);
    }

    protected function formatName(string $placeholder, string $tableAlias, ?string $method = null, ?string $suffix = null): string
    {
        return sprintf($placeholder, $tableAlias, $method, $suffix);
    }

}
