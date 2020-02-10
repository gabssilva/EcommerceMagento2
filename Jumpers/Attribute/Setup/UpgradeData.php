<?php

namespace Jumpers\Attribute\Setup;

use Magento\Catalog\Model\Product;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;

class UpgradeData implements UpgradeDataInterface
{
    private $eavSetupFactory;

    public function __construct(EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * Upgrades data for a module
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     * @throws LocalizedException
     * @throws \Zend_Validate_Exception
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        if (version_compare($context->getVersion(), '1.0.1', '<')) {
            $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
            $eavSetup->addAttribute(Product::ENTITY, 'brand', [
                'type'     => 'text',
                'label'    => 'Marca',
                'input'    => 'text',
                'source'   => 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
                'visible'  => true,
                'required' => false,
                'global'   => ScopedAttributeInterface::SCOPE_STORE,
                'group'    => 'Aldeia_Tech',
                'sort_order' => 55,
                'visible_on_front' => true,
                'attribute_set_id' => 'AldeiaTech'
            ]);

            $eavSetup->addAttribute(Product::ENTITY, 'model', [
                'type'     => 'text',
                'label'    => 'Modelo',
                'input'    => 'text',
                'source'   => 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
                'visible'  => true,
                'required' => false,
                'global'   => ScopedAttributeInterface::SCOPE_STORE,
                'group'    => 'Aldeia_Tech',
                'sort_order' => 56,
                'visible_on_front' => true,
                'attribute_set_id' => 'AldeiaTech'
            ]);

            $eavSetup->addAttribute(Product::ENTITY, 'operational_system', [
                'type'     => 'text',
                'label'    => 'Sistema Operacional',
                'input'    => 'text',
                'source'   => 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
                'visible'  => true,
                'required' => false,
                'global'   => ScopedAttributeInterface::SCOPE_STORE,
                'group'    => 'Aldeia_Tech',
                'sort_order' => 57,
                'visible_on_front' => true,
                'attribute_set_id' => 'AldeiaTech'
            ]);

            $eavSetup->addAttribute(Product::ENTITY, 'warranty', [
                'type'     => 'text',
                'label'    => 'Garantia',
                'input'    => 'text',
                'source'   => 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
                'visible'  => true,
                'required' => false,
                'global'   => ScopedAttributeInterface::SCOPE_STORE,
                'group'    => 'Aldeia_Tech',
                'sort_order' => 58,
                'visible_on_front' => true,
                'attribute_set_id' => 'AldeiaTech'
            ]);

            $eavSetup->addAttribute(Product::ENTITY, 'display', [
                'type'     => 'text',
                'label'    => 'Display',
                'input'    => 'text',
                'source'   => 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
                'visible'  => true,
                'required' => false,
                'global'   => ScopedAttributeInterface::SCOPE_STORE,
                'group'    => 'Aldeia_Tech',
                'sort_order' => 59,
                'visible_on_front' => true,
                'attribute_set_id' => 'AldeiaTech'
            ]);

            $eavSetup->addAttribute(Product::ENTITY, 'memory', [
                'type'     => 'text',
                'label'    => 'Memória',
                'input'    => 'text',
                'source'   => 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
                'visible'  => true,
                'required' => false,
                'global'   => ScopedAttributeInterface::SCOPE_STORE,
                'group'    => 'Aldeia_Tech',
                'sort_order' => 60,
                'visible_on_front' => true,
                'attribute_set_id' => 'AldeiaTech'
            ]);

            $eavSetup->addAttribute(Product::ENTITY, 'processor', [
                'type'     => 'text',
                'label'    => 'Processador',
                'input'    => 'text',
                'source'   => 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
                'visible'  => true,
                'required' => false,
                'global'   => ScopedAttributeInterface::SCOPE_STORE,
                'group'    => 'Aldeia_Tech',
                'sort_order' => 61,
                'visible_on_front' => true,
                'attribute_set_id' => 'AldeiaTech'
            ]);

            $eavSetup->addAttribute(Product::ENTITY, 'storage', [
                'type'     => 'text',
                'label'    => 'Armazenamento',
                'input'    => 'text',
                'source'   => 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
                'visible'  => true,
                'required' => false,
                'global'   => ScopedAttributeInterface::SCOPE_STORE,
                'group'    => 'Aldeia_Tech',
                'sort_order' => 59,
                'visible_on_front' => true,
                'attribute_set_id' => 'AldeiaTech'
            ]);
        }
    }
}
