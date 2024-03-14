<?php

namespace SprykerCommunity\Zed\DataExchangeBatch\Business\Batching;

class BatchProcessor
{

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function process(string $resource, string $payload): array
    {
        $decoded_payload = json_decode($payload, true);

        $batch = $this->entityManager->createNewBatch();
        foreach ($decoded_payload as $item) {
            $this->entityManager->addItem($batch, $resource, $item);
        }

        return $batch;
    }

}
