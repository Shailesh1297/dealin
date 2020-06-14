<?php

class Update
{

   public function getUpdateInfo()
   {
    $file=fopen(root('info'),"r");

    if($file)
    {
        $flag['flag']=1;
        $data=explode("\n",fread($file,filesize(root('info'))));
        
       $flag[]=$data;
    }else
    {
        $flag['flag']=0;
    }
   
    fclose($file);
    return $flag;
   }


}



?>