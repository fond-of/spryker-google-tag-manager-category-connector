<?php

namespace FondOfSpryker\Yves\GoogleTagManagerCategoryConnector\Plugin\Variables;

use Codeception\Test\Unit;
use FondOfSpryker\Shared\GoogleTagManagerCategoryConnector\GoogleTagManagerCategoryConstants;
use FondOfSpryker\Yves\GoogleTagManagerCategoryConnector\GoogleTagManagerCategoryConnectorFactory;
use FondOfSpryker\Yves\GoogleTagManagerCategoryConnector\Model\GoogleTagManagerCategoryModelInterface;

class GoogleTagManagerCategorySizePluginTest extends Unit
{
    /**
     * @return void
     */
    public function testAddVariable(): void
    {
        $factoryMock = $this->getMockBuilder(GoogleTagManagerCategoryConnectorFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $googleTagManagerCategoryConnectorModel = $this->getMockBuilder(GoogleTagManagerCategoryModelInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $factoryMock->expects($this->once())
            ->method('createGoogleTagManagerCategoryModel')
            ->willReturn($googleTagManagerCategoryConnectorModel);

        $googleTagManagerCategoryConnectorModel->expects($this->once())
            ->method('getCategorySize')
            ->willReturn([GoogleTagManagerCategoryConstants::FIELD_CATEGORY_SIZE => 3]);

        $googleTagManagerCategoryContentTypePlugin = new GoogleTagManagerCategorySizePlugin();
        $googleTagManagerCategoryContentTypePlugin->setFactory($factoryMock);

        $result = $googleTagManagerCategoryContentTypePlugin->addVariable('pageType', [
        GoogleTagManagerCategoryConstants::PARAM_CATEGORY => [
            GoogleTagManagerCategoryConstants::PARAM_PRODUCTS => [
                'product-1', 'product-2', 'product-3',
            ],
        ]]);

        $this->assertIsArray($result);
        $this->assertArrayHasKey(GoogleTagManagerCategoryConstants::FIELD_CATEGORY_SIZE, $result);
    }
}
