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
            $query="select college_id,college_name from colleges where city='$city'";
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

//getting all colleges
    public function allColleges()
    {
        require_once($_SERVER['DOCUMENT_ROOT'].'/dealin/helper/dir.php');
        require(root('database')); 

        if($conn){
           $query="select college_id,college_name,city from colleges";
           $execute=mysqli_query($conn,$query);
   
               while($row=mysqli_fetch_array($execute))
               {
                   $flag[]=$row;
                } 
                mysqli_close($conn);
                return $flag;
           }
    }

    //adding a college
    public function addCollege($collegeName,$city)
    {
        require_once($_SERVER['DOCUMENT_ROOT'].'/dealin/helper/dir.php');
        require(root('database')); 
        if($conn)
        {
          //inserting college
          $query="INSERT INTO `colleges`(`college_name`, `city`) VALUES ('$collegeName','$city')";
          $execute=mysqli_query($conn,$query);
          $num=mysqli_affected_rows($conn);

                    if($num==1)
                    {
                        $flag['flag']=1;
                    
                    }
                    else{
                            $flag['flag']=0;
                    } 
                    mysqli_close($conn);
                       
           }else
           {
               $flag['flag']=0;
           }
           return $flag;
    }
}

?>