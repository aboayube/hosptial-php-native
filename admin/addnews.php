<?php
include('include/header.php');
include('include/sidebar.php');

$title = '';
$discription = '';
$errors = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $discription = $_POST['discription'];
    $status = $_POST['status'];
    if (empty($title)) {

        $errors[] = ' يجيب ان تدخل  عنوان ';
    }
    if (empty($discription)) {

        $errors[] = ' يجيب ان تدخل  وصف ';
    }



    if (empty($errors)) {
        $stmt = $con->prepare('insert into news 
    ( `title`, `discription`, 
    `image`, `status`,`userid`
    )
    VALUES
    (:ztitle,:zdiscription,:zimage,
    :zstatus,:zuser_id
   ) ');
        $cv = time() . '-' . $_FILES['img']['name'];

        $stmt->execute(array(
            'ztitle' => $title,
            'zdiscription' => $discription,
            'zimage' => 'img/news/' . $cv,
            'zstatus' =>  $status,
            'zuser_id' => $_SESSION['id'],

        ));

        move_uploaded_file($_FILES["img"]["tmp_name"], '../img/news/' . $cv);

        $count = $stmt->rowCount();

        echo '<div class="alert alert-success">تم اضافة بنجاح</div>';
        header("Location:news.php?success=1");
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
            <h1 class="page-header text-center">اضافة خبر جديد</h1>
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
                                <label>عنوان</label>
                                <input type="text" name="title" value="<?php echo $title ?>" class="form-control">
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