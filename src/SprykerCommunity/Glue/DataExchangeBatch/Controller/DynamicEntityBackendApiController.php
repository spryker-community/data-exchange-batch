<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerCommunity\DataExchangeBatch\Controller;

use Spryker\Glue\Kernel\Backend\Controller\AbstractController;
use Generated\Shared\Transfer\DataExchangeBatchRequestTransfer;
use Generated\Shared\Transfer\DataExchangeBatchResponseTransfer;
use Spryker\Glue\DynamicEntityBackendApi\Builder\Route\RouteBuilder;
use Symfony\Component\Routing\RouteCollection;
/**
 * @method \Spryker\Glue\DynamicEntityBackendApi\ getFactory()
 */
class DynamicEntityBackendApiController extends AbstractController
{
    public function postAction(
        DataExchangeBatchRequestTransfer $dataExchangeBatchRequestTransfer
    ): DataExchangeBatchResponseTransfer {
        // call batch saver

        // /dy.../categories/batch

        // batch-saver

        // - splited payload [[], [], []]
        return $this->getFactory()->createDynamicEntityCreator()->createDynamicEntityCollection($dataExchangeBatchRequestTransfer);
    }
}
