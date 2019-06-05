<?php

/**
 * Mageplaza
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Mageplaza.com license that is
 * available through the world-wide-web at this URL:
 * https://www.mageplaza.com/LICENSE.txt
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    Mageplaza
 * @package     Mageplaza_Shopbybrand
 * @copyright   Copyright (c) 2017 Mageplaza (http://www.mageplaza.com/)
 * @license     https://www.mageplaza.com/LICENSE.txt
 */

namespace Mageplaza\Shopbybrand\Block\Brand;

/**
 * Class Featured
 * @package Mageplaza\Shopbybrand\Block\Brand
 */
class Menu extends \Mageplaza\Shopbybrand\Block\Brand {

    /**
     * Default feature template
     *
     * @type string
     */
    protected $_template = 'brand/menu.phtml';

    /**
     * @return string
     */
    function includeCssLib() {
        $cssFiles = ['Mageplaza_Core::css/owl.carousel.css', 'Mageplaza_Core::css/owl.theme.css'];
        $template = '<link rel="stylesheet" type="text/css" media="all" href="%s">' . "\n";
        $result = '';
        foreach ($cssFiles as $file) {
            $asset = $this->_assetRepo->createAsset($file);
            $result .= sprintf($template, $asset->getUrl());
        }

        return $result;
    }

    /**
     * @return mixed
     */
    public function getFeatureTitle() {
        return $this->helper->getFeatureConfig('title');
    }

    /**
     * @return bool
     */
    public function showLabel() {
        return $this->helper->getFeatureConfig('display') == \Mageplaza\Shopbybrand\Model\Config\Source\FeatureDisplay::DISPLAY_LOGO_AND_LABEL;
    }

    /**
     * @return bool
     */
    public function showTitle() {
        $actionName = $this->getRequest()->getFullActionName();
//		if ($actionName != 'mpbrand_index_index') {
//			return true;
//		}

        return !$this->helper->enableSearch();
    }

    /**
     * get feature brand
     * @return mixed
     */
    public function getTopBrands() {
        $topBrands = [];
        $collection = $this->_brandFactory->create()
                ->getBrandCollection($this->_storeManager->getStore()->getId());
        foreach ($collection as $brand) {
            if ($brand->getIsTopBrand()) {
                $topBrands[] = $brand;
            }
        }

        return $topBrands;
    }

    public function getMostViewedBrands() {
        $mostViewedBrands = [];
        $collection = $this->_brandFactory->create()
                ->getBrandCollection($this->_storeManager->getStore()->getId());
        foreach ($collection as $brand) {

            $brandTypeArr = explode(",", $brand->getBrandType());
            if (count($brandTypeArr) > 0):
                if (in_array("Most Viewed", $brandTypeArr)):
                    $mostViewedBrands[] = $brand;
                endif;
            endif;
        }

        return $mostViewedBrands;
    }

    public function getExclusiveBrands() {
        $exclusiveBrands = [];
        $collection = $this->_brandFactory->create()
                ->getBrandCollection($this->_storeManager->getStore()->getId());
        foreach ($collection as $brand) {
            $brandTypeArr = explode(",", $brand->getBrandType());
            if (count($brandTypeArr) > 0):
                if (in_array("Exclusive", $brandTypeArr)):
                    $exclusiveBrands[] = $brand;
                endif;
            endif;
        }

        return $exclusiveBrands;
    }

    public function getFeaturedBrands() {
        $featuredBrands = [];
        $collection = $this->_brandFactory->create()
                ->getBrandCollection($this->_storeManager->getStore()->getId());
        foreach ($collection as $brand) {
            $brandTypeArr = explode(",", $brand->getBrandType());
            if (count($brandTypeArr) > 0):
                if (in_array("Featured", $brandTypeArr)):
                    $featuredBrands[] = $brand;
                endif;
            endif;
        }

        return $featuredBrands;
    }

    public function getNewBrands() {
        $newBrands = [];
        $collection = $this->_brandFactory->create()
                ->getBrandCollection($this->_storeManager->getStore()->getId());
        foreach ($collection as $brand) {
            $brandTypeArr = explode(",", $brand->getBrandType());
            if (count($brandTypeArr) > 0):
                if (in_array("New", $brandTypeArr)):
                    $newBrands[] = $brand;
                endif;
            endif;
        }

        return $newBrands;
    }

    public function getSearchBrands() {
        $charBarndArray = [];
        $collection = $this->_brandFactory->create()
                ->getBrandCollection($this->_storeManager->getStore()->getId());
        foreach ($collection as $brand) {

            $name = trim($brand->getValue());
            $charBarndArray[strtoupper($name[0])][] = $brand;
        }

        return $charBarndArray;
    }

}
