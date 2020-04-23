<?php
require_once($_SERVER['DOCUMENT_ROOT'].'\dealin\helper\dir.php');

$page=$_POST['page'];


route($page);

function route($page)
{
   //registration     
   if($page=='registration')     
  {
   require_once(root('registration'));

    $register=new Registration;
    $college=$_POST['college'];
    $name=$_POST['name'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $password=$_POST['password'];
    if(!$register->emailExist($email))
      { 
        $register->set($name,$email,$phone,$password,$college);
        print(json_encode( $register->register()));
       }else
	   {
		   $flag['flag']=0;
		    print(json_encode($flag));
		   
	   }
       
  } 

  //update profile

  if($page=='user_update')
  {
	require_once(root('registration'));

    $register=new Registration;
    $userid=$_POST['user_id'];
    $name=$_POST['name'];
    $email=$_POST['email'];
	$phone=$_POST['phone'];
	print(json_encode($register->updateProfile($userid,$name,$email,$phone)));
    

  }
  //password update

  if($page=='password_update')
  {

	require_once(root('registration'));

    $register=new Registration;
	$userid=$_POST['user_id'];
	$newpass=$_POST['newpass'];
	print(json_encode($register->updatePassword($userid,$newpass)));
  }

  //password recovery

  if($page=='password_recovery')
  {
	require_once(root('registration'));
    $register=new Registration;
	$email=$_POST['email'];
	print(json_encode($register->recoverPassword($email)));

  }

  //login
  if($page=='login')     
  {
   
      require_once(root('login'));
      $email=$_POST['email'];
      $password=$_POST['password'];
      $login=new Login;
      $login->set($email,$password);
      print(json_encode($login->run()));
  } 

  //cities
  if($page=='cities')     
  {
   
      require_once(root('cities'));
      $cities=new College;
      print(json_encode($cities->cities()));
  } 

//colleges based on city
  if($page=='colleges')     
  {
   
      require_once(root('colleges'));
      $college=new College;
      $city=$_POST['city'];
      print(json_encode($college->colleges($city)));
  }

  //get college and city for user based on collegeId
  if($page=='college')
  {
	require_once(root('colleges'));
	$college=new College;
	$college_id=$_POST['college_id'];
	print(json_encode($college->getUserCollege($college_id)));
  }

//products addition
	if($page=='products')
	{
		require_once(root('products'));
		 header('Content-type:bitmap; charset=utf8');
		$product=new Product;
		 $user_id=$_POST['user_id'];
		 $pdt_name=$_POST['pdt_name'];
		 $pdt_price=$_POST['pdt_price'];
		 $pdt_category=$_POST['pdt_category'];
		 $pdt_description=$_POST['pdt_description'];
		 
			//decoding image
		   $decode_string=base64_decode($_POST['pdt_image']);
		    $imgname=date("dmy").date("His");
			$path=root('product_image').$imgname.'.jpg';
			$file=fopen($path,'wb');
			$is_written=fwrite($file,$decode_string);
			fclose($file);
			$pdt_image="http://192.168.43.80/dealin/images/product_images/".$imgname.".jpg";

      $product->setProduct($user_id,$pdt_name,$pdt_price,$pdt_category,$pdt_description,$pdt_image);
      print(json_encode($product->saveProduct()));

	}

	if($page=='delete_product')
	{
		require_once(root('products'));
		$product=new Product;
		$item_id=$_POST['item_id'];
		print(json_encode($product->deleteProduct($item_id)));

	}
	
	// all products
	
	if($page=='all_products')
	{
		require_once(root('products'));
		$product=new Product;
		$user_id=$_POST['user_id'];
		
		print(json_encode($product->allProducts($user_id)));
		
		
	}
	
	// user products
	
	if($page=='user_products')
	{
		require_once(root('products'));
		$product=new Product;
		$user_id=$_POST['user_id'];
		print(json_encode($product->userProducts($user_id)));
		
		
	}

	//does the item exist in order table
	if($page=='check_product')
	{
		require_once(root('products'));
		$product=new Product;
		$item_id=$_POST['item_id'];
		print(json_encode($product->checkProduct($item_id)));

	}

	if($page=='update_product')
	{
		require_once(root('products'));
		 header('Content-type:bitmap; charset=utf8');
		$product=new Product;
		 $pdt_id=$_POST['item_id'];
		 $pdt_name=$_POST['item_name'];
		 $pdt_price=$_POST['item_price'];
		$pdt_description=$_POST['description'];
		$image_name=substr($_POST['image_name'],50);
		 
			//decoding image
			$decode_string=base64_decode($_POST['image']);
		    $imgname=$image_name;
			$path=root('product_image').$imgname;
			$file=fopen($path,'wb');
			$is_written=fwrite($file,$decode_string);
			fclose($file);
			$pdt_image="http://192.168.43.80/dealin/images/product_images/".$imgname;

      print(json_encode($product->updateProduct($pdt_id,$pdt_name,$pdt_price,$pdt_description,$pdt_image)));


	}
	
	//categories
	if($page=='categories')
	{
		require_once(root('products'));
		$product=new Product;
		 print(json_encode($product->getCategories()));
		
	}
	
	//payment modes
	
	if($page=='payments')
	{
		require_once(root('orders'));
		$payments=new Order;
		 print(json_encode($payments->getPaymentModes()));
	}

	//orders
	if($page=='order')
	{

		require_once(root('orders'));
		$order=new Order;
		$item_id=$_POST['item_id'];
		$buyer_id=$_POST['buyer_id'];
		$mode=$_POST['mode'];
		$venue=$_POST['venue'];

		$order->setOrder($item_id,$buyer_id,$mode,$venue);
		print(json_encode($order->placeOrder()));

	}
	
	//user orders
	if($page=='user_orders')
	{

		require_once(root('orders'));
		$order=new Order;
		$user_id=$_POST['user_id'];
		print(json_encode($order->getOrders($user_id)));

	}


	//user deliveries

	if($page=='user_delivery')
	{
		require_once(root('deliveries'));
		$delivery=new Delivery;
		$user_id=$_POST['user_id'];
		print(json_encode($delivery->getDeliveries($user_id)));


	}

	// //complete delivery
	if($page=='complete_delivery')
	{
		require_once(root('deliveries'));
		$delivery=new Delivery;
		$order_id=$_POST['order_id'];	
		print(json_encode($delivery->completeDelivery($order_id)));		
	}

	//message
	if($page=='send_message')
	{
		require_once(root('messages'));
		$message=new Message;
		$order_id=$_POST['order_id'];
		$msg=$_POST['message'];
		$venue=$_POST['venue'];
		$message->setMessage($order_id,$venue,$msg);
		print(json_encode($message->saveMessage()));
		

	}

	//user_messages
	if($page=='user_messages')
	{
		require_once(root('messages'));
		$message=new Message;
		$user_id=$_POST['user_id'];
		print(json_encode($message->getAllMessages($user_id)));

	}

	//read message
	if($page=='message_readed')
	{
		require_once(root('messages'));
		$message=new Message;
		$message_id=$_POST['message_id'];
		$message->readMessage($message_id);
		

	}

	//inserting suggestions
	if($page=='save_suggestion')
	{
		require_once(root('suggestions'));
		$suggestion=new Suggestion;
		$user_id=$_POST['user_id'];
		$suggestedMsg=$_POST['suggestion'];
		print(json_encode($suggestion->setSuggestion($user_id,$suggestedMsg)));

	}

}


?>