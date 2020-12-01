<?php

namespace FondOfSpryker\Yves\GoogleTagManagerCategoryConnector;

use FondOfSpryker\Yves\GoogleTagManagerCategoryConnector\Expander\CategoryDataLayerExpander;
use FondOfSpryker\Yves\GoogleTagManagerCategoryConnector\Expander\CategoryDataLayerExpanderInterface;
use FondOfSpryker\Yves\GoogleTagManagerCategoryConnector\Expander\CategoryProductDataLayerExpander;
use FondOfSpryker\Yves\GoogleTagManagerCategoryConnector\Expander\CategoryProductDataLayerExpanderInterface;
use Spryker\Shared\Money\Dependency\Plugin\MoneyPluginInterface;
use Spryker\Yves\Kernel\AbstractFactory;

class GoogleTagManagerCategoryConnectorFactory extends AbstractFactory
{
    /**
     * @return \FondOfSpryker\Yves\GoogleTagManagerCategoryConnector\Expander\CategoryDataLayerExpanderInterface
     */
    public function createCategoryDataLayerExpander(): CategoryDataLayerExpanderInterface
    {
        return new CategoryDataLayerExpander($this->createCategoryProductDataLayerExpander());
    }

    /**
     * @return \FondOfSpryker\Yves\GoogleTagManagerCategoryConnector\Expander\CategoryProductDataLayerExpanderInterface
     */
    public function createCategoryProductDataLayerExpander(): CategoryProductDataLayerExpanderInterface
    {
        return new CategoryProductDataLayerExpander($this->getMoneyPlugin());
    }

    /**
     * @return \Spryker\Shared\Money\Dependency\Plugin\MoneyPluginInterface
     */
    public function getMoneyPlugin(): MoneyPluginInterface
    {
        return $this->getProvidedDependency(GoogleTagManagerCategoryConnectorDependencyProvider::PLUGIN_MONEY);
    }
}
