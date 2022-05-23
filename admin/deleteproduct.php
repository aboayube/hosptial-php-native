<?php
include('include/connect.php');
$id=$_GET['id'];
if($id && is_numeric($id)){
    $stmt=$con->prepare("select * from products where id=? limit 1");
    $stmt->execute(array($id));
    $count=$stmt->rowCount();
    $data=$stmt->fetch();

$stmt2=$con->prepare("delete  from notification where title=?");

$stmt2->execute(array($data['title']));
if($count>0){
    $stmt2=$con->prepare('delete from products where id=?');
    $stmt2->execute(array($id));
    return header("Location:products.php?delete=1");
}}else{
    return header("Location:index.php");
}
 ?>