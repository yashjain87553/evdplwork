<?php
/**
 * Mageplaza_BetterSlider extension
 *                     NOTICE OF LICENSE
 * 
 *                     This source file is subject to the Mageplaza License
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://www.mageplaza.com/LICENSE.txt
 * 
 *                     @category  Mageplaza
 *                     @package   Mageplaza_BetterSlider
 *                     @copyright Copyright (c) 2016
 *                     @license   https://www.mageplaza.com/LICENSE.txt
 */
namespace Mageplaza\BetterSlider\Model\Banner\Source;

class Status implements \Magento\Framework\Option\ArrayInterface
{
    const ENABLED = 1;
    const DISABLED = 2;


    /**
     * to option array
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options = [
            [
                'value' => self::ENABLED,
                'label' => __('Enabled')
            ],
            [
                'value' => self::DISABLED,
                'label' => __('Disabled')
            ],
        ];
        return $options;

    }

    public function toCmsOptionArray()
    {

    $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
    $collection = $objectManager->get('\Magento\Cms\Model\ResourceModel\Page\CollectionFactory')->create();
    $collection->addFieldToFilter('is_active' , \Magento\Cms\Model\Page::STATUS_ENABLED);
    
    foreach($collection as $page){
         $options[] = [
                'label' => $page->getTitle(),
                'value' => $page->getId(),
            ];
    }
    return $options;
    }
}
