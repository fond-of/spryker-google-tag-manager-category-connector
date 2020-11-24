<?php

namespace FondOfSpryker\Yves\GoogleTagManagerCategoryConnector\Model;

interface GoogleTagManagerCategoryModelInterface
{
    /**
     * @param array $params
     *
     * @return array
     */
    public function getContentType(array $params): array;

    /**
     * @param array $params
     *
     * @return array
     */
    public function getCategoryId(array $params): array;

    /**
     * @param array $params
     *
     * @return array
     */
    public function getCategoryName(array $params): array;

    /**
     * @param array $params
     *
     * @return array
     */
    public function getCategorySize(array $params): array;
}
