<?php

namespace FondOfSpryker\Yves\GoogleTagManagerCategoryConnector\Expander;

interface ProductDataLayerExpanderInterface
{
    /**
     * @param array $twigVariableBag
     *
     * @return array
     */
    public function expand($twigVariableBag): array;
}
