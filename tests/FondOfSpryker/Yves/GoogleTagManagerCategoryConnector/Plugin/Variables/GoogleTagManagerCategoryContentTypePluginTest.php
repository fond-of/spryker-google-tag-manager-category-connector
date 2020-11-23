<?php

namespace FondOfSpryker\Yves\GoogleTagManagerCategoryConnector\Plugin\Variables;

use Codeception\Test\Unit;
use FondOfSpryker\Shared\GoogleTagManagerCategoryConnector\GoogleTagManagerCategoryConstants;
use FondOfSpryker\Yves\GoogleTagManagerCategoryConnector\GoogleTagManagerCategoryConnectorFactory;
use FondOfSpryker\Yves\GoogleTagManagerCategoryConnector\Model\GoogleTagManagerCategoryModelInterface;

class GoogleTagManagerCategoryContentTypePluginTest extends Unit
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
            ->method('getContentType')
            ->willReturn([GoogleTagManagerCategoryConstants::FIELD_CONTENT_TYPE => 'CONTENT_TYPE']);

        $googleTagManagerCategoryContentTypePlugin = new GoogleTagManagerCategoryContentTypePlugin();
        $googleTagManagerCategoryContentTypePlugin->setFactory($factoryMock);

        $result = $googleTagManagerCategoryContentTypePlugin->addVariable('pageType', [
            GoogleTagManagerCategoryConstants::PARAM_CONTENT_TYPE => 'CONTENT_TYPE',
        ]);

        $this->assertIsArray($result);
        $this->assertArrayHasKey(GoogleTagManagerCategoryConstants::FIELD_CONTENT_TYPE, $result);
    }
}
