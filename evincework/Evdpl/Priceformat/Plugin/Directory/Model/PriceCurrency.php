<?php
namespace Evdpl\Priceformat\Plugin\Directory\Model;

class PriceCurrency
{

  public function beforeConvertAndRound(
    $subject,
    $amount,
    $scope = null,
    $currency = null,
    $precision = 0
  ) {
    return [$amount, $scope, $currency, 0];
  }

  public function beforeFormat(
    $subject,
    $amount,
    $includeContainer = true,
    $precision = 0,
    $scope = null,
    $currency = null
  ) {
    return [$amount, $includeContainer, 0, $scope, $currency];
  }
}