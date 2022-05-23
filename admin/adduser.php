<?php
include('include/header.php');
include('include/sidebar.php');

$name = '';
$email = '';
$mobial = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $mobial = $_POST['mobial'];
    $status = $_POST['status'];
    $clinic_id = $_POST['clinic_id'];
    $errors = [];
    if (empty($name)) {

        $errors[] = ' يجيب ان تدخل  عنوان ';
    }
    if (empty($email)) {

        $errors[] = ' يجيب ان تدخل  محتوي ';
    }



    //يتاكد ان مستخدم مش موجود
    $adduser = $con->prepare('select id from users where name= ? ');
    $adduser->execute(array($name));
    if ($adduser->rowCount() == 1) {

        $errors[] = 'اسم   موجود ';
    }

    if (empty($errors)) {
        $stmt = $con->prepare('insert into users 
    ( `email`, `name`, `password`, 
    `mobial`,`clinic_id`,`role`, `status`,`image`)
    VALUES
    (:zemail,:zname,:zpassword,:zmobial,
    :zclinic_id,:zrole,:zstatus,:zimage
   ) ');

        $hashpassword = sha1($password);
        $stmt->execute(array(
            'zemail' => $email,
            'zname' => $name,
            'zpassword' => $hashpassword,
            'zmobial' =>  $mobial,
            'zclinic_id' =>  $clinic_id,
            'zrole'=>'docotor',
            'zstatus' =>  $status,
            'zimage' => "defulat.png"

        ));

        $count = $stmt->rowCount();

        echo '<div class="alert alert-success">تم اضافة بنجاح</div>';
        header("Location:users.php?success=1");
    } else {
        foreach ($errors as $error) {
            echo  '<div class="alert alert-danger">' . $error . '</div>';
        }
    }
}








?>
<style>
    form,
    .page-header {
        margin-right: 300px;
    }

    .form-control {
        width: 370px;
    }
</style>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header text-center">اضافة طبيب</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">

                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 ">
                            <form role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                                <div class="form-group">
                                    <label>اسم</label>
                                    <input type="text" name="name" value="<?php echo $name ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>ايميل</label>
                                    <input type="email" name="email" value="<?php echo $email ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>كلمة السر</label>
                                    <input type="password" name="password" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>الحالة</label>
                                    <select name="status" class="form-control">
                                        <option value="0">غير فعال</option>
                                        <option value="1">فعال</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>العيادة التابعة</label>
                                    <select name="clinic_id" class="form-control">
                                        <?php
                                        $stmt = $con->prepare('select * from clinics ');
                                        $stmt->execute(array());
                                        $cls = $stmt->fetchAll();
                                        foreach ($cls as $cl) {
                                        ?>
                                            <option value="<?php echo $cl['id'] ?>"><?php echo $cl['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>رقم الجوال</label>
                                    <input class="form-control" name="mobial" value="<?php echo $mobial ?>" placeholder="Enter text">
                                </div>
                        </div>
                        <button type="submit" class="btn btn-info " style="margin-right:250px;margin-top:20px">اضافة</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->

</div>
</div>
</div>
<?php
include('include/footer.php');
?>