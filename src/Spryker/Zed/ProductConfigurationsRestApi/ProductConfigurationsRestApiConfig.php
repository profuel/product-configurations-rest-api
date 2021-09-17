<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ProductConfigurationsRestApi;

use Generated\Shared\Transfer\ItemTransfer;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class ProductConfigurationsRestApiConfig extends AbstractBundleConfig
{
    /**
     * Specification:
     * - Defines fields for comparing items.
     * - Used to compare items during cart item product configuration update.
     *
     * @api
     *
     * @return array<string>
     */
    public function getItemFieldsForIsSameItemComparison(): array
    {
        return [
            ItemTransfer::SKU,
        ];
    }
}
