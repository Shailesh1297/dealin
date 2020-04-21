<?php

  class Order{
	  
    private $item_id,$buyer_id,$payment_mode,$venue;



    public function setOrder($id,$buyer,$mode,$venue)
    {

        $this->item_id=$id;
        $this->buyer_id=$buyer;
        $this->venue=$venue;
        $this->payment_mode=$this->getModeId($mode);

    }


    public function placeOrder()
    {
      require_once($_SERVER['DOCUMENT_ROOT'].'/dealin/helper/dir.php');
      require(root('database')); 

      if($conn){
          //inserting product info
          $query="INSERT INTO orders( item_id,buyer_id,pay_mode_id,venue,ordered_on) VALUES ($this->item_id,$this->buyer_id,$this->payment_mode,'$this->venue',now())";
          
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



    //getPayment mode id

    private function getModeId($mode)
    {
         
		  require_once($_SERVER['DOCUMENT_ROOT'].'/dealin/helper/dir.php');
      require(root('database')); 

      if($conn){
         $query="SELECT pay_mode_id FROM payment_modes WHERE mode='$mode'";
         $execute=mysqli_query($conn,$query);
 
             $data=mysqli_fetch_array($execute);
              mysqli_close($conn);
              return $data['pay_mode_id'];
         }

    }
	
	
	public function getOrders($userId)
	{
		require_once($_SERVER['DOCUMENT_ROOT'].'/dealin/helper/dir.php');
         require(root('database')); 

         if($conn){
            $query="SELECT S.order_id,S.mode,S.deal,S.venue,S.item_name,S.item_price,S.category,S.description,S.image,T.name,T.email,T.mobile FROM(SELECT X.order_id,X.mode,X.deal,X.venue,X.item_name,X.item_price,X.seller_id,Y.category,X.description,X.image FROM (SELECT  P.order_id,Q.mode,P.deal,P.venue,P.item_name,P.item_price,P.seller_id,P.category_id,P.description,P.image FROM (SELECT A.order_id,A.pay_mode_id,A.deal,A.venue,B.item_name,B.item_price,B.seller_id,B.category_id,B.description,B.image FROM orders as A LEFT JOIN items as B on A.item_id=B.item_id where A.buyer_id='$userId')as P LEFT JOIN payment_modes as Q on P.pay_mode_id=Q.pay_mode_id) as X LEFT JOIN categories as Y on X.category_id=Y.category_id)as S LEFT JOIN users as T on S.seller_id=T.user_id";
            $execute=mysqli_query($conn,$query);
    
			if(mysqli_num_rows($execute)>0)
			{   
				$flag['flag']=1;
				while($row=mysqli_fetch_array($execute))
                {
                    $order[]=$row;
                 } 
				 $flag[]=$order;
                 
                 
			}else{
				 $flag['flag']=0;
			}
            mysqli_close($conn);
			return $flag;
            }
		
		
		
	}
	  
	  //getting payment modes
	  public function getPaymentModes()
	  {
		  
		  require_once($_SERVER['DOCUMENT_ROOT'].'/dealin/helper/dir.php');
         require(root('database')); 

         if($conn){
            $query="SELECT mode FROM `payment_modes`  order by mode DESC";
            $execute=mysqli_query($conn,$query);
    
                while($row=mysqli_fetch_array($execute))
                {
                    $flag[]=$row;
                 } 
                 mysqli_close($conn);
                 return $flag;
            }
		  
		  
	  }
	  
  }


?>