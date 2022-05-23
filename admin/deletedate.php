<?php
include('include/connect.php');
$id=$_GET['id'];
if($id && is_numeric($id)){
    $stmt=$con->prepare("select * from booking where id=? limit 1");
    $stmt->execute(array($id));
    $count=$stmt->rowCount();
$data=$stmt->fetch();



if($count>0){
    $stmt2=$con->prepare('delete from booking where id=?');
    $stmt2->execute(array($id));
    return header("Location:datedoctors.php?delete=1");
}}else{
    return header("Location:datedoctors.php");
}
