<?php
include('../connect.php');

if(isset($_GET['user']) && is_numeric($_GET['user'])){
 if(isset($_GET['status'])){
    if($_GET['status']){
        $status=0;
    }else{
        $status=1;
    }
    $stmt=$con->prepare('update users set status='.$status);
$stmt->execute();
$count=$stmt->rowCount();
if($count>0){


 header("Location:users.php?success=1");
}



}
if(isset($_GET['role'])){
    if($_GET['role']=='user'){
   
        header("Location:users.php");
exit;
    }
if($_GET['role']=='salar'){
    $role='admin';
}
if($_GET['role']=='admin'){
    $role='salar';
}
$stmt=$con->prepare('update users set role="'.$role.'" where id='.$_GET['user']);
$stmt->execute();

header("Location:users.php?success=1");
}
}else{
    header("Location:users.php");

}
?>