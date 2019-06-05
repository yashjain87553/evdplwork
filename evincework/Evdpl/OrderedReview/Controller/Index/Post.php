<?php
namespace Evdpl\OrderedReview\Controller\Index;

use Magento\Review\Controller\Product as ProductController;
use Magento\Framework\Controller\ResultFactory;
use Magento\Review\Model\Review;
use Magento\Review\Model\Rating;

class Post extends \Magento\Review\Controller\Product\Post {
    public function execute()
    {
        $datas = $this->getRequest()->getPostValue();
//        echo '<pre>';
//        print_r($datas);
//        echo '</pre>';
        $new_data = array();
        foreach ($datas as $key => $data_arr) {
    if (is_array($data_arr)) {
        foreach ($data_arr as $data_key => $data_value) {
            $new_data[$data_key][$key] = $data_value[0];
        }
    }
}

foreach ($new_data as &$data_arr) {
    $data_arr += array('nickname' => $datas['nickname']);
}
//echo '<pre>';
//        print_r($new_data);
//        echo '</pre>';
//        die();
        $datas[0]['entity_pk_value'] = 1;
        $datas[0]['status_id'] = 2;
        $datas[0]['title'] = 'Review 1 Test';
        $datas[0]['detail'] = 'Just test review';
        $datas[0]['entity_id'] = 1;
        $datas[0]['store_id'] = 1;
        $datas[0]['stores'] = array(0,1);
        $datas[0]['nickname'] = 'Chandresh';
//        $datas[1]['entity_pk_value'] = 1;
//        $datas[1]['status_id'] = 2;
//        $datas[1]['title'] = 'Review 2 Test';
//        $datas[1]['detail'] = 'Just test review 2';
//        $datas[1]['entity_id'] = 1;
//        $datas[1]['store_id'] = 1;
//        $datas[1]['stores'] = array(0,1);
//        $datas[1]['nickname'] = 'ChandreshV';
        


//        $data['entity_pk_value'] = 1;
//        $data['status_id'] = 2;
//        $data['title'] = 'Review 1 Test';
//        $data['detail'] = 'Just test review';
//        $data['entity_id'] = 1;
//        $data['store_id'] = 1;
//        $data['stores'] = array(0,1);
//        $data['nickname'] = 'Chandresh';
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($new_data) {
            //print_r($datas);
            
            foreach($new_data as $data){
                
               
            
            $_review = $this->_objectManager->create('Magento\Review\Model\Review');
               
            $_review->setEntityPkValue($data['id'])
                    ->setStatusId(2)
                    ->setTitle($data['summary'])
                    ->setDetail($data['review'])
                    ->setEntityId(1)
                    ->setStoreId(1)
                    ->setCustomerId($this->customerSession->getCustomerId())
                    ->setStores(array(0,1))
                    ->setNickname($data['nickname']);
                    
            //$_review->setData($data);


            try {
                $_review->save();
                $_rating  = $this->_objectManager->create('Magento\Review\Model\Rating');
            $_rating->setRatingId(1)            
        ->setReviewId($_review->getId())            
                    
        ->addOptionVote($data['ratings'],$data['id']);
            $_review->aggregate();
                $_review->unsetData();

               

                
                
                
                //return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the Review.'));
            }
                //echo $data['title'];
            }
            //die();
           
            $this->messageManager->addSuccess(__('Your review is submitted successfully for moderation. Thanks!'));

        }
        return $resultRedirect->setPath('customer/account/login/');
        //$redirect->setRedirect('customer/account/login/');
    }
}
//    public function execute() {
//        
//        $data = $this->getRequest()->getPostValue();
//        echo '<pre>';
//        print_r($data);
//        echo '</pre>';
////        foreach($data['id'] as $row=>$name) { 
////
////echo $quty=$data['summary'][$row];
////echo $price=$data['review'][$row];
////
//////$row_data[] = "('$name', '$quty', '$price')";
////}
//        exit;
//        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
//        $resultRedirect = $this->resultRedirectFactory->create();
//         
//       $data = $this->reviewSession->getFormData(true);
//        if ($data) {
//            $rating = [];
//            if (isset($data['ratings']) && is_array($data['ratings'])) {
//                $rating = $data['ratings'];
//            }
//        } else {
//            $data = $this->getRequest()->getPostValue();
//            $rating = $this->getRequest()->getParam('ratings', []);
//        }
//
//        if (($product = $this->initProduct()) && !empty($data)) {
//            /** @var \Magento\Review\Model\Review $review */
//            $review = $this->reviewFactory->create()->setData($data);
//
//            $validate = $review->validate();
//            if ($validate === true) {
//                try {
//                    $review->setEntityId($review->getEntityIdByCode(Review::ENTITY_PRODUCT_CODE))
//                            ->setEntityPkValue($product->getId())
//                            ->setStatusId(Review::STATUS_PENDING)
//                            ->setCustomerId($this->customerSession->getCustomerId())
//                            ->setStoreId($this->storeManager->getStore()->getId())
//                            ->setStores([$this->storeManager->getStore()->getId()])
//                            ->save();
//
//                    foreach ($rating as $ratingId => $optionId) {
//                        $this->ratingFactory->create()
//                                ->setRatingId($ratingId)
//                                ->setReviewId($review->getId())
//                                ->setCustomerId($this->customerSession->getCustomerId())
//                                ->addOptionVote($optionId, $product->getId());
//                    }
//
//                    $review->aggregate();
//                    $this->messageManager->addSuccess(__('You submitted your review for moderation.Thanks'));
//                } catch (\Exception $e) {
//                    $this->reviewSession->setFormData($data);
//                    $this->messageManager->addError(__('We can\'t post your review right now.'));
//                }
//            } else {
//                $this->reviewSession->setFormData($data);
//                if (is_array($validate)) {
//                    foreach ($validate as $errorMessage) {
//                        $this->messageManager->addError($errorMessage);
//                    }
//                } else {
//                    $this->messageManager->addError(__('We can\'t post your review right now.'));
//                }
//            }
//        }
//        $redirectUrl = $this->reviewSession->getRedirectUrl(true);
//        $resultRedirect->setUrl($redirectUrl ?: $this->_redirect->getRedirectUrl());
//        return $resultRedirect;
//    }
//}