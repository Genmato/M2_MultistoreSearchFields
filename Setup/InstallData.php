<?php
/**
 * MultistoreSearchFields Data setup script
 *
 * @package Genmato_MultistoreSearchFields
 * @author  Vladimir Kerkhoff <v.kerkhoff@genmato.com>
 * @created 2015-11-24
 * @copyright Copyright (c) 2015 Genmato BV, https://genmato.com.
 */
namespace Genmato\MultistoreSearchFields\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $setup->startSetup();

        $connection = $installer->getConnection();
        $select = $connection->select();
        $select->from(
            ['catalog_eav_attribute' => $installer->getTable('catalog_eav_attribute')],
            [
                'attribute_id',
                'store_id' => new \Zend_Db_Expr(0),
            ]
        );

        $connection->query(
            $connection->insertFromSelect(
                $select,
                $installer->getTable('genmato_multistoresearchfields_attribute_search_store'),
                ['attribute_id', 'store_id']
            )
        );

        $setup->endSetup();
    }
}