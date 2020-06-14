<?php
class Suggestion
{


    public function setSuggestion($userId,$suggestion)
    {
                
            require_once($_SERVER['DOCUMENT_ROOT'].'/dealin/helper/dir.php');
            require(root('database')); 

            if($conn)
            {
                //inserting  user suggestions
                $query="INSERT INTO suggestions(user_id, date,suggestion) VALUES ($userId,CURDATE(),'$suggestion')";
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
                return $flag;    
                    
                }


    }

    public function readSuggestion($suggestionId)
  {
    require_once($_SERVER['DOCUMENT_ROOT'].'/dealin/helper/dir.php');
    require(root('database')); 

            if($conn){
            //updating suggestion status
            $query="UPDATE suggestions SET status=1 WHERE suggestion_id=$suggestionId ";
            $execute=mysqli_query($conn,$query);
            mysqli_close($conn);
                
            }


  }





}

?>