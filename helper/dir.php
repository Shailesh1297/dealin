<?php
 function root($dir)
 {

    $root=$_SERVER['DOCUMENT_ROOT'].'/dealin/';
//main database
    if($dir=='database')
  {
      return $root.'database/connection.php';
  }
//database class
  if($dir=='databases')
  {
    return $root.'admin/databases/database.php'; 
  }

  //login class
   if($dir=='login')
   {
    return $root.'login/login.php';
   }
//registration class
   if($dir=='registration')
   {
    return $root.'users/registration/registration.php';
   }

   //password class
   if($dir=='password')
   {
    return $root.'users/password/password.php';
   }

   //college class
   if($dir=='cities' || $dir=='colleges')
   {
    return $root.'colleges/college.php';
   }

   //product class
	if($dir=='products')
	{
		return $root.'products/product.php';
  }
  
  //images
  if($dir=='product_image')
  {
    return $root.'images/product_images/';
  }
  
  //order class
  if($dir=='orders')
  {
	 return $root.'users/orders/orders.php'; 
  }

  //delivery
  if($dir=='deliveries')
  {
	 return $root.'users/deliveries/delivery.php'; 
  }

  //messaging
  if($dir=='messages')
  {
	 return $root.'users/messages/message.php'; 
  }
//suggestion
  if($dir=='suggestions')
  {
    return $root.'admin/suggestions/suggestion.php'; 
  }

//admin list
if($dir=='lists')
{
  return $root.'admin/lists/list.php'; 
}

//info file

if($dir=='info')
{
  return $root.'update/info/info.txt';
}

//app file

if($dir=='app')
{
  return $root.'update/app/dealin.apk';
}

if($dir=='update')
{
  return $root.'update/update.php';
}
  

 }

?>