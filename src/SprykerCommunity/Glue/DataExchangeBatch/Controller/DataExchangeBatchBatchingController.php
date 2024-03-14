<?php

namespace SprykerCommunity\Glue\DataExchangeBatch\Controller;

use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Spryker\Glue\Kernel\Backend\Controller\AbstractController;

class DataExchangeBatchBatchingController  extends AbstractController
{

    public function postAction(GlueRequestTransfer $glueRequestTransfer): GlueResponseTransfer
    {
        return $this->getFactory()->createBatchProcessor()->process($glueRequestTransfer);
    }

}
