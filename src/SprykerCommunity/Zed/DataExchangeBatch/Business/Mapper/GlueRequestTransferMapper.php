<?php

namespace SprykerCommunity\Zed\DataExchangeBatch\Business\Mapper;

use Generated\Shared\Transfer\DataExchangeBachResourceEntryTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResourceTransfer;

/**
 * Wolkaround for reusing core code.
 */
class GlueRequestTransferMapper implements GlueRequestTransferMapperInterface
{
    /**
     * @inheritDoc
     */
    public function mapGlueRequestTransfer(DataExchangeBachResourceEntryTransfer $bachResourceEntryTransfer): GlueRequestTransfer
    {
        return (new GlueRequestTransfer())
            ->setResource(new GlueResourceTransfer())

            // find path from resource entry
            ->setPath($bachResourceEntryTransfer->getPath())
            ->setContent($bachResourceEntryTransfer->getContent());
    }
}
