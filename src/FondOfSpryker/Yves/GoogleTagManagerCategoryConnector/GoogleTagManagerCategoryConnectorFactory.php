<?php

namespace FondOfSpryker\Yves\GoogleTagManagerCategoryConnector;

use FondOfSpryker\Yves\GoogleTagManagerCategoryConnector\Expander\DataLayerExpander;
use FondOfSpryker\Yves\GoogleTagManagerCategoryConnector\Expander\DataLayerExpanderInterface;
use FondOfSpryker\Yves\GoogleTagManagerCategoryConnector\Expander\ProductDataLayerExpander;
use FondOfSpryker\Yves\GoogleTagManagerCategoryConnector\Expander\ProductDataLayerExpanderInterface;
use Spryker\Shared\Money\Dependency\Plugin\MoneyPluginInterface;
use Spryker\Yves\Kernel\AbstractFactory;

class GoogleTagManagerCategoryConnectorFactory extends AbstractFactory
{
    /**
     * @return \FondOfSpryker\Yves\GoogleTagManagerCategoryConnector\Expander\DataLayerExpanderInterface
     */
    public function createDataLayerExpander(): DataLayerExpanderInterface
    {
        return new DataLayerExpander($this->createProductDataLayerExpander());
    }

    /**
     * @return \FondOfSpryker\Yves\GoogleTagManagerCategoryConnector\Expander\ProductDataLayerExpanderInterface
     */
    public function createProductDataLayerExpander(): ProductDataLayerExpanderInterface
    {
        return new ProductDataLayerExpander($this->getMoneyPlugin());
    }

    /**
     * @return \Spryker\Shared\Money\Dependency\Plugin\MoneyPluginInterface
     */
    public function getMoneyPlugin(): MoneyPluginInterface
    {
        return $this->getProvidedDependency(GoogleTagManagerCategoryConnectorDependencyProvider::PLUGIN_MONEY);
    }
}
