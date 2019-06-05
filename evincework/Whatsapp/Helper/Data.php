<?php

/**
 * Evince
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Evince.com license that is
 * available through the world-wide-web at this URL:
 * http://www.Evince.com/license-agreement.html
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    Evince
 * @package     Evince_Whatsapp
 */

namespace Evince\Whatsapp\Helper;

/**
 * Helper Data
 * @category Evince
 * @package  Evince_Whatsapp
 * @module   Whatsapp
 * @author   Evince Developer
 */
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
	public function __construct(
    	\Magento\Framework\App\Helper\Context $context,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
        $this->_scopeConfig = $scopeConfig;
        parent::__construct($context);
    }
	public function getButtonSize(){
		return $this->_scopeConfig->getValue('whatsapp/active_display/button_size', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
	}
	
	public function getButtonPos(){
		return $this->_scopeConfig->getValue('whatsapp/active_display/button_position', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
	}
	
	public function getIsEnable()
	{
		return $this->_scopeConfig->getValue('whatsapp/active_display/enabled', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
		
	}

	public function getCustomShareMessage()
	{
		return $this->_scopeConfig->getValue('whatsapp/active_display/custom_message', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
		
	}


	public function getBackcolor()
	{
		return $this->_scopeConfig->getValue('whatsapp/active_display/bg_color', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
	
	}
}