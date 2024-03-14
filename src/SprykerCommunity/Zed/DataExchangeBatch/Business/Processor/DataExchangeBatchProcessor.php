<?php

namespace SprykerCommunity\Zed\DataExchangeBatch\Business\Processor;

use Exception;
use Generated\Shared\Transfer\EventEntityTransfer;
use Spryker\Zed\DynamicEntity\Business\DynamicEntityFacadeInterface;
use SprykerCommunity\Zed\DataExchangeBatch\Business\Mapper\GlueRequestDynamicEntityMapper;
use SprykerCommunity\Zed\DataExchangeBatch\Business\Mapper\GlueRequestTransferMapperInterface;
use SprykerCommunity\Zed\DataExchangeBatch\Persistence\DataExchangeBatchEntityManagerInterface;
use SprykerCommunity\Zed\DataExchangeBatch\Persistence\DataExchangeBatchRepositoryInterface;

class DataExchangeBatchProcessor implements DataExchangeBatchProcessorInterface
{
    /**
     * @param DataExchangeBatchRepositoryInterface $batchRepository
     * @param GlueRequestTransferMapperInterface $glueRequestTransferMapper
     * @param GlueRequestDynamicEntityMapper $dynamicEntityMapper
     * @param DynamicEntityFacadeInterface $dynamicEntityFacade
     */
    public function __construct(
        protected DataExchangeBatchRepositoryInterface $batchRepository,
        protected GlueRequestTransferMapperInterface $glueRequestTransferMapper,
        protected GlueRequestDynamicEntityMapper $dynamicEntityMapper,
        protected DynamicEntityFacadeInterface $dynamicEntityFacade,
        protected DataExchangeBatchEntityManagerInterface $batchEntityManager,
    ) {
    }

    /**
     * @param \Generated\Shared\Transfer\EventEntityTransfer $queueMessageTransfers
     *
     * @return void
     */
    public function process(EventEntityTransfer $queueMessageTransfers): void
    {
        //read from db

        $dataExchangeResourceEntry = $this->batchRepository->fetchResourceEntriesByIds($queueMessageTransfers->getId());

        //map by extending glue

        $glueRequestTransfer = $this->glueRequestTransferMapper->mapGlueRequestTransfer($dataExchangeResourceEntry);

        // temp until code will be merged
        $glueRequestTransfer->setPath('/dynamic-entity/product-abstract');
        $dynamicEntityCollectionRequestTransfer = $this->dynamicEntityMapper->mapGlueRequestToDynamicEntityCollectionRequestTransfer($glueRequestTransfer);

        if ($dynamicEntityCollectionRequestTransfer === null) {
            // mark entry as failure
            return;
        }

        //use dynamicEntityFacade to create resource

        try {
            $dynamicEntityCollectionResponseTransfer = $this->dynamicEntityFacade->createDynamicEntityCollection($dynamicEntityCollectionRequestTransfer);
        } catch (Exception $e) {
            // mark entry as failure
            throw $e;
        }

        if ($dynamicEntityCollectionResponseTransfer->getErrors()->count() > 0) {
            // mark entry as failure
            return;
        }

        //remove processed entry

        $this->batchEntityManager->removeResourceEntryById($dataExchangeResourceEntry->getIdDataExchangeBachResourceEntry());

        // add code to change timestamp on main tasks table....
    }
}
