<?php

namespace SprykerCommunity\Zed\DataExchangeBatch\Business\Mapper;

use Generated\Shared\Transfer\DataExchangeBachResourceEntryTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;

interface GlueRequestTransferMapperInterface
{
    /**
     * @param DataExchangeBachResourceEntryTransfer $bachResourceEntryTransfer
     * @return GlueRequestTransfer
     */
    public function mapGlueRequestTransfer(DataExchangeBachResourceEntryTransfer $bachResourceEntryTransfer): GlueRequestTransfer;
}
