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

        if(!empty($batchResponse)){
            $responseTransfer->fromArray([
                "resource" => $batchDetails->getResource(),
                "id" => $batchDetails->getId(),
                "count" => $batchResponse['Count'],
                "open_count" => count($batchResponse['SpyDataExchangeResourceEntries']),
                "creationTime" => $batchResponse['CreatedAt'],
                "finishTime" => $batchResponse['FinishTime'],
                "logs" => [],
            ]);
        }

        return $responseTransfer;
    }

}
