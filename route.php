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

}


?>