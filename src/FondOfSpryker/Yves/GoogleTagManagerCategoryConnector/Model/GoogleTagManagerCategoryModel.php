<?php

namespace FondOfSpryker\Yves\GoogleTagManagerCategoryConnector\Model;

use FondOfSpryker\Shared\GoogleTagManagerCategoryConnector\GoogleTagManagerCategoryConstants as ModuleConstants;

class GoogleTagManagerCategoryModel implements GoogleTagManagerCategoryModelInterface
{
    /**
     * @var \FondOfSpryker\Yves\GoogleTagManagerExtension\Dependency\GoogleTagManagerVariableBuilderPluginInterface[]
     */
    protected $googleTagManagerCategoryProductPlugins;

    /**
     * @param \FondOfSpryker\Yves\GoogleTagManagerExtension\Dependency\GoogleTagManagerVariableBuilderPluginInterface[] $googleTagManagerCategoryProductPlugins
     */
    public function __construct(array $googleTagManagerCategoryProductPlugins)
    {
        $this->googleTagManagerCategoryProductPlugins = $googleTagManagerCategoryProductPlugins;
    }

    /**
     * @param array $params
     *
     * @return array
     */
    public function getContentType(array $params): array
    {
        if (!isset($params[ModuleConstants::PARAM_CONTENT_TYPE])) {
            return [];
        }

        return [
            ModuleConstants::FIELD_CONTENT_TYPE => $params[ModuleConstants::PARAM_CONTENT_TYPE],
        ];
    }

    /**
     * @param array $params
     *
     * @return array
     */
    public function getCategoryId(array $params): array
    {
        if (!isset($params[ModuleConstants::PARAM_CATEGORY])) {
            return [];
        }

        if (!isset($params[ModuleConstants::PARAM_CATEGORY][ModuleConstants::PARAM_ID_CATEGORY])) {
            return [];
        }

        return [
            ModuleConstants::FIELD_ID_CATEGORY => $params[ModuleConstants::PARAM_CATEGORY][ModuleConstants::PARAM_ID_CATEGORY],
        ];
    }

    /**
     * @param array $params
     *
     * @return array
     */
    public function getCategoryName(array $params): array
    {
        if (!isset($params[ModuleConstants::PARAM_CATEGORY])) {
            return [];
        }

        if (!isset($params[ModuleConstants::PARAM_CATEGORY][ModuleConstants::PARAM_CATEGORY_NAME])) {
            return [];
        }

        return [
            ModuleConstants::FIELD_CATEGORY_NAME => $params[ModuleConstants::PARAM_CATEGORY][ModuleConstants::PARAM_CATEGORY_NAME],
        ];
    }

    /**
     * @param array $params
     *
     * @return array
     */
    public function getCategorySize(array $params): array
    {
        if (!isset($params[ModuleConstants::PARAM_PRODUCTS])) {
            return [];
        }

        return [
            ModuleConstants::FIELD_CATEGORY_SIZE => count($params[ModuleConstants::PARAM_PRODUCTS]),
        ];
    }

    /**
     * @param string $page
     * @param array $params
     *
     * @return array
     */
    public function getCategoryProducts(string $page, array $params): array
    {
        if (!isset($params[ModuleConstants::PARAM_PRODUCTS])) {
            return [];
        }

        $categoryProductCollection = [];

        foreach ($params[ModuleConstants::PARAM_PRODUCTS] as $productArray) {
            $product = [];

            foreach ($this->googleTagManagerCategoryProductPlugins as $categoryProductPlugin) {
                $product = array_merge(
                    $product,
                    $categoryProductPlugin->addVariable($page, $productArray)
                );
            }

            $categoryProductCollection[] = $product;
        }

        return [
            ModuleConstants::FIELD_CATEGORY_PRODUCTS => $categoryProductCollection,
        ];
    }
}
