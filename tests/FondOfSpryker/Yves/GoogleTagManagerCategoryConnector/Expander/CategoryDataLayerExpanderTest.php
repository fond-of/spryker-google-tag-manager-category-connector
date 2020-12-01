<?php

namespace FondOfSpryker\Yves\GoogleTagManagerCategoryConnector\Expander;

use Codeception\Test\Unit;
use FondOfSpryker\Shared\GoogleTagManagerCategoryConnector\GoogleTagManagerCategoryConstants as ModuleConstants;

class CategoryDataLayerExpanderTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|CategoryProductDataLayerExpanderInterface
     */
    protected $productExpanderMock;

    /**
     * @var CategoryDataLayerExpanderInterface
     */
    protected $categoryDataLayerExpander;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->productExpanderMock = $this->getMockBuilder(CategoryProductDataLayerExpanderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->categoryDataLayerExpander = new CategoryDataLayerExpander($this->productExpanderMock);
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $result = $this->categoryDataLayerExpander->expand('pageType', [], []);

        $this->assertArrayHasKey(ModuleConstants::FIELD_CONTENT_TYPE, $result);
        $this->assertArrayHasKey(ModuleConstants::FIELD_ID_CATEGORY, $result);
        $this->assertArrayHasKey(ModuleConstants::FIELD_CATEGORY_NAME, $result);
        $this->assertArrayHasKey(ModuleConstants::FIELD_CATEGORY_SIZE, $result);
        $this->assertArrayHasKey(ModuleConstants::FIELD_CATEGORY_PRODUCTS, $result);
    }
}
