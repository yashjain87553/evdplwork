<?php
namespace Evdpl\Testimonial\Model\Source;

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
     public function getratingOptionArray()
    { 
       $array1 = array(
        "" => "Select",
        "1" => "1",
        "2" => "2",
        "3" => "3",
        "4" => "4",
        "5" => "5",
         
   
);  
       return $array1;

    }
}