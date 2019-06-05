<?php
namespace Evdpl\OrderedReview\Helper;


use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\Filesystem;
use Magento\Store\Model\StoreManager;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{
    /**
     * @var Filesystem
     */
    protected $_filesystem;
    /**
    /**
     * @var StoreManager
     */
    protected $_storeManager;
    

    /**
     * @var ScopeConfigInterface
     */
    protected $_scopeConfig;

    /**
     * Data constructor.
     */
    public function __construct(
        Context $context,
        Filesystem $filesystem,
        
        StoreManager $storeManager,
        ScopeConfigInterface $scopeConfig,
        \Magento\Framework\App\RequestInterface $request,
        \Magento\Framework\View\Asset\Repository $assetRepo,
        \Magento\Framework\UrlInterface $urlBuilder
    )
    {
        $this->_scopeConfig = $scopeConfig;
        $this->_storeManager = $storeManager;
        
        $this->_filesystem = $filesystem;
        $this->_request = $request;
        $this->_assetRepo = $assetRepo;
        $this->_urlBuilder = $urlBuilder;
        parent::__construct($context);
    }
    
}