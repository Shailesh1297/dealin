<?php 
 
class Registration{

 private $name,$email,$mobile,$college_id,$password;

   public function register()
   {
    require_once($_SERVER['DOCUMENT_ROOT'].'/dealin/helper/dir.php');
    require(root('database')); 

    if($conn){
        //inserting user info
        $query="INSERT INTO users( name,college_id,email,mobile,user_type,isactive) VALUES ('$this->name','$this->college_id','$this->email',$this->mobile,0,0)";
        $user=mysqli_query($conn,$query);
        $userId=mysqli_insert_id($conn);
        //inserting user password
        $query="INSERT INTO passwords(user_id,password)VALUES($userId,'$this->password')";
        $password=mysqli_query($conn,$query);

        if($user && $password)
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

    public function emailExist($email)
    {
        require_once($_SERVER['DOCUMENT_ROOT'].'/dealin/helper/dir.php');
        require(root('database'));
        
    if($conn){
        $query="select user_id from users where email='$email'";
        $execute=mysqli_query($conn,$query);

        if(mysqli_num_rows($execute)==1)
           {
            mysqli_close($conn);
            return true;

           } 
        else {
            mysqli_close($conn);
            return false;
           }
           
        

        }
    }


   
  public function set($name,$email,$mobile,$password,$college)
  {
      $this->name=$name;
      $this->email=$email;
      $this->mobile=$mobile;
      $this->password=$password;
      $this->setCollege($college);
      
  }

  private function setCollege($college)
  {
    require_once($_SERVER['DOCUMENT_ROOT'].'/dealin/helper/dir.php');
    require(root('database'));

   
    if($conn){
            $query="select college_id from colleges where college_name='$college'";
            $execute=mysqli_query($conn,$query);

            if(mysqli_num_rows($execute)==1)
            {
                $row=mysqli_fetch_array($execute);
                $collgeId=$row[0];
                $this->college_id=$collgeId;
            }
        }

        mysqli_close($conn);
  }


  //updating user profile

  public function updateProfile($userId,$userName,$userEmail,$userPhone)
  {

    require_once($_SERVER['DOCUMENT_ROOT'].'/dealin/helper/dir.php');
    require(root('database')); 

    if($conn){
        //updating user info
        $query="UPDATE users SET name='$userName',email='$userEmail',mobile=$userPhone WHERE user_id=$userId";
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

        //password recovery

        public function recoverPassword($userEmail)
        {
            require_once($_SERVER['DOCUMENT_ROOT'].'/dealin/helper/dir.php');
         require(root('database')); 

            if($conn)
            {
               $query="SELECT B.password FROM users as A inner join passwords as B on A.user_id=B.user_id WHERE A.email='$userEmail'";

               $execute=mysqli_query($conn,$query);

                     if(mysqli_num_rows($execute)==1)
                     {   
                        $flag['flag']=1;
                        while($row=mysqli_fetch_array($execute))
                           {
                              $data[]=$row;
                           } 
                        $flag[]=$data;      
                     }
                     else
                     {
                        $flag['flag']=0;
                     }
                  mysqli_close($conn);
               return $flag;
            }

        }

        //updating password
        public function updatePassword($userId,$newPass)
        {
            require_once($_SERVER['DOCUMENT_ROOT'].'/dealin/helper/dir.php');
            require(root('database')); 

            if($conn){
                //updating user info
                $query="UPDATE passwords SET password='$newPass' WHERE user_id=$userId";
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

}



?>