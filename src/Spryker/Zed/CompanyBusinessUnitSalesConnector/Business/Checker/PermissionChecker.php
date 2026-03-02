<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\CompanyBusinessUnitSalesConnector\Business\Checker;

use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\OrderTransfer;
use Spryker\Zed\Kernel\PermissionAwareTrait;

class PermissionChecker implements PermissionCheckerInterface
{
    use PermissionAwareTrait;

    public function checkOrderAccessByCustomerBusinessUnit(OrderTransfer $orderTransfer, CustomerTransfer $customerTransfer): bool
    {
        if (!$this->hasCompanyBusinessUnit($orderTransfer, $customerTransfer)) {
            return false;
        }

        if ($orderTransfer->getCompanyBusinessUnitUuid() !== $customerTransfer->getCompanyUserTransfer()->getCompanyBusinessUnit()->getUuid()) {
            return false;
        }

        return $this->can('SeeBusinessUnitOrdersPermissionPlugin', $customerTransfer->getCompanyUserTransfer()->getIdCompanyUser());
    }

    protected function hasCompanyBusinessUnit(OrderTransfer $orderTransfer, CustomerTransfer $customerTransfer): bool
    {
        if (!$orderTransfer->getCompanyBusinessUnitUuid()) {
            return false;
        }

        if (
            !$customerTransfer->getCompanyUserTransfer()
            || !$customerTransfer->getCompanyUserTransfer()->getIdCompanyUser()
            || !$customerTransfer->getCompanyUserTransfer()->getCompanyBusinessUnit()
        ) {
            return false;
        }

        return true;
    }
}
