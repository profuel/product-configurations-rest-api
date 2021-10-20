<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerTest\Zed\ProductConfigurationsRestApi\Business;

use Codeception\Test\Unit;
use Generated\Shared\DataBuilder\CartItemRequestBuilder;
use Generated\Shared\DataBuilder\PersistentCartChangeBuilder;
use Generated\Shared\DataBuilder\ProductConfigurationInstanceBuilder;
use Generated\Shared\Transfer\CartItemRequestTransfer;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\PersistentCartChangeTransfer;

/**
 * Auto-generated group annotations
 *
 * @group SprykerTest
 * @group Zed
 * @group ProductConfigurationsRestApi
 * @group Business
 * @group Facade
 * @group ProductConfigurationsRestApiFacadeTest
 * Add your own group annotations below this line
 */
class ProductConfigurationsRestApiFacadeTest extends Unit
{
    /**
     * @var string
     */
    protected const TEST_ITEM_SKU = 'test_sku';

    /**
     * @var \SprykerTest\Zed\ProductConfigurationsRestApi\ProductConfigurationsRestApiBusinessTester
     */
    protected $tester;

    /**
     * @return void
     */
    public function testMapCartItemRequestTransferToPersistentCartChangeTransfer(): void
    {
        // Arrange
        $productConfigurationInstanceTransfer = (new ProductConfigurationInstanceBuilder())->build();
        $cartItemRequestTransfer = (new CartItemRequestBuilder([
            CartItemRequestTransfer::SKU => static::TEST_ITEM_SKU,
            CartItemRequestTransfer::PRODUCT_CONFIGURATION_INSTANCE => $productConfigurationInstanceTransfer->toArray(),
        ]))->build();

        $persistentCartChangeTransfer = (new PersistentCartChangeBuilder())
            ->withItem([ItemTransfer::SKU => static::TEST_ITEM_SKU])
            ->withAnotherItem()
            ->build();

        // Act
        $this->tester->getFacade()->mapCartItemRequestTransferToPersistentCartChangeTransfer(
            $cartItemRequestTransfer,
            $persistentCartChangeTransfer,
        );

        // Assert
        $itemTransfer = $this->extractItemTransferBySku($persistentCartChangeTransfer, static::TEST_ITEM_SKU);
        $this->assertNotNull($itemTransfer);
        $this->assertEquals(
            $itemTransfer->getProductConfigurationInstance()->toArray(),
            $productConfigurationInstanceTransfer->toArray(),
        );
    }

    /**
     * @param \Generated\Shared\Transfer\PersistentCartChangeTransfer $persistentCartChangeTransfer
     * @param string $sku
     *
     * @return \Generated\Shared\Transfer\ItemTransfer|null
     */
    protected function extractItemTransferBySku(PersistentCartChangeTransfer $persistentCartChangeTransfer, string $sku): ?ItemTransfer
    {
        foreach ($persistentCartChangeTransfer->getItems() as $itemTransfer) {
            if ($itemTransfer->getSku() === $sku) {
                return $itemTransfer;
            }
        }

        return null;
    }
}
