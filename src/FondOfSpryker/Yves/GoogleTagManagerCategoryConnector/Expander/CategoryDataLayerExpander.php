<?php

namespace FondOfSpryker\Yves\GoogleTagManagerCategoryConnector\Expander;

use FondOfSpryker\Shared\GoogleTagManagerCategoryConnector\GoogleTagManagerCategoryConstants as ModuleConstants;

class CategoryDataLayerExpander implements CategoryDataLayerExpanderInterface
{
    /**
     * @var \FondOfSpryker\Yves\GoogleTagManagerCategoryConnector\Expander\CategoryProductDataLayerExpanderInterface
     */
    protected $productExpander;

    /**
     * @param \FondOfSpryker\Yves\GoogleTagManagerCategoryConnector\Expander\CategoryProductDataLayerExpanderInterface $productExpander
     */
    public function __construct(CategoryProductDataLayerExpanderInterface $productExpander)
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
        $dataLayer[ModuleConstants::FIELD_CONTENT_TYPE] = $this->getContentType($twigVariableBag);
        $dataLayer[ModuleConstants::FIELD_ID_CATEGORY] = $this->getId($twigVariableBag);
        $dataLayer[ModuleConstants::FIELD_CATEGORY_NAME] = $this->getName($twigVariableBag);
        $dataLayer[ModuleConstants::FIELD_CATEGORY_SIZE] = $this->getSize($twigVariableBag);
        $dataLayer[ModuleConstants::FIELD_CATEGORY_PRODUCTS] = $this->getProducts($twigVariableBag);

        return $dataLayer;
    }

    /**
     * @param array $twigVariableBag
     *
     * @return string
     */
    protected function getContentType(array $twigVariableBag): string
    {
        if (!isset($twigVariableBag[ModuleConstants::PARAM_CONTENT_TYPE])) {
            return '';
        }

        return $twigVariableBag[ModuleConstants::PARAM_CONTENT_TYPE];
    }

    /**
     * @param array $twigVariableBag
     *
     * @return string
     */
    protected function getId(array $twigVariableBag): string
    {
        if (!isset($twigVariableBag[ModuleConstants::PARAM_CATEGORY])) {
            return '';
        }

        if (!isset($twigVariableBag[ModuleConstants::PARAM_CATEGORY][ModuleConstants::PARAM_ID_CATEGORY])) {
            return '$dataLayer';
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
        if (!isset($twigVariableBag[ModuleConstants::PARAM_CATEGORY])) {
            return '';
        }

        if (!isset($twigVariableBag[ModuleConstants::PARAM_CATEGORY][ModuleConstants::PARAM_CATEGORY_NAME])) {
            return '';
        }

        return $twigVariableBag[ModuleConstants::PARAM_CATEGORY][ModuleConstants::PARAM_CATEGORY_NAME];
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
    public function getProducts(array $twigVariableBag): array
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
}
