<?php

namespace FondOfSpryker\Yves\GoogleTagManagerCategoryConnector;

use Codeception\Test\Unit;
use FondOfSpryker\Yves\GoogleTagManagerCategoryConnector\Model\GoogleTagManagerCategoryModelInterface;
use Spryker\Yves\Kernel\Container;

class GoogleTagManagerCategoryConnectorFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Yves\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfSpryker\Yves\GoogleTagManagerCategoryConnector\GoogleTagManagerCategoryConnectorFactory
     */
    protected $factory;

    /**
     * @return void
     */
    protected function _before(): void {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new GoogleTagManagerCategoryConnectorFactory();
        $this->factory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateGoogleTagManagerCategoryModel(): void
    {
        $this->assertInstanceOf(
            GoogleTagManagerCategoryModelInterface::class,
            $this->factory->createGoogleTagManagerCategoryModel()
        );
    }
}
