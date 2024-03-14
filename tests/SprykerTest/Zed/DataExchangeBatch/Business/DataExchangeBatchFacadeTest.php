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
//    /**
//     * @var string
//     */
//    protected const ERROR_INVALID_DATA_TYPE = 'dynamic_entity.validation.invalid_field_type';
//
//    /**
//     * @var string
//     */
//    protected const ERROR_PROVIDED_FIELD_IS_INVALID = 'dynamic_entity.validation.provided_field_is_invalid';
//
//    /**
//     * @var string
//     */
//    protected const ERROR_MODIFICATION_OF_IMMUTABLE_FIELD_PROHIBITED = 'dynamic_entity.validation.modification_of_immutable_field_prohibited';
//
//    /**
//     * @var string
//     */
//    protected const FIELD_PARENT_ENTITY_ID_CONFIGURATION = 'id_dynamic_entity_configuration';
//
//    /**
//     * @var string
//     */
//    protected const FIELD_CHILD_ENTITY_ID_CONFIGURATION = 'fk_parent_dynamic_entity_configuration';
//
//    /**
//     * @var string
//     */
//    protected const RELATION_TEST_NAME = 'relationTest';
//
//    /**
//     * @var string
//     */
//    protected const FOO_TABLE_ALIAS_2 = 'BAR';
//
//    /**
//     * @var string
//     */
//    protected const FOO_TABLE_NAME = 'spy_foo';
//
//    /**
//     * @var string
//     */
//    protected const BAR_TABLE_NAME = 'spy_bar';
//
//    /**
//     * @var string
//     */
//    protected const BAR_TABLE_ALIAS = 'bar';
//
//    /**
//     * @var string
//     */
//    protected const FOO_CONDITION = 'FOO_CONDITION';
//
//    /**
//     * @var string
//     */
//    protected const IDENTIFIER_TEST_TABLE_ALIAS = 'test_identifiers';
//
//    /**
//     * @var string
//     */
//    protected const IDENTIFIER_TEST_DIFFERENT_VISIBLE_NAME_DEFINITION = '{"identifier":"id_dynamic_entity_configuration","fields":[{"fieldName":"id_dynamic_entity_configuration","fieldVisibleName":"idDynamicEntityConfiguration","isEditable":true,"isCreatable":false,"type":"integer","validation":{"isRequired":false}},{"fieldName":"table_alias","fieldVisibleName":"table_alias","type":"string","isEditable":true,"isCreatable":true,"validation":{"isRequired":false}},{"fieldName":"table_name","fieldVisibleName":"table_name","type":"string","isEditable":true,"isCreatable":true,"validation":{"isRequired":false}},{"fieldName":"is_active","fieldVisibleName":"is_active","isEditable":false,"isCreatable":true,"type":"boolean","validation":{"isRequired":false}},{"fieldName":"definition","fieldVisibleName":"definition","type":"string","isEditable":true,"isCreatable":true,"validation":{"isRequired":false}}]}';
//
//    /**
//     * @var \Spryker\Zed\DynamicEntity\Business\DynamicEntityFacadeInterface
//     */
//    protected $dynamicEntityFacade;


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

//        $this->dataExchangeBatchFacade = $this->tester->getLocator()->getDataExchangeBatch()->facade();
    }

    /**
     * @return void
     */
    public function testProcessMessageFromQueue(): void
    {
        $a = $this->tester->getLocator();
        //Arrange
        $newTask = new SpyDataExchangeBachTask();
        $newTask->setTaskNumber('test_task_1');
        $newTask->save();

        $newResourceEntry = new SpyDataExchangeResourceEntry();
        $newResourceEntry->setSpyDataExchangeBachTask($newTask);
        $newResourceEntry->setContent(file_get_contents(sprintf('%s%s', codecept_data_dir(), 'product_resource.json')));
        $newResourceEntry->save();

        $this->tester->triggerRuntimeEvents();
        $this->tester->assertMessagesConsumedFromEventQueue(DataExchangeBatchConfig::EVENT_DATA_EXCHANGE_RESOURCE_QUEUE);

        //Act

        //Assert
    }
}
