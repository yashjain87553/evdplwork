<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Mageplaza\Shopbybrand\Model\Brand\Attribute\Source;

class Types extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource {

    /**
     * Catalog config
     *
     * @var \Magento\Catalog\Model\Config
     */
    protected $_catalogConfig;

    /**
     * Construct
     *
     * @param \Magento\Catalog\Model\Config $catalogConfig
     */
    public function __construct(\Magento\Catalog\Model\Config $catalogConfig) {
        $this->_catalogConfig = $catalogConfig;
    }

    /**
     * Retrieve Catalog Config Singleton
     *
     * @return \Magento\Catalog\Model\Config
     */
    protected function _getCatalogConfig() {
        return $this->_catalogConfig;
    }

    /**
     * {@inheritdoc}
     */
    public function getAllOptions() {
        if ($this->_options === null) {
            $this->_options = [
                ['label' => __('Most Viewed'), 'value' => 'Most Viewed'],
                ['label' => __('Exclusive'), 'value' => 'Exclusive'],
                ['label' => __('Featured'), 'value' => 'Featured'],
                ['label' => __('New Launches'), 'value' => 'New']
            ];
        }
        return $this->_options;
    }

}
