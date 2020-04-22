<?php

   class Product
   {
	   
      private $user_id,$pdt_name,$pdt_price,$pdt_category,$pdt_description,$pdt_image,$college_id;

      //setter method
    public  function setProduct($user_id,$pdt_name,$pdt_price,$pdt_category,$pdt_description,$pdt_image)
      {
		    $this->pdt_image=$pdt_image;
            $this->user_id=$user_id;
            $this->college_id=$this->getCollegeId($user_id);
            $this->pdt_name=$pdt_name;
            $this->pdt_price=$pdt_price;
            $this->pdt_category=$this->getCategoryId($pdt_category);
            $this->pdt_description=$pdt_description;
           


      }

      //saving pdt details to database
    public  function saveProduct()
	   {
         require_once($_SERVER['DOCUMENT_ROOT'].'/dealin/helper/dir.php');
         require(root('database')); 

                  if($conn)
                  {
                     //inserting product info
                     $query="INSERT INTO items( item_name,item_price,college_id,seller_id,category_id,description,image) VALUES ('$this->pdt_name','$this->pdt_price','$this->college_id','$this->user_id','$this->pdt_category','$this->pdt_description','$this->pdt_image')";
                     
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

      //getting college id from user id
      private function getCollegeId($user_id)
      {
         require_once($_SERVER['DOCUMENT_ROOT'].'/dealin/helper/dir.php');
         require(root('database'));
         
         if($conn)
         {
            $query="SELECT college_id FROM users WHERE user_id='$user_id'";
            $execute=mysqli_query($conn,$query);
            
            if(mysqli_num_rows($execute)==1)
             $data=mysqli_fetch_array($execute);

             mysqli_close($conn);

            return $data['college_id']; 
			}

      }

      //getting category id from category
      private function getCategoryId($category)
      {
         require_once($_SERVER['DOCUMENT_ROOT'].'/dealin/helper/dir.php');
         require(root('database'));

         if($conn)
         {
                 $query="SELECT category_id FROM categories WHERE category='$category'";
                 $execute=mysqli_query($conn,$query);
                 
                 if(mysqli_num_rows($execute)==1)
                  $data=mysqli_fetch_array($execute);
                  mysqli_close($conn);

                 return $data['category_id']; 
         }
                 
                       

      }
	  
	  //all products except the user's
	  public function allProducts($user_id)
	  {
		  require_once($_SERVER['DOCUMENT_ROOT'].'/dealin/helper/dir.php');
         require(root('database')); 

         if($conn)
         {
            $query="SELECT A.item_id,A.item_name,A.item_price,B.category,A.description,A.image FROM items AS A LEFT JOIN categories AS B on A.category_id=B.category_id WHERE A.college_id=(SELECT college_id FROM users WHERE user_id='$user_id') AND A.item_id NOT IN (SELECT item_id FROM orders) AND A.seller_id <> '$user_id'";
            $execute=mysqli_query($conn,$query);
    
                while($row=mysqli_fetch_array($execute))
                {
                    $flag[]=$row;
                 } 
                 mysqli_close($conn);
                 return $flag;
            }
		  
		  
	  }
	  
	  //only user products
	  
	  public function userProducts($user_id)
	  {
         require_once($_SERVER['DOCUMENT_ROOT'].'/dealin/helper/dir.php');
         require(root('database')); 

            if($conn)
            {
               $query="SELECT A.item_id,A.item_name,A.item_price,B.category,A.description,A.image FROM items as A LEFT JOIN categories as B ON A.category_id=B.category_id WHERE A.seller_id=$user_id";

               $execute=mysqli_query($conn,$query);

                     if(mysqli_num_rows($execute)>0)
                     {   
                        $flag['flag']=1;
                        while($row=mysqli_fetch_array($execute))
                           {
                              $pdt[]=$row;
                           } 
                        $flag[]=$pdt;
                           
                           
                     }else
                     {
                        $flag['flag']=0;
                     }
                  mysqli_close($conn);
               return $flag;
            }
       }
	  
	  
	  //getting all categories
	   public function getCategories()
	   {
		   require_once($_SERVER['DOCUMENT_ROOT'].'/dealin/helper/dir.php');
         require(root('database')); 

         if($conn)
         {
            $query="select category from categories";
            $execute=mysqli_query($conn,$query);
    
                while($row=mysqli_fetch_array($execute))
                {
                    $flag[]=$row;
                 } 
                 mysqli_close($conn);
                 return $flag;
            }
	   }
      
      //check if item exist in orders table

      public function checkProduct($itemId)
      {
         require_once($_SERVER['DOCUMENT_ROOT'].'/dealin/helper/dir.php');
         require(root('database')); 

            if($conn)
            {
               
               $query="SELECT * FROM orders WHERE item_id=$itemId";
               
               $execute=mysqli_query($conn,$query);

                  if(mysqli_num_rows($execute)>0)
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

        //updating product info
         public function updateProduct($pdt_id,$pdt_name,$pdt_price,$pdt_description,$pdt_image)
         {

            require_once($_SERVER['DOCUMENT_ROOT'].'/dealin/helper/dir.php');
            require(root('database')); 
               
                  if($conn)
                  {
                     
                     $query="UPDATE items SET item_name='$pdt_name',item_price='$pdt_price',description='$pdt_description',image='$pdt_image' WHERE item_id=$pdt_id";
                     
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