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

class CompanyBusinessUnitSalesConnectorToSalesFacadeBridge implements CompanyBusinessUnitSalesConnectorToSalesFacadeInterface
{
    /**
     * @var \Spryker\Zed\Sales\Business\SalesFacadeInterface
     */
    protected $salesFacade;

    /**
     * @param \Spryker\Zed\Sales\Business\SalesFacadeInterface $salesFacade
     */
    public function __construct($salesFacade)
    {
        $this->salesFacade = $salesFacade;
    }

    public function getOrderCollection(OrderCriteriaTransfer $orderCriteriaTransfer): OrderCollectionTransfer
    {
        return $this->salesFacade->getOrderCollection($orderCriteriaTransfer);
    }

    public function getOffsetPaginatedCustomerOrderList(OrderListRequestTransfer $orderListRequestTransfer): OrderListTransfer
    {
        return $this->salesFacade->getOffsetPaginatedCustomerOrderList($orderListRequestTransfer);
    }

    public function getOrder(OrderFilterTransfer $orderFilterTransfer): OrderTransfer
    {
        return $this->salesFacade->getOrder($orderFilterTransfer);
    }
}
