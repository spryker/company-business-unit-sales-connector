<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\CompanyBusinessUnitSalesConnector\Business\Checker;

use Generated\Shared\Transfer\CartReorderRequestTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\OrderTransfer;
use Spryker\Zed\CompanyBusinessUnitSalesConnector\Dependency\Facade\CompanyBusinessUnitSalesConnectorToCompanyBusinessUnitFacadeInterface;
use Spryker\Zed\Kernel\PermissionAwareTrait;

class EditCompanyBusinessUnitOrdersPermissionChecker implements EditCompanyBusinessUnitOrdersPermissionCheckerInterface
{
    use PermissionAwareTrait;

    /**
     * @uses \Spryker\Zed\CompanyBusinessUnitSalesConnector\Communication\Plugin\Permission\EditBusinessUnitOrdersPermissionPlugin::KEY
     *
     * @var string
     */
    protected const PERMISSION_KEY = 'EditBusinessUnitOrdersPermissionPlugin';

    public function __construct(
        protected CompanyBusinessUnitSalesConnectorToCompanyBusinessUnitFacadeInterface $companyBusinessUnitFacade
    ) {
    }

    public function isEditCompanyBusinessUnitOrderCartReorderAllowed(
        CartReorderRequestTransfer $cartReorderRequestTransfer
    ): bool {
        if (!$this->isValidCompanyUser($cartReorderRequestTransfer)) {
            return false;
        }

        $companyUserTransfer = $cartReorderRequestTransfer->getCompanyUserTransferOrFail();

        return $this->isEditCompanyBusinessUnitOrderAllowed($companyUserTransfer);
    }

    public function isEditCompanyBusinessUnitOrderAllowed(CompanyUserTransfer $companyUserTransfer): bool
    {
        if (!$this->hasEditOrderPermission($companyUserTransfer)) {
            return false;
        }

        $companyUserTransfer = $this->expandWithCompanyBusinessUnit($companyUserTransfer);

        return (bool)$companyUserTransfer->getCompanyBusinessUnit();
    }

    public function isOrderBelongsToCompanyBusinessUnit(
        ?OrderTransfer $orderTransfer,
        CompanyUserTransfer $companyUserTransfer
    ): bool {
        if (!$orderTransfer || !$orderTransfer->getCompanyBusinessUnitUuid()) {
            return false;
        }

        return $orderTransfer->getCompanyBusinessUnitUuid() === $companyUserTransfer->getCompanyBusinessUnit()->getUuid();
    }

    protected function isValidCompanyUser(CartReorderRequestTransfer $cartReorderRequestTransfer): bool
    {
        $companyUserTransfer = $cartReorderRequestTransfer->getCompanyUserTransfer();

        return (bool)$companyUserTransfer?->getIdCompanyUser();
    }

    protected function hasEditOrderPermission(CompanyUserTransfer $companyUserTransfer): bool
    {
        return $this->can(static::PERMISSION_KEY, $companyUserTransfer->getIdCompanyUserOrFail());
    }

    protected function expandWithCompanyBusinessUnit(CompanyUserTransfer $companyUserTransfer): CompanyUserTransfer
    {
        if (!$companyUserTransfer->getCompanyBusinessUnit() && $companyUserTransfer->getFkCompanyBusinessUnit()) {
            $companyUserTransfer->setCompanyBusinessUnit(
                $this->companyBusinessUnitFacade->findCompanyBusinessUnitById($companyUserTransfer->getFkCompanyBusinessUnitOrFail()),
            );
        }

        return $companyUserTransfer;
    }
}
