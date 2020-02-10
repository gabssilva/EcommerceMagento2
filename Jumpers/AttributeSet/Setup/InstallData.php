<?php

namespace Jumpers\AttributeSet\Setup;

use Magento\Catalog\Model\Product;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Model\Entity\Attribute\SetFactory;
use Magento\Catalog\Setup\CategorySetupFactory;

class InstallData implements InstallDataInterface
{
    private $setFactory;
    private $categorySetupFactory;

    /**
     * Installs data for a module
     *
     * @param SetFactory $setFactory
     * @param CategorySetupFactory $categorySetupFactory
     */

    public function __construct(SetFactory $setFactory, CategorySetupFactory $categorySetupFactory)
    {
        $this->setFactory = $setFactory;
        $this->categorySetupFactory = $categorySetupFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $categorySetup = $this->categorySetupFactory->create(['setup' => $setup]);
        $attributeSet = $this->setFactory->create();

        $entityTypeId = $categorySetup->getEntityTypeId(Product::ENTITY);
        $attributeSetId = $categorySetup->getDefaultAttributeSetId($entityTypeId);
        $data = [
            'attribute_set_name' => 'SoRaiva',
            'entity_type_id' => $entityTypeId,
            'sort_order' => 200,
        ];
        $attributeSet->setData($data);
        $attributeSet->validate();
        $attributeSet->save();
        $attributeSet->initFromSkeleton($attributeSetId);
        $attributeSet->save();

        $setup->endSetup();
    }
}
