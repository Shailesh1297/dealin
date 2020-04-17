<?php
require_once($_SERVER['DOCUMENT_ROOT'].'\dealin\helper\dir.php');

$page='colleges';


route($page);

function route($page)
{
   //registration     
   if($page=='registration')     
  {
   require_once(root('registration'));

    $register=new Registration;
    $college='chandigarh university';
    $name='vivek';
    $email='vivek@gmail.com';
    $phone=9876543210;
    $password='asdfg';
    if(!$register->emailExist($email))
      { 
        $register->set($name,$email,$phone,$password,$college);
         print(json_encode( $register->register()));
       } 
       
  } 

  //login
  if($page=='login')     
  {
   
      require_once(root('login'));
      $email='shailesh@gmail.com';
      $password='qwerty';
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
      $city='noida';
      print(json_encode($college->colleges($city)));
  }


}


?>