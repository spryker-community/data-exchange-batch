<?php

namespace SprykerCommunity\Glue\DataExchangeBatch\Processor\Batching;

use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use SprykerCommunity\Glue\DataExchangeBatch\DataExchangeBatchConfig;
use SprykerCommunity\Zed\DataExchangeBatch\Business\DataExchangeBatchFacadeInterface;

class BatchProcessor implements BatchProcessorInterface
{
    protected DataExchangeBatchFacadeInterface $dataExchangeBatchFacade;

    public function __construct(DataExchangeBatchFacadeInterface $dataExchangeBatchFacade, DataExchangeBatchConfig $config)
    {
        $this->dataExchangeBatchFacade = $dataExchangeBatchFacade;
        $this->config = $config;
    }

    public function process(GlueRequestTransfer $glueRequestTransfer): GlueResponseTransfer
    {
        $path = $glueRequestTransfer->getPathOrFail();
        $resource = explode('/', substr($path, strrpos($path, sprintf('/%s/', $this->config->getRoutePrefix())) + 1))[1];
        $payload = $glueRequestTransfer->getContent();

        $response = $this->dataExchangeBatchFacade->processBatch($resource, $payload);

        return $this->createResponse($response);
    }

    protected function createResponse(array $response): GlueResponseTransfer
    {
        $responseTransfer = new GlueResponseTransfer();

        $responseTransfer->setContent(json_encode([
            'task_number' => $response['task_number'],
        ]));
        $responseTransfer->setHttpStatus(201);

        return $responseTransfer;
    }

}
