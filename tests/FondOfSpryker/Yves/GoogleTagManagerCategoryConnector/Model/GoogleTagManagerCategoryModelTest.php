<?php

namespace FondOfSpryker\Yves\GoogleTagManagerCategoryConnector\Model;

use Codeception\Test\Unit;
use FondOfSpryker\Shared\GoogleTagManagerCategoryConnector\GoogleTagManagerCategoryConstants;

class GoogleTagManagerCategoryModelTest extends Unit
{
    /**
     * @var GoogleTagManagerCategoryModelInterface
     */
    protected $googleTagManagerCategoryModel;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->googleTagManagerCategoryModel = new GoogleTagManagerCategoryModel([]);
    }

    /**
     * return void
     *
     * @return void
     */
    public function testGetContentType(): void
    {
        $result = $this->googleTagManagerCategoryModel->getContentType([
            GoogleTagManagerCategoryConstants::PARAM_CONTENT_TYPE => 'CONTENT_TYPE',
        ]);

        $this->assertIsArray($result);
        $this->arrayHasKey(GoogleTagManagerCategoryConstants::FIELD_CONTENT_TYPE, $result);
    }

    /**
     * return void
     *
     * @return void
     */
    public function testGetCategoryId(): void
    {
        $result = $this->googleTagManagerCategoryModel->getCategoryId([
            GoogleTagManagerCategoryConstants::PARAM_CATEGORY => [
                GoogleTagManagerCategoryConstants::PARAM_ID_CATEGORY => 666,
            ],
        ]);

        $this->assertIsArray($result);
        $this->arrayHasKey(GoogleTagManagerCategoryConstants::FIELD_ID_CATEGORY, $result);
    }

    /**
     * return void
     *
     * @return void
     */
    public function testGetCategoryName(): void
    {
        $result = $this->googleTagManagerCategoryModel->getCategoryName([
            GoogleTagManagerCategoryConstants::PARAM_CATEGORY => [
                GoogleTagManagerCategoryConstants::PARAM_CATEGORY_NAME => 'CATEGORY_NAME',
            ],
        ]);

        $this->assertIsArray($result);
        $this->arrayHasKey(GoogleTagManagerCategoryConstants::FIELD_CATEGORY_NAME, $result);
    }

    /**
     * @param array $params
     *
     * @return array
     */
    public function testGetCategorySize(): void
    {
        $result = $this->googleTagManagerCategoryModel->getCategoryName([
            GoogleTagManagerCategoryConstants::PARAM_CATEGORY => [
                'product-1', 'product-2', 'product-2',
            ],
        ]);

        $this->assertIsArray($result);
        $this->arrayHasKey(GoogleTagManagerCategoryConstants::FIELD_CATEGORY_SIZE, $result);
    }
}
