<?php
include('include/connect.php');
$id=$_GET['id'];
if($id && is_numeric($id)){
    $stmt=$con->prepare("select * from users where id=? limit 1");
    $stmt->execute(array($id));
    $user=$stmt->fetch();
    $count=$stmt->rowCount();
if($count>0){
    $stmt2=$con->prepare('UPDATE `users` SET `status`=? WHERE id=?');

$st=$user['status']==1?0:1;
    $stmt2->execute(array($st,$id));
    header("Location:users.php?delete=1");
}}else{
    return header("Location:index.php");
}
