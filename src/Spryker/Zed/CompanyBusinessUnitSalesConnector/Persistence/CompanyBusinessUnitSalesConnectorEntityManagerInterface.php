<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\CompanyBusinessUnitSalesConnector\Persistence;

interface CompanyBusinessUnitSalesConnectorEntityManagerInterface
{
    public function updateOrderCompanyBusinessUnitUuid(int $idSalesOrder, string $companyBusinessUnitUuid): void;
}
