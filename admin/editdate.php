<?php
include('include/header.php');
$id = $_GET['id'];
if ($id && is_numeric($id)) {
    $stmt = $con->prepare("select * from booking where id=? limit 1");
    $stmt->execute(array($id));
    $count = $stmt->rowCount();
    if ($count > 0) {
        $date = $stmt->fetch();







        $from_date = '';
        $to_date = '';
        $day = '';
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $from_date = $_POST['from_date'];
            $to_date = $_POST['to_date'];
            $day = $_POST['day'];
            if (empty($from_date)) {

                $errors[] = ' يجيب ان تدخل  عنوان ';
            }
            if (empty($to_date)) {

                $errors[] = ' يجيب ان تدخل  وصف ';
            }
            if (empty($day)) {

                $errors[] = ' يجيب ان تدخل  عنوان ';
            }

            if (empty($errors)) {




                $stmt = $con->prepare('UPDATE `booking` SET
 `from_date`=:zfrom_date,
 `to_date`=:zto_date,
 `day`=:zday
 where id=:zid
 ');
                $stmt->execute(array(
                    'zfrom_date' => $from_date,
                    'zto_date' => $to_date,
                    'zday' => $day,

                    'zid' => $id
                )); header("Location:datedoctors.php?success=1");
            }
        }
    }





    include('include/sidebar.php'); ?>
    <style>
        form,
        .page-header {
            margin-right: 200px;
        }

        .form-control {
            width: 370px;
        }
    </style>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header text-center">تعديل موعد الطبيب</h1>
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
                                        <label>من الساعه</label>
                                        <input type="text" name="from_date" value="<?php echo $date['from_date'] ?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>الي ساعه</label>
                                        <input type="text" name="to_date" value="<?php echo $date['to_date'] ?>" class="form-control">

                                    </div>
                                    <div class="form-group">
                                        <label>اليوم</label>
                                        <input type="text" name="day" value="<?php echo $date['day'] ?>" class="form-control">

                                    </div>


                            </div>


                            <div class="col-lg-6 ">


                            </div>

                            <input type="submit" value="add" />

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