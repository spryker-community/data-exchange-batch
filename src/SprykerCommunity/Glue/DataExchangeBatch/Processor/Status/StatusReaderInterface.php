<?php

namespace SprykerCommunity\Glue\DataExchangeBatch\Processor\Status;

use Generated\Shared\Transfer\GlueRequestTransfer;

interface StatusReaderInterface
{

    public function getStatus(string $id, GlueRequestTransfer $glueRequestTransfer);

}
