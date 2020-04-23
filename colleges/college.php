<?php

class College{

    public function cities()
    {
        require_once($_SERVER['DOCUMENT_ROOT'].'/dealin/helper/dir.php');
         require(root('database')); 

         if($conn){
            $query="select DISTINCT(city) from colleges";
            $execute=mysqli_query($conn,$query);
    
                while($row=mysqli_fetch_array($execute))
                {
                    $flag[]=$row;
                 } 
                 mysqli_close($conn);
                 return $flag;
            }
    }


    public function colleges($city)
    {
        require_once($_SERVER['DOCUMENT_ROOT'].'/dealin/helper/dir.php');
         require(root('database')); 

         if($conn){
            $query="select college_name from colleges where city='$city'";
            $execute=mysqli_query($conn,$query);
    
                while($row=mysqli_fetch_array($execute))
                {
                    $flag[]=$row;
                 } 
                 mysqli_close($conn);
                 return $flag;
            }
    }

    public function getUserCollege($collegeId)
    {
        require_once($_SERVER['DOCUMENT_ROOT'].'/dealin/helper/dir.php');
        require(root('database')); 

        if($conn){
           $query="select college_name,city from colleges where college_id='$collegeId'";
           $execute=mysqli_query($conn,$query);
   
               while($row=mysqli_fetch_array($execute))
               {
                   $flag[]=$row;
                } 
                mysqli_close($conn);
                return $flag;
           }

    }
}

?>