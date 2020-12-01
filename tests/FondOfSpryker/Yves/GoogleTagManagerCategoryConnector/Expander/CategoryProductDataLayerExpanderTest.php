<?php

namespace FondOfSpryker\Yves\GoogleTagManagerCategoryConnector\Expander;

use Codeception\Test\Unit;
use FondOfSpryker\Shared\GoogleTagManagerCategoryConnector\GoogleTagManagerCategoryConstants as ModuleConstants;
use Spryker\Shared\Money\Dependency\Plugin\MoneyPluginInterface;

class CategoryProductDataLayerExpanderTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Shared\Money\Dependency\Plugin\MoneyPluginInterface
     */
    protected $moneyPluginMock;

    /**
     * @var CategoryProductDataLayerExpanderInterface
     */
    protected $categoryProductDataLayerExpander;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->moneyPluginMock = $this->getMockBuilder(MoneyPluginInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->categoryProductDataLayerExpander = new CategoryProductDataLayerExpander($this->moneyPluginMock);
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $twigVariableBag = include codecept_data_dir('twigVariableBag.php');

        $this->moneyPluginMock->expects($this->atLeastOnce())
            ->method('convertIntegerToDecimal')
            ->willReturn(39.9);

        $result = $this->categoryProductDataLayerExpander->expand($twigVariableBag[ModuleConstants::PARAM_PRODUCTS][0]);

        $this->assertArrayHasKey(ModuleConstants::FIELD_PRODUCT_ID_ABSTRACT, $result);
        $this->assertArrayHasKey(ModuleConstants::FIELD_PRODUCT_PRICE, $result);
        $this->assertArrayHasKey(ModuleConstants::FIELD_PRODUCT_NAME, $result);
        $this->assertArrayHasKey(ModuleConstants::FIELD_PRODUCT_SKU, $result);
    }
}
