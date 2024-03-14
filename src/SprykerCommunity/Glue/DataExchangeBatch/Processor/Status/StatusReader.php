<?php

namespace SprykerCommunity\Glue\DataExchangeBatch\Processor\Status;

use Generated\Shared\Transfer\DataExchangeBatchStatusRequestTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use SprykerCommunity\Glue\DataExchangeBatch\DataExchangeBatchConfig;
use SprykerCommunity\Zed\DataExchangeBatch\Business\DataExchangeBatchFacadeInterface;

class StatusReader implements StatusReaderInterface
{

    protected DataExchangeBatchFacadeInterface $dataExchangeBatchFacade;

    protected DataExchangeBatchConfig $config;

    public function __construct(DataExchangeBatchFacadeInterface $dataExchangeBatchFacade, $config)
    {
        $this->dataExchangeBatchFacade = $dataExchangeBatchFacade;
        $this->config = $config;
    }

    public function getStatus(string $id, GlueRequestTransfer $glueRequestTransfer)
    {
        // parse the current resource
        $path = $glueRequestTransfer->getPathOrFail();
        $resource = explode('/', substr($path, strrpos($path, sprintf('/%s/', $this->config->getRoutePrefix())) + 1))[1];

        // send request to facade to fetch the status of current id and resource
        $statusRequestTransfer = new DataExchangeBatchStatusRequestTransfer();
        $statusRequestTransfer->setId($id);
        $statusRequestTransfer->setResource($resource);

        $statusResponse = $this->dataExchangeBatchFacade->getStatusOnBatch($statusRequestTransfer);

        dd($statusResponse);

        // send response based on facade response
        // - 20x: data found and we can forward the status
        //  - 200: batching done
        //  - 202: batching in progress
        // - 404: ticket not found on this resource
    }

}
