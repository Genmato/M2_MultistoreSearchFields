<?php
/**
 * MultistoreSearchFields
 *
 * @package Genmato_MultistoreSearchFields
 * @author  Vladimir Kerkhoff <v.kerkhoff@genmato.com>
 * @created 2015-11-24
 * @copyright Copyright (c) 2015 Genmato BV, https://genmato.com.
 */
namespace Genmato\MultistoreSearchFields\Model\Advanced\Search;

use Magento\Framework\Model\AbstractModel;

class Store extends AbstractModel
{

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Genmato\MultistoreSearchFields\Model\ResourceModel\Advanced\Search\Store');
    }

}