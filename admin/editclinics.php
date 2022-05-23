<?php
include('include/header.php');
$id = $_GET['id'];
if ($id && is_numeric($id)) {
    $stmt = $con->prepare("select * from clinics where id=? limit 1");
    $stmt->execute(array($id));
    $count = $stmt->rowCount();
    if ($count > 0) {
        $clinic = $stmt->fetch();
        $name = '';
        $discription = '';
        $status = '';
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $discription = $_POST['discription'];

            if (empty($name)) {

                $errors[] = ' يجيب ان تدخل  عنوان ';
            }
            if (empty($discription)) {

                $errors[] = ' يجيب ان تدخل  وصف ';
            }
            if (empty($errors)) {
                $imagename = $clinic['image'];
                if ($_FILES['img']['name'] != '') {
                    if (file_exists($clinic['image'])) {
                        unlink($clinic['image']);
                    }
                    $cv = time() . '-' . $_FILES['img']['name'];
                    $imagename = 'img/clinic/' . $cv;


                    move_uploaded_file($_FILES["img"]["tmp_name"], '../img/clinic/' . $cv);
                } else {

                    $imagename = $clinic['image'];
                }

                $stmt = $con->prepare('UPDATE `clinics` SET
 `name`=:zname,
 `discription`=:zdiscription,
 `image`=:zimage,
 `status`=:zstatus
 where id=:zid
 ');
                $stmt->execute(array(
                    'zname' => $name,
                    'zdiscription' => $discription,

                    'zimage' =>  $imagename,
                    'zstatus' => $status,
                    'zid' => $id
                ));

                header("Location:clinics.php");
            }
        }





        include('include/sidebar.php'); ?>
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
                    <h1 class="page-header text-center">تعديل اشعار</h1>
                </div> <img class="text-center" src="../<?php echo $clinic['image'] ?>" width="180px" height="140px" style="margin-right:540px">

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
                            <div class="row">
                                <div class="col-lg-6 ">
                                    <form role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>عنوان</label>
                                            <input type="text" name="name" value="<?php echo $clinic['name'] ?>" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>الوصف</label>
                                            <textarea class="form-control" rows="3" name="discription"><?php echo $clinic['discription'] ?></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label>صورة</label>
                                            <input type="file" name="img">
                                        </div>

                                        <div class="form-group">
                                            <label>الحالة</label>
                                            <select name="status" class="form-control">
                                                <option value="0" <?php if ($clinic['status'] == 0) {
                                                                        echo 'selected';
                                                                    } ?>>غير فعال</option>
                                                <option value="1" <?php if ($clinic['status'] == 1) {
                                                                        echo 'selected';
                                                                    } ?>>فعال</option>
                                            </select>
                                        </div>

                                </div>
                            </div>
                            <button type="submit" class="btn btn-info" style="margin-right:250px;margin-top:20px">Submit Button</button>

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




























<?php
    } else {
        return header('Location:index.php');
    }
} else {
    return header('Location:index.php');
}


?>