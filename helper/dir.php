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



 }

?>