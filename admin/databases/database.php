<?php

class Database{

    public function checkConnection()
    {
        require_once($_SERVER['DOCUMENT_ROOT'].'/dealin/helper/dir.php');
        require(root('database')); 

           if($conn)
           {
               echo "Connection successful";
           }
    }

}


?>