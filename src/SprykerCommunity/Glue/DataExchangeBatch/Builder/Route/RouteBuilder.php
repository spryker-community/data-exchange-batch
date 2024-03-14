<?php

namespace SprykerCommunity\Glue\DataExchangeBatch\Builder\Route;

use Generated\Shared\Transfer\DynamicEntityConfigurationConditionsTransfer;
use Generated\Shared\Transfer\DynamicEntityConfigurationCriteriaTransfer;
use Generated\Shared\Transfer\DynamicEntityConfigurationTransfer;
use Spryker\Zed\DynamicEntity\Business\DynamicEntityFacadeInterface;
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

    protected const STATUS_ROUTE_PATTERN = '%s/%s/{id}';

    protected const STATUS_NAME_PATTERN = '%s%s';

    protected const STATUS_ROUTE_SUFFIX = 'status';

    /**
     * @var string
     */
    protected const ROUTE_PATH_PLACEHOLDER = '/%s/%s';

    /**
     * @var string
     */
    protected const ROUTE_NAME_PLACEHOLDER = '%s%s';

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
            $routeCollection = $this->addDynamicEntityRouteForGet($dynamicEntityConfiguration, $routeCollection);
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
    protected function buildRoute(string $action, string $method, string $path): Route
    {
        $route = new Route($path);
        $route->setDefault(static::CONTROLLER, [DataExchangeBatchStatusController::class, $action])
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
    protected function addDynamicEntityRouteForGet(
        DynamicEntityConfigurationTransfer $dynamicEntityConfigurationTransfer,
        RouteCollection $routeCollection
    ): RouteCollection {
        $route = $this->buildRoute(
            static::GET_ACTION,
            Request::METHOD_GET,
            $this->formatPath(static::ROUTE_PATH_PLACEHOLDER, $dynamicEntityConfigurationTransfer->getTableAliasOrFail()),
        );

        $routeCollection->add(
            $this->formatName(static::ROUTE_NAME_PLACEHOLDER, $dynamicEntityConfigurationTransfer->getTableAliasOrFail(), Request::METHOD_GET),
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
        return sprintf(static::STATUS_ROUTE_PATTERN, sprintf($placeholder, $this->config->getRoutePrefix(), $tableAlias), static::STATUS_ROUTE_SUFFIX);
    }

    protected function formatName(string $placeholder, string $tableAlias, ?string $method = null): string
    {
        return sprintf(static::STATUS_NAME_PATTERN, sprintf($placeholder, $tableAlias, $method), ucfirst(static::STATUS_ROUTE_SUFFIX));
    }


}
