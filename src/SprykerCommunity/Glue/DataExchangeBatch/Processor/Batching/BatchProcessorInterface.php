<?php

namespace SprykerCommunity\Glue\DataExchangeBatch\Processor\Batching;

use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;

interface BatchProcessorInterface
{

    public function process(GlueRequestTransfer $glueRequestTransfer): GlueResponseTransfer;

}
