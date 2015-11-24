<?php
/**
 * MultistoreSearchFields
 *
 * @package Genmato_MultistoreSearchFields
 * @author  Vladimir Kerkhoff <v.kerkhoff@genmato.com>
 * @created 2015-11-24
 * @copyright Copyright (c) 2015 Genmato BV, https://genmato.com.
 */
namespace Genmato\MultistoreSearchFields\Plugin\Block\Adminhtml\Product\Attribute\Edit\Tab;

use Magento\Catalog\Block\Adminhtml\Product\Attribute\Edit\Tab\Front as FrontTab;
use Magento\Framework\Data\Form;
use Magento\Framework\Data\Form\Element\Fieldset;

class Front
{
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @param \Magento\Store\Model\System\Store         $systemStore
     */
    public function __construct(
        \Magento\Store\Model\System\Store $systemStore
    ) {
        $this->_systemStore = $systemStore;
    }

    /**
     * @param FrontTab $subject
     * @param callable $proceed
     * @param Form $form
     * @return Front
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function aroundSetForm(FrontTab $subject, \Closure $proceed, Form $form)
    {
        $block = $proceed($form);
        /** @var Fieldset $fieldset */
        $fieldset = $form->getElement('front_fieldset');
        $fieldset->addField(
            'advanced_search_store_ids',
            'multiselect',
            [
                'name' => 'advanced_search_store_ids[]',
                'label' => __('Advanced Search Store(s)'),
                'title' => __('Advanced Search Store(s)'),
                'value' => 0,
                'values' => $this->_systemStore->getStoreValuesForForm(false, true),
            ],
            'is_visible_in_advanced_search'
        );

        $subject->getChildBlock('form_after')
            ->addFieldMap(
                'advanced_search_store_ids',
                'advanced_search_store_ids'
            )
            ->addFieldDependence(
                'advanced_search_store_ids',
                'advanced_search',
                '1'
            )
            ->addFieldDependence(
                'advanced_search_store_ids',
                'searchable',
                '1'
            );
        return $block;
    }
}
