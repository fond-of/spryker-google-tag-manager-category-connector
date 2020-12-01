<?php

namespace FondOfSpryker\Yves\GoogleTagManagerCategoryConnector;

use Codeception\Test\Unit;
use Spryker\Shared\Money\Dependency\Plugin\MoneyPluginInterface;
use Spryker\Yves\Kernel\Container;

class GoogleTagManagerCategoryConnectorFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Yves\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Shared\Money\Dependency\Plugin\MoneyPluginInterface
     */
    protected $moneyPluginMock;

    /**
     * @var \FondOfSpryker\Yves\GoogleTagManagerCategoryConnector\GoogleTagManagerCategoryConnectorFactory
     */
    protected $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->moneyPluginMock = $this->getMockBuilder(MoneyPluginInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new GoogleTagManagerCategoryConnectorFactory();
        $this->factory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testGetMoneyPlugin(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->willReturn($this->moneyPluginMock);

        $this->assertInstanceOf(
            MoneyPluginInterface::class,
            $this->factory->getMoneyPlugin()
        );
    }

    /**
     * @return void
     */
    /*public function testCreateGoogleTagManagerCategoryModel(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->willReturn([]);

        $this->assertInstanceOf(
            GoogleTagManagerCategoryModelInterface::class,
            $this->factory->createCategoryDataLayerExpander()
        );
    }*/
}
