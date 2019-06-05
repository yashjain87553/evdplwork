<?php

namespace Evince\Faques\Model;

class Status
{
    /**#@+
     * Blog Status values
     */
    const STATUS_ENABLED = 1;

    const STATUS_DISABLED = 2;

    /**
     * Retrieve option array
     *
     * @return string[]
     */
    public static function getOptionArray()
    {
        return [self::STATUS_ENABLED => __('Enabled'), self::STATUS_DISABLED => __('Disabled')];
    }

    public function getquestiontypeOptionArray()
    { 
       $array1 = array(
        "TopQueries" => "Top Queries",
         "OrderRelated" => "Order Related",
          "CancellationReplacement" =>  "Cancellation & Replacement",
         "ReturnRefund" =>  "Return & Refund",
          "Shiping" => "Shiping",
          "Payments" => "Payments",
          "OtherFAQ" => "Other FAQ's"
   
);  
       return $array1;

    }

    /**
     * Retrieve option array with empty value
     *
     * @return string[]
     */
    public function getAllOptions()
    {
        $result = [];

        foreach (self::getOptionArray() as $index => $value) {
            $result[] = ['value' => $index, 'label' => $value];
        }

        return $result;
    }

    /**
     * Retrieve option text by option value
     *
     * @param string $optionId
     * @return string
     */
    public function getOptionText($optionId)
    {
        $options = self::getOptionArray();

        return isset($options[$optionId]) ? $options[$optionId] : null;
    }
}