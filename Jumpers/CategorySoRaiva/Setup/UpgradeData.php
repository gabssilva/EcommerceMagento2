<?php

namespace Jumpers\CategorySoRaiva\Setup;

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
            $data = $this->createCategoryAction();

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
            $data = $this->createCategoryAdventure();

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
            $data = $this->createCategoryRomance();

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
            $data = $this->createCategoryTerror();

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
        $parentCategory = $parentCategory->loadByAttribute('url_key', 'soraiva');
        $categories = [];

        $categories[] = [
            'name' => 'Ação',
            'url_key' => 'action',
            'active' => true,
            'is_anchor' => true,
            'include_in_menu' => true,
            'display_mode' => 'PRODUCTS_AND_PAGE',
            'is_active' => true,
            'parent_id' => $parentCategory->getId()
        ];

        $categories[] = [
            'name' => 'Aventura',
            'url_key' => 'adventure',
            'active' => true,
            'is_anchor' => true,
            'include_in_menu' => true,
            'display_mode' => 'PRODUCTS_AND_PAGE',
            'is_active' => true,
            'parent_id' => $parentCategory->getId()
        ];

        $categories[] = [
            'name' => 'Romance',
            'url_key' => 'romance',
            'active' => true,
            'is_anchor' => true,
            'include_in_menu' => true,
            'display_mode' => 'PRODUCTS_AND_PAGE',
            'is_active' => true,
            'parent_id' => $parentCategory->getId()
        ];

        $categories[] = [
            'name' => 'Terror',
            'url_key' => 'terror',
            'active' => true,
            'is_anchor' => true,
            'include_in_menu' => true,
            'display_mode' => 'PRODUCTS_AND_PAGE',
            'is_active' => true,
            'parent_id' => $parentCategory->getId()
        ];
        return $categories;
    }

    private function createCategoryAction()
    {
        $parentCategory = $this->categoryFactory->create();
        $parentCategory = $parentCategory->loadByAttribute('url_key', 'action');
        $categories = [];

        $categories[] = [
            'name' => 'Livros',
            'url_key' => 'action_book',
            'active' => true,
            'is_anchor' => true,
            'include_in_menu' => true,
            'display_mode' => 'PRODUCTS_AND_PAGE',
            'is_active' => true,
            'parent_id' => $parentCategory->getId()
        ];

        $categories[] = [
            'name' => 'E-Books',
            'url_key' => 'action_ebook',
            'active' => true,
            'is_anchor' => true,
            'include_in_menu' => true,
            'display_mode' => 'PRODUCTS_AND_PAGE',
            'is_active' => true,
            'parent_id' => $parentCategory->getId()
        ];
        return $categories;
    }

    private function createCategoryAdventure()
    {
        $parentCategory = $this->categoryFactory->create();
        $parentCategory = $parentCategory->loadByAttribute('url_key', 'adventure');
        $categories = [];

        $categories[] = [
            'name' => 'Livros',
            'url_key' => 'adventure_book',
            'active' => true,
            'is_anchor' => true,
            'include_in_menu' => true,
            'display_mode' => 'PRODUCTS_AND_PAGE',
            'is_active' => true,
            'parent_id' => $parentCategory->getId()
        ];

        $categories[] = [
            'name' => 'E-Books',
            'url_key' => 'adventure_ebook',
            'active' => true,
            'is_anchor' => true,
            'include_in_menu' => true,
            'display_mode' => 'PRODUCTS_AND_PAGE',
            'is_active' => true,
            'parent_id' => $parentCategory->getId()
        ];
        return $categories;
    }

    private function createCategoryRomance()
    {
        $parentCategory = $this->categoryFactory->create();
        $parentCategory = $parentCategory->loadByAttribute('url_key', 'romance');
        $categories = [];

        $categories[] = [
            'name' => 'Livros',
            'url_key' => 'romance_book',
            'active' => true,
            'is_anchor' => true,
            'include_in_menu' => true,
            'display_mode' => 'PRODUCTS_AND_PAGE',
            'is_active' => true,
            'parent_id' => $parentCategory->getId()
        ];

        $categories[] = [
            'name' => 'E-Books',
            'url_key' => 'romance_ebook',
            'active' => true,
            'is_anchor' => true,
            'include_in_menu' => true,
            'display_mode' => 'PRODUCTS_AND_PAGE',
            'is_active' => true,
            'parent_id' => $parentCategory->getId()
        ];
        return $categories;
    }

    private function createCategoryTerror()
    {
        $parentCategory = $this->categoryFactory->create();
        $parentCategory = $parentCategory->loadByAttribute('url_key', 'terror');
        $categories = [];

        $categories[] = [
            'name' => 'Livros',
            'url_key' => 'terror_book',
            'active' => true,
            'is_anchor' => true,
            'include_in_menu' => true,
            'display_mode' => 'PRODUCTS_AND_PAGE',
            'is_active' => true,
            'parent_id' => $parentCategory->getId()
        ];

        $categories[] = [
            'name' => 'E-Books',
            'url_key' => 'terror_ebook',
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
