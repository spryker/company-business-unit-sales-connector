<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\CompanyBusinessUnitSalesConnector\Dependency\Facade;

use Generated\Shared\Transfer\OrderCollectionTransfer;
use Generated\Shared\Transfer\OrderCriteriaTransfer;
use Generated\Shared\Transfer\OrderFilterTransfer;
use Generated\Shared\Transfer\OrderListRequestTransfer;
use Generated\Shared\Transfer\OrderListTransfer;
use Generated\Shared\Transfer\OrderTransfer;

interface CompanyBusinessUnitSalesConnectorToSalesFacadeInterface
{
    public function getOrderCollection(OrderCriteriaTransfer $orderCriteriaTransfer): OrderCollectionTransfer;

    public function getOffsetPaginatedCustomerOrderList(OrderListRequestTransfer $orderListRequestTransfer): OrderListTransfer;

    public function getOrder(OrderFilterTransfer $orderFilterTransfer): OrderTransfer;
}
