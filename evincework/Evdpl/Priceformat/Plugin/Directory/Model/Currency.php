<?php

namespace Evdpl\Priceformat\Plugin\Directory\Model;


/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class Currency 
{
   
  public function beforeFormat($price,
        $precision,
        $options = [],
        $includeContainer = true,
        $addBrackets = false)
    {
        return [$price, 0, $options, $includeContainer, $addBrackets];
    }

   

    
}
