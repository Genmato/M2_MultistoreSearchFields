<?php
/**
 * MultistoreSearchFields
 *
 * @package Genmato_MultistoreSearchFields
 * @author  Vladimir Kerkhoff <v.kerkhoff@genmato.com>
 * @created 2015-11-24
 * @copyright Copyright (c) 2015 Genmato BV, https://genmato.com.
 */
namespace Genmato\MultistoreSearchFields\Plugin\Model\ResourceModel\Eav;

class Attribute
{
    /**
     * @var \Genmato\MultistoreSearchFields\Model\ResourceModel\Advanced\Search\Store
     */
    protected $advSearchStores;
    /**
     * @param \Genmato\MultistoreSearchFields\Model\ResourceModel\Advanced\Search\Store $advStore
     */
    public function __construct(
        \Genmato\MultistoreSearchFields\Model\ResourceModel\Advanced\Search\Store $advStore
    ) {
        $this->advSearchStores = $advStore;
    }

    public function afterLoad(\Magento\Catalog\Model\ResourceModel\Eav\Attribute $subject, $attribute)
    {
        $storeIds = $this->advSearchStores->getStoreIds($attribute->getId());
        if (count($storeIds)==0) {
            $storeIds = [0];
        }
        $attribute->setData('advanced_search_store_ids', $storeIds);
    }

    public function afterSave(\Magento\Catalog\Model\ResourceModel\Eav\Attribute $subject, $attribute)
    {
        $oldStores = $this->advSearchStores->getStoreIds($attribute->getId());
        $newStores = (array)$attribute->getAdvancedSearchStoreIds();
        // If no stores are selected or all stores and stores are selected set only to all stores value
        if (empty($newStores) || (count($newStores)>1 && in_array(0, $newStores))) {
            $newStores = [0];
        }
        $insert = array_diff($newStores, $oldStores);
        $delete = array_diff($oldStores, $newStores);
        if ($delete) {
            $this->advSearchStores->deleteStoreIds($attribute->getId(), $delete);
        }
        if ($insert) {
            $this->advSearchStores->saveStoreIds($attribute->getId(), $insert);
        }
    }
} 
