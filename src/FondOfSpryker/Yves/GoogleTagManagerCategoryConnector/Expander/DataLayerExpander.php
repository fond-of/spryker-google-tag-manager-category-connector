<?php

namespace FondOfSpryker\Yves\GoogleTagManagerCategoryConnector\Expander;

use FondOfSpryker\Shared\GoogleTagManagerCategoryConnector\GoogleTagManagerCategoryConstants as ModuleConstants;

class DataLayerExpander implements DataLayerExpanderInterface
{
    /**
     * @var \FondOfSpryker\Yves\GoogleTagManagerCategoryConnector\Expander\ProductDataLayerExpanderInterface
     */
    protected $productExpander;

    /**
     * @param \FondOfSpryker\Yves\GoogleTagManagerCategoryConnector\Expander\ProductDataLayerExpanderInterface $productExpander
     */
    public function __construct(ProductDataLayerExpanderInterface $productExpander)
    {
        $this->productExpander = $productExpander;
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
        $dataLayer[ModuleConstants::FIELD_CATEGORY_PAGE_TYPE] = $this->getPageType($twigVariableBag, $dataLayer);
        $dataLayer[ModuleConstants::FIELD_CONTENT_TYPE] = $this->getContentType($twigVariableBag);
        $dataLayer[ModuleConstants::FIELD_CATEGORY_ID] = $this->getId($twigVariableBag);
        $dataLayer[ModuleConstants::FIELD_CATEGORY_NAME] = $this->getName($twigVariableBag);
        $dataLayer[ModuleConstants::FIELD_CATEGORY_SIZE] = $this->getSize($twigVariableBag);
        $dataLayer[ModuleConstants::FIELD_CATEGORY_PRODUCTS] = $this->getProducts($twigVariableBag);
        $dataLayer[ModuleConstants::FIELD_CATEGORY_PRODUCT_SKUS] = $this->getProductSkus($twigVariableBag);

        return $dataLayer;
    }

    /**
     * @param array $twigVariableBag
     *
     * @return string
     */
    protected function getPageType(array $twigVariableBag, array $dataLayer): string
    {
        if (isset($twigVariableBag[ModuleConstants::PARAM_CATEGORY][ModuleConstants::PARAM_PAGE_TYPE])) {
            return $twigVariableBag[ModuleConstants::PARAM_CATEGORY][ModuleConstants::PARAM_PAGE_TYPE];
        }

        if (isset($dataLayer[ModuleConstants::FIELD_CATEGORY_PAGE_TYPE])) {
            return $dataLayer[ModuleConstants::FIELD_CATEGORY_PAGE_TYPE];
        }

        return '';
    }

    /**
     * @param array $twigVariableBag
     *
     * @return string
     */
    protected function getContentType(array $twigVariableBag): string
    {
        if (!isset($twigVariableBag[ModuleConstants::PARAM_CATEGORY][ModuleConstants::PARAM_CONTENT_TYPE])) {
            return '';
        }

        return $twigVariableBag[ModuleConstants::PARAM_CATEGORY][ModuleConstants::PARAM_CONTENT_TYPE];
    }

    /**
     * @param array $twigVariableBag
     *
     * @return int|null
     */
    protected function getId(array $twigVariableBag): ?int
    {
        if (!isset($twigVariableBag[ModuleConstants::PARAM_CATEGORY])) {
            return null;
        }

        if (!isset($twigVariableBag[ModuleConstants::PARAM_CATEGORY][ModuleConstants::PARAM_ID_CATEGORY])) {
            return null;
        }

        return $twigVariableBag[ModuleConstants::PARAM_CATEGORY][ModuleConstants::PARAM_ID_CATEGORY];
    }

    /**
     * @param array $twigVariableBag
     *
     * @return string
     */
    protected function getName(array $twigVariableBag): string
    {
        $prefix = '';
        $idCategory = $this->getId($twigVariableBag);

        if (!isset($twigVariableBag[ModuleConstants::PARAM_CATEGORY])) {
            return '';
        }

        if (!isset($twigVariableBag[ModuleConstants::PARAM_CATEGORY][ModuleConstants::PARAM_CATEGORY_NAME])) {
            return '';
        }

        if ($idCategory !== null) {
            $prefix = sprintf(ModuleConstants::CATEGORY_NAME_PREFIX, $idCategory);
        }

        return $prefix.$twigVariableBag[ModuleConstants::PARAM_CATEGORY][ModuleConstants::PARAM_CATEGORY_NAME];
    }

    /**
     * @param array $twigVariableBag
     *
     * @return int
     */
    protected function getSize(array $twigVariableBag): int
    {
        if (!isset($twigVariableBag[ModuleConstants::PARAM_PRODUCTS])) {
            return 0;
        }

        return count($twigVariableBag[ModuleConstants::PARAM_PRODUCTS]);
    }

    /**
     * @param array $twigVariableBag
     *
     * @return array
     */
    protected function getProducts(array $twigVariableBag): array
    {
        if (!isset($twigVariableBag[ModuleConstants::PARAM_PRODUCTS])) {
            return [];
        }

        $categoryProductCollection = [];

        foreach ($twigVariableBag[ModuleConstants::PARAM_PRODUCTS] as $productArray) {
            $categoryProductCollection[] = $this->productExpander->expand($productArray);
        }

        return $categoryProductCollection;
    }

    /**
     * @param array $twigVariableBag
     *
     * @return array
     */
    protected function getProductSkus(array $twigVariableBag): array
    {
        $skus = [];

        if (!isset($twigVariableBag[ModuleConstants::PARAM_PRODUCTS])) {
            return [];
        }

        foreach ($twigVariableBag[ModuleConstants::PARAM_PRODUCTS] as $productArray) {
            if (!isset($productArray[ModuleConstants::PARAM_PRODUCT_ABSTRACT_SKU])) {
                continue;
            }

            $skus[] = str_replace('ABSTRACT-', '', strtoupper($productArray[ModuleConstants::PARAM_PRODUCT_ABSTRACT_SKU]));
        }

        return $skus;
    }
}
