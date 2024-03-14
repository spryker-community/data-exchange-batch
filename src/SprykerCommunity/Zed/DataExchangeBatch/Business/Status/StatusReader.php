<?php

namespace SprykerCommunity\Zed\DataExchangeBatch\Business\Status;

use Generated\Shared\Transfer\DataExchangeBatchStatusRequestTransfer;
use Generated\Shared\Transfer\DataExchangeBatchStatusResponseTransfer;
use SprykerCommunity\Zed\DataExchangeBatch\Persistence\DataExchangeBatchRepositoryInterface;

class StatusReader implements StatusReaderInterface
{

    protected DataExchangeBatchRepositoryInterface $dataExchangeBatchRepository;

    public function __construct(DataExchangeBatchRepositoryInterface $dataExchangeBatchRepository)
    {
        $this->dataExchangeBatchRepository = $dataExchangeBatchRepository;
    }

    public function getStatusOnBatch(DataExchangeBatchStatusRequestTransfer $batchDetails): DataExchangeBatchStatusResponseTransfer
    {
        $responseTransfer = new DataExchangeBatchStatusResponseTransfer();

        $batchResponse = $this->dataExchangeBatchRepository->fetchBatchStatus($batchDetails);

        if($batchResponse){
            $responseTransfer->fromArray(
                [

                ]
            );
        }

        return $responseTransfer;
    }

}
