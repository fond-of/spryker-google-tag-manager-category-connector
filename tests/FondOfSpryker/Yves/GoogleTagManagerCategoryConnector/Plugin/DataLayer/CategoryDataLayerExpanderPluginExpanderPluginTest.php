<?php

namespace FondOfSpryker\Yves\GoogleTagManagerCategoryConnector\Plugin\DataLayer;

use Codeception\Test\Unit;
use FondOfSpryker\Yves\GoogleTagManagerCategoryConnector\Expander\DataLayerExpanderInterface;
use FondOfSpryker\Yves\GoogleTagManagerCategoryConnector\GoogleTagManagerCategoryConnectorFactory;

class CategoryDataLayerExpanderPluginExpanderPluginTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Yves\GoogleTagManagerCategoryConnector\GoogleTagManagerCategoryConnectorFactory
     */
    protected $factoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Yves\GoogleTagManagerCategoryConnector\Expander\DataLayerExpanderInterface
     */
    protected $categoryDataLayerExpanderMock;

    /**
     * @var \FondOfSpryker\Yves\GoogleTagManagerExtension\Dependency\GoogleTagManagerDataLayerExpanderPluginInterface
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->factoryMock = $this->getMockBuilder(GoogleTagManagerCategoryConnectorFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->categoryDataLayerExpanderMock = $this->getMockBuilder(DataLayerExpanderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new CategoryDataLayerExpanderPluginExpanderPlugin();
        $this->plugin->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testIsApplicable(): void
    {
        $this->assertIsBool($this->plugin->isApplicable('category', []));
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $this->factoryMock->expects($this->once())
            ->method('createDataLayerExpander')
            ->willReturn($this->categoryDataLayerExpanderMock);

        $this->assertIsArray($this->plugin->expand('pageType', [], []));
    }
}
