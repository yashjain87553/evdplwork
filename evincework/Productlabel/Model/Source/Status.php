<?php
namespace Evdpl\Productlabel\Model\Source;

class Status implements \Magento\Framework\Option\ArrayInterface
{
    const ENABLED = 1;
    const DISABLED = 0;


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
}