<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerTest\Zed\DataExchangeBatch\Business;

use Codeception\Test\Unit;
use Orm\Zed\DataExchangeBatch\Persistence\SpyDataExchangeBachTask;
use Orm\Zed\DataExchangeBatch\Persistence\SpyDataExchangeResourceEntry;
use SprykerCommunity\Zed\DataExchangeBatch\DataExchangeBatchConfig;
use SprykerTest\Zed\DataExchangeBatch\DataExchangeBatchTester;

/**
 * Auto-generated group annotations
 *
 * @group SprykerTest
 * @group Zed
 * @group DataExchangeBatch
 * @group Business
 * @group Facade
 * @group DataExchangeBatchFacadeTest
 * Add your own group annotations below this line
 */
class DataExchangeBatchFacadeTest extends Unit
{

    /**
     * @var DataExchangeBatchTester
     */
    protected DataExchangeBatchTester $tester;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @return void
     */
    public function testProcessMessageFromQueue(): void
    {
        //Arrange
        $newTask = new SpyDataExchangeBachTask();
        $newTask->setTaskNumber('test_task_1');
        $newTask->save();

        $newResourceEntry = new SpyDataExchangeResourceEntry();
        $newResourceEntry->setSpyDataExchangeBachTask($newTask);
        $newResourceEntry->setContent(file_get_contents(sprintf('%s%s', codecept_data_dir(), 'product_resource.json')));
        $newResourceEntry->save();

        //Act
        $this->tester->triggerRuntimeEvents();

        //Assert
        $this->tester->assertMessagesConsumedFromEventQueue(DataExchangeBatchConfig::EVENT_DATA_EXCHANGE_RESOURCE_QUEUE);

    }
}
