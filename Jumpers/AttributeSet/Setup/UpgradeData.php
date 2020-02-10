<?php

namespace Jumpers\AttributeSet\Setup;

use Magento\Catalog\Model\Product;
use Magento\Catalog\Setup\CategorySetupFactory;
use Magento\Eav\Model\Entity\Attribute\SetFactory;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;

class UpgradeData implements UpgradeDataInterface
{
    private $setFactory;
    private $categorySetupFactory;

    /**
     * Upgrades data for a module
     *
     * @param SetFactory $setFactory
     * @param CategorySetupFactory $categorySetupFactory
     */
    public function __construct(SetFactory $setFactory, CategorySetupFactory $categorySetupFactory)
    {
        $this->setFactory = $setFactory;
        $this->categorySetupFactory = $categorySetupFactory;
    }

    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        if (version_compare($context->getVersion(), '1.0.1', '<')) {

            $setup->startSetup();

            $categorySetup = $this->categorySetupFactory->create(['setup' => $setup]);
            $attributeSet = $this->setFactory->create();

            $entityTypeId = $categorySetup->getEntityTypeId(Product::ENTITY);
            $attributeSetId = $categorySetup->getDefaultAttributeSetId($entityTypeId);
            $data = [
                'attribute_set_name' => 'AldeiaTech',
                'entity_type_id' => $entityTypeId,
                'sort_order' => 201,
            ];
            $attributeSet->setData($data);
            $attributeSet->validate();
            $attributeSet->save();
            $attributeSet->initFromSkeleton($attributeSetId);
            $attributeSet->save();

            $setup->endSetup();
        }
    }
}
