<?php

namespace SprykerCommunity\Glue\DataExchangeBatch\Controller;


use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Spryker\Glue\Kernel\Backend\Controller\AbstractController;

/**
 * @method \SprykerCommunity\Glue\DataExchangeBatch\DataExchangeBatchFactory getFactory()
 */
class DataExchangeBatchStatusController extends AbstractController
{

    /**
     * @Glue({
     *      "get": {
     *          "summary": [
     *              "Retrieves the status of a dynamic entity batch by ID."
     *          ]
     *      }
     * })
     *
     * @param string $id
     * @param \Generated\Shared\Transfer\GlueRequestTransfer $glueRequestTransfer
     *
     * @return \Generated\Shared\Transfer\GlueResponseTransfer
     */
    public function getAction(
        string $id,
        GlueRequestTransfer $glueRequestTransfer
    ): GlueResponseTransfer {
        return $this->getFactory()->createStatusReader()->getStatus($glueRequestTransfer->getResourceOrFail()->getId(), $glueRequestTransfer);
    }

}
