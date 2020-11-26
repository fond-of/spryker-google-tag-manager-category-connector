<?php

namespace FondOfSpryker\Yves\GoogleTagManagerCategoryConnector;

use Spryker\Yves\Kernel\AbstractBundleDependencyProvider;
use Spryker\Yves\Kernel\Container;

class GoogleTagManagerCategoryConnectorDependencyProvider extends AbstractBundleDependencyProvider
{
    public const PLUGINS_GOOGLE_TAG_MANAGER_CATEGORY_PRODUCT = 'PLUGINS_GOOGLE_TAG_MANAGER_CATEGORY_PRODUCT';

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    public function provideDependencies(Container $container): Container
    {
        $container = $this->addGoogleTagManagerCategoryProductPlugins($container);

        return $container;
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addGoogleTagManagerCategoryProductPlugins(Container $container): Container
    {
        $container->set(static::PLUGINS_GOOGLE_TAG_MANAGER_CATEGORY_PRODUCT, function () {
            return $this->getGoogleTagManagerCategoryProductPlugins();
        });

        return $container;
    }

    /**
     * @return \FondOfSpryker\Yves\GoogleTagManagerExtension\Dependency\GoogleTagManagerVariableBuilderPluginInterface[];
     */
    protected function getGoogleTagManagerCategoryProductPlugins(): array
    {
        return [];
    }
}
