<?php

namespace Jumpers\CategorySoRaiva\Setup;

use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Catalog\Model\CategoryFactory as Category;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    private $categoryFactory;
    private $categoryRepositoryInterface;

    /**
     * InstallData constructor.
     * @param Category $category
     * @param CategoryRepositoryInterface $categoryRepositoryInterface
     */
    public function __construct(
        Category $category,
        CategoryRepositoryInterface $categoryRepositoryInterface
    ) {
        $this->categoryFactory = $category;
        $this->categoryRepositoryInterface = $categoryRepositoryInterface;
    }

    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $data = $this->createCategory();

        foreach ($data as $d) {
            $validator = $this->categoryFactory->create();

            if (!$validator->loadByAttribute('url_key', $d['url_key'])) {
                $category = $this->categoryFactory->create();
                $category->setData($d);
                $this->save($category);
            }
        }
        $setup->endSetup();
    }

    /**
     * @return array
     */
    private function createCategory()
    {
        $categories = [];

        $categories[] = [
            'name' => 'SoRaiva',
            'url_key' => 'soraiva',
            'active' => true,
            'is_anchor' => true,
            'include_in_menu' => true,
            'display_mode' => 'PRODUCTS_AND_PAGE',
            'is_active' => true,
            'parent_id' => 1
        ];
        return $categories;
    }
    /**
     * @param CategoryInterface $category
     * @return void
     */
    private function save($category)
    {
        try {
            $this->categoryRepositoryInterface->save($category);
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }
}
