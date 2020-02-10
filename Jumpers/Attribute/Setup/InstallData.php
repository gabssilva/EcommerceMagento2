<?php

namespace Jumpers\Attribute\Setup;

use Magento\Catalog\Model\Product;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    private $eavSetupFactory;

    public function __construct(EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        $eavSetup->addAttribute(Product::ENTITY, 'genre', [
            'type'     => 'text',
            'label'    => 'Gênero',
            'input'    => 'text',
            'source'   => 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
            'visible'  => true,
            'required' => false,
            'global'   => ScopedAttributeInterface::SCOPE_STORE,
            'group'    => 'Soraiva',
            'sort_order' => 51,
            'visible_on_front' => true,
            'attribute_set_id' => 'SoRaiva'
        ]);

        $eavSetup->addAttribute(Product::ENTITY, 'publishing_company', [
            'type'     => 'text',
            'label'    => 'Editora',
            'input'    => 'text',
            'source'   => 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
            'visible'  => true,
            'required' => false,
            'global'   => ScopedAttributeInterface::SCOPE_STORE,
            'group'    => 'Soraiva',
            'sort_order' => 52,
            'visible_on_front' => true,
            'attribute_set_id' => 'SoRaiva'
        ]);

        $eavSetup->addAttribute(Product::ENTITY, 'author', [
            'type'     => 'text',
            'label'    => 'Autor',
            'input'    => 'text',
            'source'   => 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
            'visible'  => true,
            'required' => false,
            'global'   => ScopedAttributeInterface::SCOPE_STORE,
            'group'    => 'Soraiva',
            'sort_order' => 53,
            'visible_on_front' => true,
            'attribute_set_id' => 'SoRaiva'
        ]);

        $eavSetup->addAttribute(Product::ENTITY, 'number_of_pages', [
            'type'     => 'text',
            'label'    => 'Número de Páginas',
            'input'    => 'text',
            'source'   => 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
            'visible'  => true,
            'required' => false,
            'global'   => ScopedAttributeInterface::SCOPE_STORE,
            'group'    => 'Soraiva',
            'sort_order' => 54,
            'visible_on_front' => true,
            'attribute_set_id' => 'SoRaiva'
        ]);
    }
}
