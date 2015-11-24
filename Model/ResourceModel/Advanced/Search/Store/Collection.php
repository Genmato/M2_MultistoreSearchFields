<?php
/**
 * MultistoreSearchFields
 *
 * @package Genmato_MultistoreSearchFields
 * @author  Vladimir Kerkhoff <v.kerkhoff@genmato.com>
 * @created 2015-11-24
 * @copyright Copyright (c) 2015 Genmato BV, https://genmato.com.
 */
namespace Genmato\MultistoreSearchFields\Model\ResourceModel\Advanced\Search\Store;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'entity_id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            'Genmato\MultistoreSearchFields\Model\Advanced\Search\Store',
            'Genmato\MultiStoreSearchFields\Model\ResourceModel\Advanced\Search\Store'
        );
    }

} 
