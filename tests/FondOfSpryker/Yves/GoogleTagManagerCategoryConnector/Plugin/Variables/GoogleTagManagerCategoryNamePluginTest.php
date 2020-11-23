<?php

namespace FondOfSpryker\Yves\GoogleTagManagerCategoryConnector\Plugin\Variables;

use Codeception\Test\Unit;
use FondOfSpryker\Shared\GoogleTagManagerCategoryConnector\GoogleTagManagerCategoryConstants;
use FondOfSpryker\Yves\GoogleTagManagerCategoryConnector\GoogleTagManagerCategoryConnectorFactory;
use FondOfSpryker\Yves\GoogleTagManagerCategoryConnector\Model\GoogleTagManagerCategoryModelInterface;

class GoogleTagManagerCategoryNamePluginTest extends Unit
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
            ->method('getCategoryName')
            ->willReturn([
        GoogleTagManagerCategoryConstants::PARAM_CATEGORY => [
                GoogleTagManagerCategoryConstants::PARAM_CATEGORY_NAME => 'category name',
            ]]);

        $googleTagManagerCategoryContentTypePlugin = new GoogleTagManagerCategoryNamePlugin();
        $googleTagManagerCategoryContentTypePlugin->setFactory($factoryMock);

        $result = $googleTagManagerCategoryContentTypePlugin->addVariable([
        GoogleTagManagerCategoryConstants::PARAM_CATEGORY => [
            GoogleTagManagerCategoryConstants::PARAM_CATEGORY_NAME => 'category name',
        ]]);

        $this->assertIsArray($result);
        $this->assertArrayHasKey(GoogleTagManagerCategoryConstants::FIELD_CATEGORY_SIZE, $result);
    }
}
