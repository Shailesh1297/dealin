<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/dealin/helper/dir.php');
$major=$_POST['major'];
$minor=$_POST['minor'];
$build=$_POST['build'];
$app=$_FILES['application']['tmp_name'];
$date=$_POST['date'];
$list_1=@$_POST['ulist_1'];
$list_2=@$_POST['ulist_2'];
$list_3=@$_POST['ulist_3'];
$list_4=@$_POST['ulist_4'];
$list_5=@$_POST['ulist_5'];

$target=root('app');
move_uploaded_file($app,$target);

$content=$major."\n".$minor."\n".$build."\n".$date."\n".$list_1."\n".$list_2."\n".$list_3."\n".$list_4."\n".$list_5;
print($content);

$file=fopen(root('info'),"w+") or die("Failed to open or create info file");
fwrite($file,$content);
fclose($file);


?>