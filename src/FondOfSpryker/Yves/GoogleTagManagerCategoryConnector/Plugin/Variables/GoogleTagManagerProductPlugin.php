<?php

namespace FondOfSpryker\Yves\GoogleTagManagerCategoryConnector\Plugin\Variables;

use FondOfSpryker\Yves\GoogleTagManagerExtension\Dependency\GoogleTagManagerVariableBuilderPluginInterface;
use Spryker\Yves\Kernel\AbstractPlugin;

/**
 * @method \FondOfSpryker\Yves\GoogleTagManagerCategoryConnector\GoogleTagManagerCategoryConnectorFactory getFactory()
 */
class GoogleTagManagerProductPlugin extends AbstractPlugin implements GoogleTagManagerVariableBuilderPluginInterface
{
    /**
     * @param string $page
     * @param array $params
     *
     * @return array
     */
    public function addVariable(string $page, array $params): array
    {
        return $this->getFactory()
            ->createGoogleTagManagerCategoryModel()
            ->getCategoryProducts($page, $params);
    }
}
