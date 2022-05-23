<?php
include('include/header.php');
$stmt = $con->prepare("select * from setting where id=1 limit 1");
$stmt->execute();
$count = $stmt->rowCount();


if ($count > 0) {
    $setting = $stmt->fetch();







    $name = '';
    $discription = '';
    $facebook = '';
    $whatsApp = '';
    $phone = '';
    $mobial = '';
    $success = "";
    $errors = [];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $discription = $_POST['discription'];
        $facebook = $_POST['facebook'];
        $whatsApp = $_POST['whatsApp'];
        $phone = $_POST['phone'];
        $mobial = $_POST['mobial'];
        if (empty($name)) {

            $errors[] = ' يجيب ان تدخل  عنوان ';
        }
        if (empty($discription)) {

            $errors[] = ' يجيب ان تدخل  وصف ';
        }
        if (empty($whatsApp)) {

            $errors[] = ' يجيب ان تدخل  عنوان ';
        }
        if (empty($phone)) {

            $errors[] = ' يجيب ان تدخل  محتوي ';
        }
        if (empty($facebook)) {

            $errors[] = ' يجيب ان تدخل  كمية ';
        }
        if (empty($mobial)) {

            $errors[] = ' يجيب ان تدخل  كمية ';
        }



        if (empty($errors)) {
            $imagename = $setting['image'];
            if ($_FILES['img']['name'] != '') {
                if (file_exists('../img/' . $setting['image'])) {
                    unlink('../img/' . $setting['image']);
                }
                $cv = time() . '-' . $_FILES['img']['name'];
                $imagename = $cv;
                move_uploaded_file($_FILES["img"]["tmp_name"], '../img/' . $cv);
            }

            $stmt = $con->prepare('UPDATE `setting` SET
 `name`=:zname,
 `discription`=:zdiscription,
 `facebook`=:zfacebook,
 `whatsApp`=:zwhatsApp,
 `image`=:zimage,
 `phone`=:zphone,
 `mobial`=:zmobial
 where id=1
 ');
            $stmt->execute(array(
                'zname' => $name,
                'zdiscription' => $discription,
                'zfacebook' => $facebook,
                'zwhatsApp' => $whatsApp,
                'zimage' =>  $imagename,
                'zphone' =>  $phone,
                ':zmobial' => $mobial
            ));
            $success = 1;
            header("Refresh:1");
        }
    }





    include('include/sidebar.php'); ?>
    <style>
        form,
        .page-header {
            margin-right: 20px;
        }

        .form-control {
            width: 370px;
        }
    </style>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header text-center"><?php echo $setting['name'] ?></h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <?php
                    if ($success) {
                        echo '<div class="alert alert-success text-center alert-dismissible fade show text-center " role="alert">تم تعديل بنجاح<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button></div>';
                    }
                    if ($errors) {
                        foreach ($errors as $error) {

                            echo '<div class="text-center alert alert-danger alert-dismissible fade show" role="alert">' . $error . '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button></div>';
                        }
                    }

                    ?>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6 ">
                                <form role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>اسم</label>
                                        <input class="form-control" name="name" value="<?php echo $setting['name'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>وصف</label>
                                        <textarea class="form-control" name="discription"><?php echo $setting['discription'] ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>فيس بوك</label>
                                        <input class="form-control" name="facebook" value="<?php echo $setting['facebook'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label> واتس اب</label>
                                        <input class="form-control" name="whatsApp" value="<?php echo $setting['whatsApp'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>رقم الهاتف</label>
                                        <input class="form-control" name="phone" value="<?php echo $setting['phone'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>رقم الجوال</label>
                                        <input class="form-control" name="mobial" value="<?php echo $setting['mobial'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>شعار الموقع </label>
                                        <input type="file" name="img">
                                    </div>

                            </div>


                            <div class="col-lg-6 ">
                                <img src="../img/<?php echo $setting['image'] ?>" class="" width="420px">


                            </div>


                            <button type="submit" class="btn btn-info " style="margin-right:250px;margin-top:20px">تعديل</button>

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


?>