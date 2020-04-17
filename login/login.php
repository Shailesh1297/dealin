<?php
 class Login{

    private $email,$password;

            public function __construct()
            {
               
            }

            //main execution
          public  function run()
            {
                require_once($_SERVER['DOCUMENT_ROOT'].'/dealin/helper/dir.php');
                require_once(root('database'));

               
                if($conn){
                        $query="SELECT A.user_id,A.name,A.college_id,A.email,A.mobile,A.user_type,A.isActive,B.password FROM users as A left join passwords as B on A.user_id=B.user_id where A.email='$this->email' AND B.password='$this->password' AND A.isActive=0 ";
                        $execute=mysqli_query($conn,$query);

                        
                        if(mysqli_num_rows($execute)==1)
                        {
                                
                               
                               
                               $flag['flag']='1';
                                while($row=mysqli_fetch_array($execute))
                                     {
                                         $flag[]=$row;
                                      } 
                                     
                                   
                                   
                        }else{
                               $flag['flag']='0';
                               
                            }
                            return $flag;
                    }
             }
            
            //setter
           public function set($email,$password)
            {
               $this->email=$email;
                $this->password=$password;
            }
            
}
?>