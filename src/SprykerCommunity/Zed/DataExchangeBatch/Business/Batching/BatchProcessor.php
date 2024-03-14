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

        $batch = $this->entityManager->createNewBatch(count($decoded_payload['data']));

        foreach ($decoded_payload['data'] as $item) {
            $this->entityManager->addItem($batch, $resource, $item);
        }

        return $batch;
    }

}
