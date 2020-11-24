<?php

namespace FondOfSpryker\Yves\GoogleTagManagerCategoryConnector;

use FondOfSpryker\Yves\GoogleTagManagerCategoryConnector\Model\GoogleTagManagerCategoryModel;
use FondOfSpryker\Yves\GoogleTagManagerCategoryConnector\Model\GoogleTagManagerCategoryModelInterface;
use Spryker\Yves\Kernel\AbstractFactory;

class GoogleTagManagerCategoryConnectorFactory extends AbstractFactory
{
    /**
     * @return \FondOfSpryker\Yves\GoogleTagManagerCategoryConnector\Model\GoogleTagManagerCategoryModelInterface
     */
    public function createGoogleTagManagerCategoryModel(): GoogleTagManagerCategoryModelInterface
    {
        return new GoogleTagManagerCategoryModel(
            $this->getGoogleTagManagerCategoryProductPlugins()
        );
    }

    /**
     * @return \FondOfSpryker\Yves\GoogleTagManagerExtension\Dependency\GoogleTagManagerVariableBuilderPluginInterface[]
     */
    public function getGoogleTagManagerCategoryProductPlugins(): array
    {
        return $this->getProvidedDependency(GoogleTagManagerCategoryConnectorDependencyProvider::PLUGINS_GOOGLE_TAG_MANAGER_CATEGORY_PRODUCT);
    }
}
