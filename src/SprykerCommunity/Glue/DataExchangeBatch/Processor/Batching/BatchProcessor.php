<?php

namespace SprykerCommunity\Glue\DataExchangeBatch\Processor\Batching;

use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use SprykerCommunity\Zed\DataExchangeBatch\Business\DataExchangeBatchFacadeInterface;

class BatchProcessor implements BatchProcessorInterface
{
    protected DataExchangeBatchFacadeInterface $dataExchangeBatchFacade;

    public function __construct(DataExchangeBatchFacadeInterface $dataExchangeBatchFacade)
    {
        $this->dataExchangeBatchFacade = $dataExchangeBatchFacade;
    }

    public function process(GlueRequestTransfer $glueRequestTransfer): GlueResponseTransfer
    {
        $path = $glueRequestTransfer->getPathOrFail();
        $resource = explode('/', substr($path, strrpos($path, sprintf('/%s/', $this->config->getRoutePrefix())) + 1))[1];
        $payload = $glueRequestTransfer->getContent();

        $response = $this->dataExchangeBatchFacade->processBatch($resource, $payload);

        return $this->createResponse($response);
    }


}
