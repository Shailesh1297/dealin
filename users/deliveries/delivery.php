<?php

class Delivery
{

  public function getDeliveries($user_id)
  {

    require_once($_SERVER['DOCUMENT_ROOT'].'/dealin/helper/dir.php');
         require(root('database')); 

         if($conn){
            $query= "SELECT X.item_name,X.item_price,X.category,X.description,X.order_id,X.mode,X.deal,X.venue,Y.name,Y.email,Y.mobile FROM (SELECT S.item_name,S.item_price,S.category,S.description,S.order_id,S.buyer_id,T.mode,S.deal,S.venue FROM (SELECT P.item_name,P.item_price,Q.category,P.description,P.order_id,P.buyer_id,P.pay_mode_id,P.deal,P.venue FROM(SELECT A.item_name,A.item_price,A.category_id,A.description,B.order_id,B.buyer_id,B.pay_mode_id,B.deal,B.venue FROM items as A INNER JOIN orders as B on A.item_id=B.item_id WHERE A.seller_id='$user_id') as P LEFT JOIN categories as Q on P.category_id=Q.category_id) as S LEFT JOIN payment_modes as T ON S.pay_mode_id=T.pay_mode_id) as X LEFT JOIN users as Y on X.buyer_id=Y.user_id";
           
            $execute=mysqli_query($conn,$query);
    
			if(mysqli_num_rows($execute)>0)
			{   
				$flag['flag']=1;
				while($row=mysqli_fetch_array($execute))
                {
                    $order[]=$row;
                 } 
				 $flag[]=$order;
                 mysqli_close($conn);
                 
			}else{
				 $flag['flag']=0;
			}
			
			return $flag;
            }
   


  }


  public function completeDelivery($orderId)
  {
    require_once($_SERVER['DOCUMENT_ROOT'].'/dealin/helper/dir.php');
    require(root('database')); 

            if($conn){
            //updating order status
            $query="UPDATE orders SET deal='1', delivered_on=NOW() WHERE order_id=$orderId";
            $execute=mysqli_query($conn,$query);

                if($execute)
                {
                    $flag['flag']=1;
                }else
                    {
                        $flag['flag']=0;
                    }
                
            mysqli_close($conn);
            return $flag;
              }
  }

  }


?>