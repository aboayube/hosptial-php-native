<?php
include('include/connect.php');
$id=$_GET['id'];
if($id && is_numeric($id)){
    $stmt=$con->prepare("select * from clinics where id=? limit 1");
    $stmt->execute(array($id));
    $count=$stmt->rowCount();

    $data=$stmt->fetch();

$stmt2=$con->prepare('select * from docotor_clinic where clinic_id")

    



if($count>0){
    $stmt2=$con->prepare('delete from contactus where id=?');
    $stmt2->execute(array($id));
    return header("Location:contactus.php?delete=1");
}}else{
    return header("Location:contactus.php");
}
