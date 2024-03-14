<?php

namespace SprykerCommunity\Zed\DataExchangeBatch\Business\Processor;

use Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface;

class Processor
{
    public function __construct(
        protected EventBehaviorFacadeInterface $eventBehaviorFacade,
    ) {
    }

    /**
     * @param \Generated\Shared\Transfer\EventEntityTransfer[] $queueMessageTransfers
     *
     * @return void
     */
    public function process(array $queueMessageTransfers)
    {
        //get ids

        $ids = $this->eventBehaviorFacade->getEventTransferIds($queueMessageTransfers);

        //read from db

        //map by extending glue

        //use dynamicentityFacade to create resource

        //remove processed entry
    }
}
