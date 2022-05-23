<?php
include('include/header.php');
include('include/sidebar.php');

$name = '';
$discription = '';
$errors = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $status = $_POST['status'];
    $discription = $_POST['discription'];
    if (empty($name)) {

        $errors[] = ' يجيب ان تدخل  عنوان ';
    }
    if (empty($discription)) {

        $errors[] = ' يجيب ان تدخل  وصف ';
    }



    if (empty($errors)) {
        $stmt = $con->prepare('insert into department 
    ( `name`, `discription`, 
    `image`,`status`
    )
    VALUES
    (:zname,:zdiscription,:zimage,:zstatus
   ) ');
        $cv = time() . '-' . $_FILES['img']['name'];

        $stmt->execute(array(
            'zname' => $name,
            'zdiscription' => $discription,
            'zimage' => 'img/department/' . $cv,
            'zstatus' => $status,

        ));

        move_uploaded_file($_FILES["img"]["tmp_name"], '../img/department/' . $cv);

        $count = $stmt->rowCount();

        echo '<div class="alert alert-success">تم اضافة بنجاح</div>';
        header("Location:department.php?success=1");
        exit;
    } else {
    }
}








?>
<style>
    form,
    .page-header {
        margin-right: 50px;
    }

    .form-control {
        width: 370px;
    }
</style>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header text-center">اضافة قسم جديد</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <?php
                if ($errors) {
                    foreach ($errors as $error) { ?>

                        <div class="alert alert-danger text-center"><?php echo $error ?></div>
                <?php }
                }
                ?>
                <div class="panel-body">
                    <div class="col-lg-12 ">
                        <form role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>اسم</label>
                                <input type="text" name="name" value="<?php echo $name ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>الوصف</label>
                                <textarea class="form-control" rows="3" name="discription"><?php echo $discription ?></textarea>
                            </div>

                            <div class="form-group">
                                <label>الحالة</label>
                                <select name="status" class="form-control">
                                    <option value="0">غير فعال</option>
                                    <option value="1">فعال</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>صورة</label>
                                <input type="file" name="img">
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

</div>
</div>
</div>
<?php
include('include/footer.php');
?>