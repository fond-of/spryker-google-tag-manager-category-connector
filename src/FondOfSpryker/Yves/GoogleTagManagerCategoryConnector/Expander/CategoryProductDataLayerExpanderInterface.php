<?php

namespace FondOfSpryker\Yves\GoogleTagManagerCategoryConnector\Expander;

interface CategoryProductDataLayerExpanderInterface
{
    /**
     * @param array $twigVariableBag
     *
     * @return array
     */
    public function expand($twigVariableBag): array;
}
