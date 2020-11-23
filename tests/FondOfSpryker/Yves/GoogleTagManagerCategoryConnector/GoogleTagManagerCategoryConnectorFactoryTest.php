<?php

namespace FondOfSpryker\Yves\GoogleTagManagerCategoryConnector;

use FondOfSpryker\Yves\GoogleTagManagerCategoryConnector\Model\GoogleTagManagerCategoryModelInterface;

class GoogleTagManagerCategoryConnectorFactoryTest
{
    /**
     * @var \FondOfSpryker\Yves\GoogleTagManagerCategoryConnector\GoogleTagManagerCategoryConnectorFactory
     */
    protected $factory;

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
