<?php

   class Product{
	   
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

    if($conn){
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
         
         if($conn){
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

         if($conn){
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

         if($conn){
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
		
		
		  
	  }
	  
	  
	  //getting all categories
	   public function getCategories()
	   {
		   require_once($_SERVER['DOCUMENT_ROOT'].'/dealin/helper/dir.php');
         require(root('database')); 

         if($conn){
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
      //saving image to server (NOT WORKING)
	/*  private  function saveImage($image)
	   {
         require_once($_SERVER['DOCUMENT_ROOT'].'/dealin/helper/dir.php');
			header('Content-type:bitmap; charset=utf8');
		 
		   $decode_string=base64_decode($image);
		    $imgname=date("dmy").date("His");
			$path=root('product_image').$imgname.'.jpg';
			$file=fopen($path,'wb');
			$is_written=fwrite($file,$decode_string);
			fclose($file);
			$img="http://192.168.43.80/dealin/images/product_images/".$imgname.".jpg";
			
			return $img;
	   } */
	   
	   
	  
	   
   }

?>