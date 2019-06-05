<?php

/**
 * Mageplaza_BetterSlider extension
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the MIT License
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/mit-license.php
 *
 * @category       Mageplaza
 * @package        Mageplaza_BetterSlider
 * @copyright      Copyright (c) 2016
 * @author         Sam
 * @license        Mageplaza License
 */

namespace Mageplaza\BetterSlider\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\ObjectManagerInterface;
use \Magento\Framework\View\Element\Template\Context;
use Mageplaza\BetterSlider\Model\SliderFactory as SliderModelFactory;
use Mageplaza\BetterSlider\Model\BannerFactory as BannerModelFactory;

class Banner extends \Magento\Framework\View\Element\Template {

    protected $sliderFactory;
    protected $bannerFactory;

    public function __construct(
    Context $context, SliderModelFactory $sliderFactory, BannerModelFactory $bannerFactory
    ) {
        $this->sliderFactory = $sliderFactory;
        $this->bannerFactory = $bannerFactory;
        parent::__construct($context);
    }
    protected function _prepareLayout() {
        
    }
    public function getBanner($pageid) {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $objDate = $objectManager->create('Magento\Framework\Stdlib\DateTime\DateTime');
        $date = strtotime($objDate->date('Y-m-d'));
        $resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
        $connection = $resource->getConnection();
        $tableName = $resource->getTableName('mageplaza_betterslider_banner');
        $sql = "Select * FROM " . $tableName;
        $result = $connection->fetchAll($sql);
        $x = array(array(),array());
        $i = 0;
        foreach ($result as $value) {
            $starttime = strtotime($value['valid_from']);
            $endtime = strtotime($value['valid_to']);
            if ($starttime <= $date && $endtime >= $date){
                $bannerpageid = explode(',', $value['cmspage']);
                if (in_array($pageid, $bannerpageid)) {
                    $x[$i]['file'] = $value['upload_file'];
                    $x[$i]['url'] = $value['url'];
                    $x[$i]['name'] = $value['name'];
                    $i++;
                }
            }
        }
        return $x;
    }
}