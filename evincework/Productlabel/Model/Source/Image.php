<?php
namespace Evdpl\Productlabel\Model\Source;

class Image
{
    
    public $subDir = 'label';

   
    protected $urlBuilder;

    
    protected $fileSystem;

    
    public function __construct(
        \Magento\Framework\UrlInterface $urlBuilder,
        \Magento\Framework\Filesystem $fileSystem
    )
    {
        $this->urlBuilder = $urlBuilder;
        $this->fileSystem = $fileSystem;
    }

    
    public function getBaseUrl()
    {
        return $this->urlBuilder->getBaseUrl(['_type' => \Magento\Framework\UrlInterface::URL_TYPE_MEDIA]).'/label/image';
    }
   
    public function getBaseDir()
    {
        return $this->fileSystem->getDirectoryWrite(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA)->getAbsolutePath('/label/image');
    }
}