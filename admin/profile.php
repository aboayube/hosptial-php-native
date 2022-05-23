<?php
include('include/header.php');
include('include/sidebar.php');

$stmt = $con->prepare('select * from users where id=?');
$stmt->execute(array($_SESSION['id']));
$user = $stmt->fetch();
$name = '';
$password = '';
$copassword = '';
$mobial = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $password = $_POST['password'];
    $copassword = $_POST['copassword'];
    $mobial = $_POST['mobial'];
    $sql = 'UPDATE `users` SET ';

    if (!empty($name)) {
        $sql .= '`name`="' . $name . '"';
        $_SESSION['name'] = $name;
    }
    if (!empty($password)) {
        if ($password == $copassword) {
            $has = sha1($password);
            $sql .= ', `password`="' . $has . '"';
        }
    }
    if (!empty($mobial)) {
        $sql .= ', `mobial`="' . $mobial . '"';
    }
    if (($_FILES['img']['name'] != "")) {

        if (!$user['image'] == 'defulat.jpeg') {
            if (file_exists('../img/users/' . $user['image'])) {
                unlink('../img/users/' . $user['image']);
            } else {
                echo 'no file there';
            }
        }
        $cv = time() . '-' . $_FILES['img']['name'];
        $imagename = $cv;
        move_uploaded_file($_FILES["img"]["tmp_name"], '../img/users/' . $cv);
        $sql .= ', `image`="' . $imagename . '"';
        $_SESSION['image'] = $imagename;
    }
    $sql .= ' where id=' . $_SESSION['id'];
    $stmt = $con->prepare($sql);

    $stmt->execute();
    $count = $stmt->rowCount();

    if ($count = 1) {
        header("Location:index.php");
    }
}

?>
<style>
    form,
    .page-header {
        margin-right: 20%;
    }

    .form-control {
        width: 370px;
    }
</style>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header text-center"><?php echo $user['name'] ?></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">

                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6 ">
                            <form role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>اسم</label>
                                    <input class="form-control" name="name" value="<?php echo $user['name'] ?>">
                                </div>
                                <div class="form-group">
                                    <label>كلمة السر</label>
                                    <input class="form-control" name="password" type="password">
                                </div>
                                <div class="form-group">
                                    <label>تاكيد كلمة السر</label>
                                    <input class="form-control" name="copassword" type="password">
                                </div>
                                <div class="form-group">
                                    <label>رقم الجوال</label>
                                    <input class="form-control" type="number" name="mobial" value="<?php echo $user['mobial'] ?>">
                                </div>


                                <div class="form-group">
                                    <label>صورة شخصية</label>
                                    <input type="file" name="img">
                                </div>

                        </div>


                        <div class="col-lg-6 ">
                            <img src="../img/users/<?php echo $user['image'] ?>" class="">


                        </div>


                        <button type="submit" class="btn btn-info " style="margin-right:250px;margin-top:20px">Submit Button</button>

                        </form>
                    </div>

                    <!-- /.col-lg-6 (nested) -->
                </div>
                <!-- /.row (nested) -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->

</div>
</div>
</div>
<?php
include('include/footer.php');
?>