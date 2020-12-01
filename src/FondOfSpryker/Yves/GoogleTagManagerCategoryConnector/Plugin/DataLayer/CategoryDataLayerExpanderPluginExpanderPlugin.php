<?php

namespace FondOfSpryker\Yves\GoogleTagManagerCategoryConnector\Plugin\DataLayer;

use FondOfSpryker\Yves\GoogleTagManagerExtension\Dependency\GoogleTagManagerDataLayerExpanderPluginInterface;
use Spryker\Yves\Kernel\AbstractPlugin;

/**
 * @method \FondOfSpryker\Yves\GoogleTagManagerCategoryConnector\GoogleTagManagerCategoryConnectorFactory getFactory()
 */
class CategoryDataLayerExpanderPluginExpanderPlugin extends AbstractPlugin implements GoogleTagManagerDataLayerExpanderPluginInterface
{
    public const ALLOWED_PAGE_TYPES = ['category'];

    /**
     * @param string $pageType
     * @param array $twigVariableBag
     *
     * @return bool
     */
    public function isApplicable(string $pageType, array $twigVariableBag = []): bool
    {
        return in_array($pageType, static::ALLOWED_PAGE_TYPES);
    }

    /**
     * @param string $page
     * @param array $twigVariableBag
     * @param array $dataLayer
     *
     * @return array
     */
    public function expand(string $page, array $twigVariableBag, array $dataLayer): array
    {
        return $this->getFactory()
            ->createCategoryDataLayerExpander()
            ->expand($page, $twigVariableBag, $dataLayer);
    }
}
