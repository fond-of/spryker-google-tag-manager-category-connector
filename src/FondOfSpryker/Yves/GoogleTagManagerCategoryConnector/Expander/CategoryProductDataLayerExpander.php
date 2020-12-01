<?php

namespace FondOfSpryker\Yves\GoogleTagManagerCategoryConnector\Expander;

use FondOfSpryker\Shared\GoogleTagManagerCategoryConnector\GoogleTagManagerCategoryConstants as ModuleConstants;
use Spryker\Shared\Money\Dependency\Plugin\MoneyPluginInterface;

class CategoryProductDataLayerExpander implements CategoryProductDataLayerExpanderInterface
{
    /**
     * @var \Spryker\Shared\Money\Dependency\Plugin\MoneyPluginInterface
     */
    protected $moneyPlugin;

    /**
     * @param \Spryker\Shared\Money\Dependency\Plugin\MoneyPluginInterface
     */
    public function __construct(MoneyPluginInterface $moneyPlugin)
    {
        $this->moneyPlugin = $moneyPlugin;
    }

    /**
     * @param array $twigVariableBag
     *
     * @return array
     */
    public function expand($twigVariableBag): array
    {
        $dataLayer = [
            ModuleConstants::FIELD_PRODUCT_ID_ABSTRACT => $this->getIdProductAbstract($twigVariableBag),
            ModuleConstants::FIELD_PRODUCT_PRICE => $this->getPrice($twigVariableBag),
            ModuleConstants::FIELD_PRODUCT_NAME => $this->getName($twigVariableBag),
            ModuleConstants::FIELD_PRODUCT_SKU => $this->getSku($twigVariableBag),
        ];

        return $dataLayer;
    }

    /**
     * @param array $twigVariableBag
     *
     * @return int|null
     */
    protected function getIdProductAbstract(array $twigVariableBag): ?int
    {
        if (!isset($twigVariableBag[ModuleConstants::PARAM_PRODUCT_ID_ABSTRACT])) {
            return null;
        }

        return $twigVariableBag[ModuleConstants::PARAM_PRODUCT_ID_ABSTRACT];
    }

    /**
     * @param array $twigVariableBag
     *
     * @return string
     */
    protected function getName(array $twigVariableBag): string
    {
        if (!isset($twigVariableBag[ModuleConstants::PARAM_PRODUCT_ATTRIBUTES])) {
            return '';
        }

        $attributes = $twigVariableBag[ModuleConstants::PARAM_PRODUCT_ATTRIBUTES];

        return isset($attributes[ModuleConstants::PARAM_PRODUCT_ATTRIBUTE_NAME_UNTRANSLATED])
            ? $attributes[ModuleConstants::PARAM_PRODUCT_ATTRIBUTE_NAME_UNTRANSLATED]
            : $attributes[ModuleConstants::PARAM_PRODUCT_ATTRIBUTE_ABSTRACT_NAME];
    }

    /**
     * @param array $twigVariableBag
     *
     * @return string
     */
    protected function getSku(array $twigVariableBag): string
    {
        if (!isset($twigVariableBag[ModuleConstants::PARAM_PRODUCT_ABSTRACT_SKU])) {
            return '';
        }

        return str_replace('ABSTRACT-', '', strtoupper($twigVariableBag[ModuleConstants::PARAM_PRODUCT_ABSTRACT_SKU]));
    }

    /**
     * @param array $twigVariableBag
     *
     * @return float|null
     */
    protected function getPrice(array $twigVariableBag): ?float
    {
        if (!isset($twigVariableBag[ModuleConstants::PARAM_PRODUCT_PRICE])) {
            return 0;
        }

        $priceInt = $twigVariableBag[ModuleConstants::PARAM_PRODUCT_PRICE];

        return $this->moneyPlugin->convertIntegerToDecimal($priceInt);
    }
}
