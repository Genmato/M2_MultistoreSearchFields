<?php
/**
 * MultistoreSearchFields
 *
 * @package Genmato_MultistoreSearchFields
 * @author  Vladimir Kerkhoff <v.kerkhoff@genmato.com>
 * @created 2015-11-24
 * @copyright Copyright (c) 2015 Genmato BV, https://genmato.com.
 */
namespace Genmato\MultistoreSearchFields\Plugin\Block\Advanced;

class Form
{
    /**
     * Store manager
     *
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * Modules configuration
     *
     * @var \Genmato\MultistoreSearchFields\Model\ResourceModel\Advanced\Search\Store
     */
    protected $_resourceModel;

    /**
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Genmato\MultistoreSearchFields\Model\ResourceModel\Advanced\Search\Store $resource
     */
    public function __construct(
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Genmato\MultistoreSearchFields\Model\ResourceModel\Advanced\Search\Store $resource
    ) {
        $this->_storeManager = $storeManager;
        $this->_resourceModel = $resource;
    }

    public function afterGetSearchableAttributes(\Magento\CatalogSearch\Block\Advanced\Form $subject, $result)
    {
        $storeAttributes = $result;
        $table = $this->_resourceModel->getTable('genmato_multistoresearchfields_attribute_search_store');
        $tableAlias = 'attribute_search_store';
        $storeId = $this->_storeManager->getStore()->getId();
        $storeAttributes->getSelect()->joinLeft(
            [$tableAlias => $table],
            "main_table.attribute_id={$tableAlias}.attribute_id",
            []
        )->where("({$tableAlias}.store_id='0' OR {$tableAlias}.store_id='{$storeId}')");
        $attrIds = $storeAttributes->getAllIds();
        foreach ($result as $item) {
            if (!in_array($item->getId(), $attrIds)) {
                $result->removeItemByKey($item->getId());
            }
        }
        return $result;
    }
} 
