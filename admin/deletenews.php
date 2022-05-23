<?php
include('include/connect.php');
$id = $_GET['id'];
if ($id && is_numeric($id)) {
    $stmt = $con->prepare("select * from news where id=? limit 1");
    $stmt->execute(array($id));
    $count = $stmt->rowCount();
    if ($count > 0) {
        $stmt2 = $con->prepare('delete from news where id=?');
        $stmt2->execute(array($id));
        return header("Location:news.php?delete=1");
    }
} else {
    return header("Location:news.php");
}
