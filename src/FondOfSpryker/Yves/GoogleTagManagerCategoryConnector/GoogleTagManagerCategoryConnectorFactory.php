<?php

namespace FondOfSpryker\Yves\GoogleTagManagerCategoryConnector;

use FondOfSpryker\Yves\GoogleTagManagerCategoryConnector\Model\GoogleTagManagerCategoryModel;
use FondOfSpryker\Yves\GoogleTagManagerCategoryConnector\Model\GoogleTagManagerCategoryModelInterface;
use Spryker\Yves\Kernel\AbstractFactory;

class GoogleTagManagerCategoryConnectorFactory extends AbstractFactory
{
    /**
     * @return \FondOfSpryker\Yves\GoogleTagManagerCategoryConnector\Model\GoogleTagManagerCategoryModel
     */
    public function createGoogleTagManagerCategoryModel(): GoogleTagManagerCategoryModelInterface
    {
        return new GoogleTagManagerCategoryModel();
    }
}
