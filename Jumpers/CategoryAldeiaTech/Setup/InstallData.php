<?php

namespace Jumpers\CategoryAldeiaTech\Setup;

use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Catalog\Model\CategoryFactory as Category;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    private $categoryFactory;
    private $categoryRepositoryInterface;

    public function __construct(
        Category $category,
        CategoryRepositoryInterface $categoryRepositoryInterface
    ) {
        $this->categoryFactory = $category;
        $this->categoryRepositoryInterface = $categoryRepositoryInterface;
    }

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

    private function createCategory()
    {
        $categories = [];

        $categories[] = [
            'name' => 'Aldeia Tech',
            'url_key' => 'aldeia_tech',
            'active' => true,
            'is_anchor' => true,
            'include_in_menu' => true,
            'display_mode' => 'PRODUCTS_AND_PAGE',
            'is_active' => true,
            'parent_id' => 1
        ];
        return $categories;
    }

    private function save($category)
    {
        try {
            $this->categoryRepositoryInterface->save($category);
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }
}
