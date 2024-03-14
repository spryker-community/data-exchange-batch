<?php

namespace SprykerCommunity\Zed\DataExchangeBatch\Business\Mapper;

use Generated\Shared\Transfer\DynamicEntityCollectionRequestTransfer;
use Generated\Shared\Transfer\DynamicEntityRelationTransfer;
use Generated\Shared\Transfer\DynamicEntityTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Spryker\Glue\DynamicEntityBackendApi\Dependency\Service\DynamicEntityBackendApiToUtilEncodingServiceInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Workaround. Usually this file would be inside dynamic entity package
 *
 * @see \Spryker\Glue\DynamicEntityBackendApi\Mapper\GlueRequestDynamicEntityMapper
 */
class GlueRequestDynamicEntityMapper
{
    public function __construct(protected DynamicEntityBackendApiToUtilEncodingServiceInterface $serviceUtilEncoding)
    {
    }

    /**
     * @param GlueRequestTransfer $glueRequestTransfer
     * @return DynamicEntityCollectionRequestTransfer|null
     */
    public function mapGlueRequestToDynamicEntityCollectionRequestTransfer(
        GlueRequestTransfer $glueRequestTransfer
    ): ?DynamicEntityCollectionRequestTransfer {
        $dynamicEntityCollectionRequestTransfer = $this->createDynamicEntityCollectionRequestTransfer($glueRequestTransfer);

        if ($glueRequestTransfer->getContent() === null) {
            return null;
        }

        $dataCollection = $this->serviceUtilEncoding->decodeJson($glueRequestTransfer->getContent(), true)['data'] ?? null;

        if ($dataCollection === null || $dataCollection === []) {
            return null;
        }

        return $this->mapContentForCollectionRequest($dataCollection, $dynamicEntityCollectionRequestTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\GlueRequestTransfer $glueRequestTransfer
     *
     * @return \Generated\Shared\Transfer\DynamicEntityCollectionRequestTransfer
     */
    protected function createDynamicEntityCollectionRequestTransfer(GlueRequestTransfer $glueRequestTransfer): DynamicEntityCollectionRequestTransfer
    {
        $dynamicEntityCollectionRequestTransfer = (new DynamicEntityCollectionRequestTransfer())
            ->setTableAlias(
                $this->extractTableAlias($glueRequestTransfer->getPathOrFail()),
            );

        $httpMethod = $glueRequestTransfer->getResourceOrFail()->getMethod();
        if ($httpMethod === Request::METHOD_POST || $httpMethod === Request::METHOD_PUT) {
            $dynamicEntityCollectionRequestTransfer
                ->setIsCreatable(true);
        }

        if ($httpMethod === Request::METHOD_PUT) {
            $dynamicEntityCollectionRequestTransfer
                ->setResetNotProvidedFieldValues(true);
        }

        return $dynamicEntityCollectionRequestTransfer;
    }


    /**
     * @param array<mixed> $dataCollection
     * @param \Generated\Shared\Transfer\DynamicEntityCollectionRequestTransfer $dynamicEntityCollectionRequestTransfer
     *
     * @return \Generated\Shared\Transfer\DynamicEntityCollectionRequestTransfer|null
     */
    protected function mapContentForCollectionRequest(
        array $dataCollection,
        DynamicEntityCollectionRequestTransfer $dynamicEntityCollectionRequestTransfer
    ): ?DynamicEntityCollectionRequestTransfer {
        foreach ($dataCollection as $item) {
            if (!is_array($item)) {
                return null;
            }

            $dynamicEntityCollectionRequestTransfer = $this->mapRequestContentToDynamicEntityTransfer($dynamicEntityCollectionRequestTransfer, $item);
        }

        return $dynamicEntityCollectionRequestTransfer;
    }

    protected function mapRequestContentToDynamicEntityTransfer(
        DynamicEntityCollectionRequestTransfer $dynamicEntityCollectionRequestTransfer,
        array $fields
    ): DynamicEntityCollectionRequestTransfer {
        $dynamicEntityTransfer = $this
            ->mapChildRelationsToDynamicEntityTransfer($fields)
            ->setFields($fields);

        $dynamicEntityCollectionRequestTransfer->addDynamicEntity($dynamicEntityTransfer);

        return $dynamicEntityCollectionRequestTransfer;
    }

    protected function mapChildRelationsToDynamicEntityTransfer(
        array $fields,
        ?DynamicEntityTransfer $childDynamicEntityTransfer = null,
        ?DynamicEntityRelationTransfer $childRelation = null,
        array $childRelations = []
    ): DynamicEntityTransfer {
        $dynamicEntityTransfer = new DynamicEntityTransfer();

        foreach ($fields as $fieldName => $fieldValue) {
            if (is_array($fieldValue) === false) {
                continue;
            }

            if (!is_int($fieldName)) {
                $childRelation = $childRelations[$fieldName] ?? (new DynamicEntityRelationTransfer())->setName($fieldName);
                $childRelations[$fieldName] = $childRelation;

                $this->mapChildRelationsToDynamicEntityTransfer($fieldValue, null, $childRelation, $childRelations);

                $dynamicEntityTransfer = $childDynamicEntityTransfer ?? $dynamicEntityTransfer;
                $dynamicEntityTransfer->addChildRelation($childRelation);

                continue;
            }

            $childDynamicEntity = (new DynamicEntityTransfer())->setFields($fieldValue);
            $childRelation->addDynamicEntity($childDynamicEntity);
            $childRelations[$childRelation->getName()] = $childRelation;

            $this->mapChildRelationsToDynamicEntityTransfer($fieldValue, $childDynamicEntity, $childRelation, $childRelations);
        }

        return $dynamicEntityTransfer;
    }

    /**
     * @param string $string
     *
     * @return string|null
     */
    protected function extractTableAlias(string $string): ?string
    {
        $matches = [];

        if (preg_match('/\/([^\/]+)\/([\w-]+)/', $string, $matches)) {
            return $matches[2];
        }

        return null;
    }
}
