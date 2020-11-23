<?php

namespace FondOfSpryker\Yves\GoogleTagManagerCategoryConnector\Plugin\Variables;

use Codeception\Test\Unit;
use FondOfSpryker\Shared\GoogleTagManagerCategoryConnector\GoogleTagManagerCategoryConstants;
use FondOfSpryker\Yves\GoogleTagManagerCategoryConnector\GoogleTagManagerCategoryConnectorFactory;
use FondOfSpryker\Yves\GoogleTagManagerCategoryConnector\Model\GoogleTagManagerCategoryModelInterface;

class GoogleTagManagerCategoryIdTest extends Unit
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
            ->method('getCategoryId')
            ->willReturn([GoogleTagManagerCategoryConstants::FIELD_ID_CATEGORY => 666]);

        $googleTagManagerCategoryContentTypePlugin = new GoogleTagManagerCategoryIdPlugin();
        $googleTagManagerCategoryContentTypePlugin->setFactory($factoryMock);

        $result = $googleTagManagerCategoryContentTypePlugin->addVariable([
            GoogleTagManagerCategoryConstants::PARAM_CATEGORY => 666,
        ]);

        $this->assertIsArray($result);
        $this->assertArrayHasKey(GoogleTagManagerCategoryConstants::FIELD_ID_CATEGORY, $result);
    }
}
