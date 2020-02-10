<?php

namespace Jumpers\CategoryAldeiaTech\Setup;

use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Catalog\Model\CategoryFactory as Category;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;

class UpgradeData implements UpgradeDataInterface
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

    /**
     * Upgrades data for a module
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '1.0.1', '<')) {
            $data = $this->createCategory();

            foreach ($data as $d) {
                $validator = $this->categoryFactory->create();

                if (!$validator->loadByAttribute('url_key', $d['url_key'])) {
                    $category = $this->categoryFactory->create();
                    $category->setData($d);
                    $this->save($category);
                }
            }
        }

        if (version_compare($context->getVersion(), '1.0.2', '<')) {
            $data = $this->createCategorySmartPhone();

            foreach ($data as $d) {
                $validator = $this->categoryFactory->create();

                if (!$validator->loadByAttribute('url_key', $d['url_key'])) {
                    $category = $this->categoryFactory->create();
                    $category->setData($d);
                    $this->save($category);
                }
            }
        }

        if (version_compare($context->getVersion(), '1.0.3', '<')) {
            $data = $this->createCategoryNotebook();

            foreach ($data as $d) {
                $validator = $this->categoryFactory->create();

                if (!$validator->loadByAttribute('url_key', $d['url_key'])) {
                    $category = $this->categoryFactory->create();
                    $category->setData($d);
                    $this->save($category);
                }
            }
        }

        if (version_compare($context->getVersion(), '1.0.4', '<')) {
            $data = $this->createCategoryConsole();

            foreach ($data as $d) {
                $validator = $this->categoryFactory->create();

                if (!$validator->loadByAttribute('url_key', $d['url_key'])) {
                    $category = $this->categoryFactory->create();
                    $category->setData($d);
                    $this->save($category);
                }
            }
        }

        if (version_compare($context->getVersion(), '1.0.5', '<')) {
            $data = $this->createCategoryAccessory();

            foreach ($data as $d) {
                $validator = $this->categoryFactory->create();

                if (!$validator->loadByAttribute('url_key', $d['url_key'])) {
                    $category = $this->categoryFactory->create();
                    $category->setData($d);
                    $this->save($category);
                }
            }
        }
        $setup->endSetup();
    }

    private function createCategory()
    {
        $parentCategory = $this->categoryFactory->create();
        $parentCategory = $parentCategory->loadByAttribute('url_key', 'aldeia_tech');
        $categories = [];

        $categories[] = [
            'name' => 'Smartphones',
            'url_key' => 'smartphone',
            'active' => true,
            'is_anchor' => true,
            'include_in_menu' => true,
            'display_mode' => 'PRODUCTS_AND_PAGE',
            'is_active' => true,
            'parent_id' => $parentCategory->getId()
        ];

        $categories[] = [
            'name' => 'Notebooks',
            'url_key' => 'notebook',
            'active' => true,
            'is_anchor' => true,
            'include_in_menu' => true,
            'display_mode' => 'PRODUCTS_AND_PAGE',
            'is_active' => true,
            'parent_id' => $parentCategory->getId()
        ];

        $categories[] = [
            'name' => 'Consoles',
            'url_key' => 'console',
            'active' => true,
            'is_anchor' => true,
            'include_in_menu' => true,
            'display_mode' => 'PRODUCTS_AND_PAGE',
            'is_active' => true,
            'parent_id' => $parentCategory->getId()
        ];

        $categories[] = [
            'name' => 'Acessórios',
            'url_key' => 'accessory',
            'active' => true,
            'is_anchor' => true,
            'include_in_menu' => true,
            'display_mode' => 'PRODUCTS_AND_PAGE',
            'is_active' => true,
            'parent_id' => $parentCategory->getId()
        ];
        return $categories;
    }

    private function createCategorySmartPhone()
    {
        $parentCategory = $this->categoryFactory->create();
        $parentCategory = $parentCategory->loadByAttribute('url_key', 'smartphone');
        $categories = [];

        $categories[] = [
            'name' => 'Apple',
            'url_key' => 'smartphone_apple',
            'active' => true,
            'is_anchor' => true,
            'include_in_menu' => true,
            'display_mode' => 'PRODUCTS_AND_PAGE',
            'is_active' => true,
            'parent_id' => $parentCategory->getId()
        ];

        $categories[] = [
            'name' => 'Samsung',
            'url_key' => 'smartphone_samsung',
            'active' => true,
            'is_anchor' => true,
            'include_in_menu' => true,
            'display_mode' => 'PRODUCTS_AND_PAGE',
            'is_active' => true,
            'parent_id' => $parentCategory->getId()
        ];

        $categories[] = [
            'name' => 'Motorola',
            'url_key' => 'smartphone_motorola',
            'active' => true,
            'is_anchor' => true,
            'include_in_menu' => true,
            'display_mode' => 'PRODUCTS_AND_PAGE',
            'is_active' => true,
            'parent_id' => $parentCategory->getId()
        ];
        return $categories;
    }

    private function createCategoryNotebook()
    {
        $parentCategory = $this->categoryFactory->create();
        $parentCategory = $parentCategory->loadByAttribute('url_key', 'notebook');
        $categories = [];

        $categories[] = [
            'name' => 'Apple',
            'url_key' => 'notebook_apple',
            'active' => true,
            'is_anchor' => true,
            'include_in_menu' => true,
            'display_mode' => 'PRODUCTS_AND_PAGE',
            'is_active' => true,
            'parent_id' => $parentCategory->getId()
        ];

        $categories[] = [
            'name' => 'Asus',
            'url_key' => 'notebook_asus',
            'active' => true,
            'is_anchor' => true,
            'include_in_menu' => true,
            'display_mode' => 'PRODUCTS_AND_PAGE',
            'is_active' => true,
            'parent_id' => $parentCategory->getId()
        ];

        $categories[] = [
            'name' => 'Dell',
            'url_key' => 'notebook_dell',
            'active' => true,
            'is_anchor' => true,
            'include_in_menu' => true,
            'display_mode' => 'PRODUCTS_AND_PAGE',
            'is_active' => true,
            'parent_id' => $parentCategory->getId()
        ];
        return $categories;
    }

    private function createCategoryConsole()
    {
        $parentCategory = $this->categoryFactory->create();
        $parentCategory = $parentCategory->loadByAttribute('url_key', 'console');
        $categories = [];

        $categories[] = [
            'name' => 'Playstation',
            'url_key' => 'console_playstation',
            'active' => true,
            'is_anchor' => true,
            'include_in_menu' => true,
            'display_mode' => 'PRODUCTS_AND_PAGE',
            'is_active' => true,
            'parent_id' => $parentCategory->getId()
        ];

        $categories[] = [
            'name' => 'XBox',
            'url_key' => 'console_xbox',
            'active' => true,
            'is_anchor' => true,
            'include_in_menu' => true,
            'display_mode' => 'PRODUCTS_AND_PAGE',
            'is_active' => true,
            'parent_id' => $parentCategory->getId()
        ];
        return $categories;
    }

    private function createCategoryAccessory()
    {
        $parentCategory = $this->categoryFactory->create();
        $parentCategory = $parentCategory->loadByAttribute('url_key', 'accessory');
        $categories = [];

        $categories[] = [
            'name' => 'Headset',
            'url_key' => 'accessory_headset',
            'active' => true,
            'is_anchor' => true,
            'include_in_menu' => true,
            'display_mode' => 'PRODUCTS_AND_PAGE',
            'is_active' => true,
            'parent_id' => $parentCategory->getId()
        ];

        $categories[] = [
            'name' => 'Mouse',
            'url_key' => 'accessory_mouse',
            'active' => true,
            'is_anchor' => true,
            'include_in_menu' => true,
            'display_mode' => 'PRODUCTS_AND_PAGE',
            'is_active' => true,
            'parent_id' => $parentCategory->getId()
        ];

        $categories[] = [
            'name' => 'Teclado',
            'url_key' => 'accessory_keyboard',
            'active' => true,
            'is_anchor' => true,
            'include_in_menu' => true,
            'display_mode' => 'PRODUCTS_AND_PAGE',
            'is_active' => true,
            'parent_id' => $parentCategory->getId()
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
