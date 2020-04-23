<?php
 function root($dir)
 {

    $root=$_SERVER['DOCUMENT_ROOT'].'/dealin/';

    if($dir=='database')
  {
      return $root.'database/connection.php';
  }

   if($dir=='login')
   {
    return $root.'login/login.php';
   }

   if($dir=='registration')
   {
    return $root.'users/registration/registration.php';
   }

   if($dir=='password')
   {
    return $root.'users/password/password.php';
   }

   if($dir=='cities' || $dir=='colleges')
   {
    return $root.'colleges/college.php';
   }

	if($dir=='products')
	{
		return $root.'products/product.php';
  }
  
  if($dir=='product_image')
  {
    return $root.'images/product_images/';
  }
  
  if($dir=='orders')
  {
	 return $root.'users/orders/orders.php'; 
  }

  if($dir=='deliveries')
  {
	 return $root.'users/deliveries/delivery.php'; 
  }

  if($dir=='messages')
  {
	 return $root.'users/messages/message.php'; 
  }

  if($dir=='suggestions')
  {
    return $root.'admin/suggestions/suggestion.php'; 
  }

 }

?>