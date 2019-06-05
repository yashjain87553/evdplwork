<?php
namespace Evdpl\Testimonial\Block;
use  Evdpl\Testimonial\Model\ResourceModel\Monial\CollectionFactory;
class testimonial extends \Magento\Framework\View\Element\Template
{
	protected $collectionFactory;
	public function __construct(\Magento\Framework\View\Element\Template\Context $context,CollectionFactory $collectionFactory )
	{
		$this->collectionFactory = $collectionFactory;
		parent::__construct($context);
	}

	public function testimoniescollection()
	{
		 $collection = $this->collectionFactory->create();
		 
		 return $collection;

	}
}

