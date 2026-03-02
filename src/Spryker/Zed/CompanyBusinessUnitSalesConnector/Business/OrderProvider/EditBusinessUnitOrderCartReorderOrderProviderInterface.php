<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\CompanyBusinessUnitSalesConnector\Business\OrderProvider;

use Generated\Shared\Transfer\CartReorderRequestTransfer;
use Generated\Shared\Transfer\OrderTransfer;

interface EditBusinessUnitOrderCartReorderOrderProviderInterface
{
    public function findOrder(CartReorderRequestTransfer $cartReorderRequestTransfer): ?OrderTransfer;
}
