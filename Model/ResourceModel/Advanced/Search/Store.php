<?php
/**
 * MultistoreSearchFields
 *
 * @package Genmato_MultistoreSearchFields
 * @author  Vladimir Kerkhoff <v.kerkhoff@genmato.com>
 * @created 2015-11-24
 * @copyright Copyright (c) 2015 Genmato BV, https://genmato.com.
 */
namespace Genmato\MultistoreSearchFields\Model\ResourceModel\Advanced\Search;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Store extends AbstractDb
{

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('genmato_multistoresearchfields_attribute_search_store', 'entity_id');
    }

    /**
     * Retrieve attribute store identifiers
     *
     * @param \Magento\Eav\Model\Attribute|int $attribute
     * @return array
     */
    public function getStoreIds($attribute)
    {
        $adapter = $this->getConnection();
        if ($attribute instanceof \Magento\Eav\Model\Attribute) {
            $attributeId = $attribute->getId();
        } else {
            $attributeId = $attribute;
        }
        $select = $adapter->select()->from(
            $this->getMainTable(),
            'store_id'
        )->where(
            'attribute_id = ?',
            (int)$attributeId
        );
        return $adapter->fetchCol($select);
    }

    /**
     * Delete removed store Ids
     *
     * @param       $attribute
     * @param array $storeIds
     */
    public function deleteStoreIds($attribute, $storeIds = array())
    {
        $table = $this->getMainTable();
        if ($attribute instanceof \Magento\Eav\Model\Attribute) {
            $attributeId = $attribute->getId();
        } else {
            $attributeId = $attribute;
        }
        if (count($storeIds) > 0) {
            $where = ['attribute_id = ?' => (int)$attributeId, 'store_id IN (?)' => $storeIds];
            $this->getConnection()->delete($table, $where);
        }
    }

    /**
     * Save new store Ids
     *
     * @param       $attribute
     * @param array $storeIds
     */
    public function saveStoreIds($attribute, $storeIds = array())
    {
        $table = $this->getMainTable();
        if ($attribute instanceof \Magento\Eav\Model\Attribute) {
            $attributeId = $attribute->getId();
        } else {
            $attributeId = $attribute;
        }
        if (count($storeIds) > 0) {
            $data = [];
            foreach ($storeIds as $storeId) {
                $data[] = ['attribute_id' => (int)$attributeId, 'store_id' => (int)$storeId];
            }
            $this->getConnection()->insertMultiple($table, $data);
        }
    }
} 
