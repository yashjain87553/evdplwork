<?php
/**
 * My own options
 *
 */
namespace Evince\Whatsapp\Model\Config\Source;
class Position implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => '1', 'label' => __('Product Detail Page View Section')],
            ['value' => '2', 'label' => __('Product Page Footer Section')],
            ['value' => '3', 'label' => __('For Both Section')]
        ];
    }
}
 
?>