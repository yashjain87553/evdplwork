<?php
use Magento\Framework\App\Bootstrap;
require __DIR__ . '/app/bootstrap.php';
$params = $_SERVER;

$bootstrap = Bootstrap::create(BP, $params);
$toDate="10/14/2017";
$fromDate= "10/12/2017";
$fromDate = date('Y-m-d H:i:s', strtotime($fromDate));
$toDate =   date('Y-m-d H:i:s', strtotime($toDate));
$orderCount = 0;
$obj = $bootstrap->getObjectManager();
$collection = $obj->get('Magento\Sales\Model\Order')->getCollection() 
   /* ->addAttributeToFilter('tax_amount')
    ->addAttributeToFilter('total_paid ')
    ->addAttributeToFilter('global_currency_code')*/
    ->addAttributeToFilter('created_at', array('from'=>$fromDate, 'to'=>$toDate));
try{
    $collection->setPageSize(50);
    
    $pages = $collection->getLastPageNumber();
    $currentPage = 1;
    
    $fp = @fopen('abc5.csv', 'w');
    $addedKeys = false;
    do{
        
         $collection->setCurPage($currentPage);
         $collection->load();
         foreach ($collection as $order){
           $info=$order->getShippingAddress()->getData();
           if($info['country_id']){
           $country_id=$info['country_id'];
           }  else {
           	 $country_id='';
           }
            $orderArray = $order->toArray(); 
            $orderREquiredArray['Order Id'] = $orderArray['entity_id'];
            $orderREquiredArray['Order Date'] = $orderArray['created_at'];
            $orderREquiredArray['Currency Code'] = $country_id;
            $orderREquiredArray['Order Tax'] = $orderArray['tax_amount'];
            $orderREquiredArray['Order Total'] = $orderArray['grand_total'];
            if($addedKeys == false){
                $keys = array_keys($orderREquiredArray);
                fputcsv($fp, $keys);
                $addedKeys = true;
            }
            
            fputcsv($fp, $orderREquiredArray);
         
            $orderCount++;
         }
         $currentPage++;
     
         $collection->clear();
         
         echo "Finished page $currentPage of $pages \n"; 
    } while ($currentPage <= $pages);
    fclose($fp);
 }catch (Exception $e) {
  
    Mage::printException($e);
}
echo "Saved $orderCount orders to csv file \n";
?>
