<?php

class AdminList
 {


   //user list of college
  public function getUserList($collegeId)
  {
    require_once($_SERVER['DOCUMENT_ROOT'].'/dealin/helper/dir.php');
    require(root('database')); 

    if($conn)
         {
            $query="SELECT `user_id`, `name`, `email`, `mobile`, `isactive` FROM `users` WHERE  `college_id`=$collegeId";
            $execute=mysqli_query($conn,$query);
    
                        if(mysqli_num_rows($execute)>0)
                        {   
                           $flag['flag']=1;
                           while($row=mysqli_fetch_array($execute))
                              {
                                 $users[]=$row;
                              } 
                           $flag[]=$users;  
                              
                        }else
                        {
                           $flag['flag']=0;
                        }
                     mysqli_close($conn);
                        
            }else{
                $flag['flag']=0;
            }
            return $flag;
  }

 

//college list
 public function getCollegeList()
 {
   require_once($_SERVER['DOCUMENT_ROOT'].'/dealin/helper/dir.php');
   require(root('database')); 

   if($conn)
        {
           $query="SELECT * FROM `colleges`";
           $execute=mysqli_query($conn,$query);
   
                       if(mysqli_num_rows($execute)>0)
                       {   
                          $flag['flag']=1;
                          while($row=mysqli_fetch_array($execute))
                             {
                                $users[]=$row;
                             } 
                          $flag[]=$users;  
                             
                       }else
                       {
                          $flag['flag']=0;
                       }
                    mysqli_close($conn);
                       
           }else
           {
               $flag['flag']=0;
           }
           return $flag;
       }

       //product list
 public function getProductList($collegeId)
 {
   require_once($_SERVER['DOCUMENT_ROOT'].'/dealin/helper/dir.php');
   require(root('database')); 

   if($conn)
        {
           $query= "SELECT A.item_id,A.item_name,A.item_price,B.category FROM `items` as A LEFT JOIN categories as B ON A.category_id=B.category_id WHERE A.college_id=$collegeId";
           $execute=mysqli_query($conn,$query);
   
                       if(mysqli_num_rows($execute)>0)
                       {   
                          $flag['flag']=1;
                          while($row=mysqli_fetch_array($execute))
                             {
                                $users[]=$row;
                             } 
                          $flag[]=$users;  
                             
                       }else
                       {
                          $flag['flag']=0;
                       }
                    mysqli_close($conn);
                       
           }else
           {
               $flag['flag']=0;
           }
           return $flag;
       }

            //suggestion list
            public function getSuggestionList($collegeId)
            {
               require_once($_SERVER['DOCUMENT_ROOT'].'/dealin/helper/dir.php');
               require(root('database')); 

               if($conn)
                  {
                     $query="SELECT A.user_id,A.date,A.suggestion,A.status FROM `suggestions` as A left join users as B on A.user_id=B.user_id WHERE B.college_id=$collegeId";
                     $execute=mysqli_query($conn,$query);
               
                                 if(mysqli_num_rows($execute)>0)
                                 {   
                                    $flag['flag']=1;
                                    while($row=mysqli_fetch_array($execute))
                                       {
                                          $users[]=$row;
                                       } 
                                    $flag[]=$users;  
                                       
                                 }else
                                 {
                                    $flag['flag']=0;
                                 }
                              mysqli_close($conn);
                                 
                     }else
                     {
                           $flag['flag']=0;
                     }
                     return $flag;
                  }

               //transaction list
               public function getTransactionList($collegeId)
               {
                  require_once($_SERVER['DOCUMENT_ROOT'].'/dealin/helper/dir.php');
                  require(root('database')); 

                  if($conn)
                     {
                        $query= "SELECT S.order_id,S.item_id,S.item_name,S.buyer_id,S.seller_id,S.deal,S.ordered_on,S.delivered_on,S.category ,T.mode FROM (SELECT Q.order_id,Q.item_id,Q.item_name,Q.buyer_id,Q.seller_id,Q.pay_mode_id,Q.deal,Q.ordered_on,Q.delivered_on,P.category FROM categories as P INNER JOIN (SELECT A.order_id,A.item_id,B.item_name,A.buyer_id,B.seller_id,A.pay_mode_id,A.deal,A.ordered_on,A.delivered_on,B.category_id FROM `orders` AS A  INNER JOIN items AS B on A.item_id=B.item_id WHERE B.college_id=$collegeId) as Q on P.category_id=Q.category_id) as S inner join payment_modes as T on S.pay_mode_id=T.pay_mode_id";
                        $execute=mysqli_query($conn,$query);
                  
                                    if(mysqli_num_rows($execute)>0)
                                    {   
                                       $flag['flag']=1;
                                       while($row=mysqli_fetch_array($execute))
                                          {
                                             $users[]=$row;
                                          } 
                                       $flag[]=$users;  
                                          
                                    }else
                                    {
                                       $flag['flag']=0;
                                    }
                                 mysqli_close($conn);
                                    
                        }else
                        {
                              $flag['flag']=0;
                        }
                        return $flag;
                     }

            

 

 }



?>