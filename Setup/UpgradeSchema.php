<?php

namespace Magestore\Bannerslider\Setup;


use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{

    /**
     * Upgrades DB schema for a module
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        if (version_compare($context->getVersion(), '1.7.2', '<')) {
            $this->addPromotionFields($setup);
        }
    }
    protected function addPromotionFields($setup) {
        $connection = $setup->getConnection();
        $table = $setup->getTable('magestore_bannerslider_banner');
        
        $connection->addColumn($table, 'promo_id', [
            'type'     => Table::TYPE_TEXT,
            'nullable' => true,
            'length'   => 255,
            'comment'  => 'Promo Id'
        ]);

        $connection->addColumn($table, 'promo_name', [
            'type'     => Table::TYPE_TEXT,
            'nullable' => true,
            'length'   => 255,
            'comment'  => 'Promo Name'
        ]);

        $connection->addColumn($table, 'promo_creative', [
            'type'     => Table::TYPE_TEXT,
            'nullable' => true,
            'length'   => 255,
            'comment'  => 'Promo Creative'
        ]);

        $connection->addColumn($table, 'promo_position', [
            'type'     => Table::TYPE_TEXT,
            'nullable' => true,
            'length'   => 255,
            'comment'  => 'Promo Position'
        ]);
    }
}