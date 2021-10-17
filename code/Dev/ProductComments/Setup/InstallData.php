<?php

namespace Dev\ProductComments\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Dev\ProductComments\Model\Attribute\Frontend\Products as FRONTEND;
use Dev\ProductComments\Model\Attribute\Source\Products as SOURCE;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Catalog\Model\Product;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;

/**
 * @codeCoverageIgnore
 */
class InstallData implements InstallDataInterface
{
    private $eavSetupFactory;

    public function __construct(EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $eavSetup = $this->eavSetupFactory->create();
        $eavSetup->addAttribute(
            Product::ENTITY,
            'Product_Comments',
            [
                'group' => 'General',
                'type' => 'varchar',
                'label' => 'Product_Comments',
                'input' => 'select',
                'source' => SOURCE::class,
                'frontend' => FRONTEND::class,
                'required' => false,
                'sort_order' => 50,
                'global' => ScopedAttributeInterface::SCOPE_STORE,
                'is_used_in_grid'                   => false,
                'is_visible_in_grid'                => false,
                'is_filterable_in_grid'             => false,
                'visible'                           => true,
                'is_html_allowed_on_front'          => true,
                'visible_on_front'                  => false
            ]
        );
    }
}
