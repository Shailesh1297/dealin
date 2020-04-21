<?php
class Message{

  private $orderId,$venue,$message;

  public function setMessage($orderId,$venue,$message)
  {

    $this->orderId=$orderId;
    $this->venue=$venue;
    $this->message=$message;
  }


  public function saveMessage()
  {
    require_once($_SERVER['DOCUMENT_ROOT'].'/dealin/helper/dir.php');
    require(root('database')); 

            if($conn){
            //inserting messge
            $query="INSERT INTO  messages(order_id, message) VALUES ('$this->orderId','$this->message')";
            $execute=mysqli_query($conn,$query);

            if($execute)
            {
                $flag['flag']=1;
            }else
                {
                    $flag['flag']=0;
                }
                
            mysqli_close($conn);

              $this->saveVenue();
                return $flag;
                
            }

  }


  private function saveVenue()
  {
    require_once($_SERVER['DOCUMENT_ROOT'].'/dealin/helper/dir.php');
    require(root('database')); 

            if($conn){
            //updating venue
            $query="UPDATE orders SET venue='$this->venue' WHERE order_id=$this->orderId";
            $execute=mysqli_query($conn,$query);
            mysqli_close($conn);
                
            }
  }


  public function getAllMessages($user_id)
  {
    require_once($_SERVER['DOCUMENT_ROOT'].'/dealin/helper/dir.php');
         require(root('database')); 

         if($conn){
          $query="SELECT X.message_id,X.message,X.msg_status,Y.name,Y.mobile FROM (SELECT P.message_id,P.message,P.msg_status,Q.seller_id FROM (SELECT A.item_id,B.message_id,B.message,B.msg_status FROM orders as A INNER JOIN messages as B on A.order_id=B.order_id WHERE A.buyer_id='$user_id') as P LEFT JOIN items as Q on P.item_id=Q.item_id) as X LEFT JOIN users as Y on X.seller_id=Y.user_id";
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


  public function readMessage($messageId)
  {
    require_once($_SERVER['DOCUMENT_ROOT'].'/dealin/helper/dir.php');
    require(root('database')); 

            if($conn){
            //updating message status
            $query="UPDATE messages SET msg_status=1 WHERE message_id=$messageId ";
            $execute=mysqli_query($conn,$query);
            mysqli_close($conn);
                
            }


  }



}

?>