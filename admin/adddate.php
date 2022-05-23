<?php
include('include/header.php');
include('include/sidebar.php');

$from_date = '';
$to_date = '';
$day = '';
$errors = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];
    $day = $_POST['day'];
    $docotor_id = $_POST['docotor_id'];
    if (empty($from_date)) {

        $errors[] = ' يجيب ان تدخل  عنوان ';
    }
    if (empty($to_date)) {

        $errors[] = ' يجيب ان تدخل  وصف ';
    }
    if (empty($day)) {

        $errors[] = ' يجيب ان تدخل  وصف ';
    }

    if (empty($docotor_id)) {

        $errors[] = ' يجيب ان تدخل  وصف ';
    }


    if (empty($errors)) {
        $stmt = $con->prepare('insert into booking 
    ( `from_date`, `to_date`, 
    `day`, `docotor_id`
    )
    VALUES
    (:zfrom_date,:zto_date,:zday,
    :zdocotor_id
   ) ');

        $stmt->execute(array(
            'zfrom_date' => $from_date,
            'zto_date' => $to_date,
            'zday' => 'img/news/' . $day,
            'zdocotor_id' =>  $docotor_id,


        ));

        $count = $stmt->rowCount();

        echo '<div class="alert alert-success">تم اضافة بنجاح</div>';
        header("Location:datedoctors.php?success=1");
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
            <h1 class="page-header text-center">اضافة موعد جديد</h1>
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
                        <form role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                            <div class="form-group">
                                <label>من الساعه</label>
                                <input type="text" name="from_date" value="<?php echo $from_date ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>الي ساعه</label>
                                <input type="text" name="to_date" value="<?php echo $to_date ?>" class="form-control">

                            </div>
                            <div class="form-group">
                                <label>اليوم</label>
                                <input type="text" name="day" value="<?php echo $day ?>" class="form-control">

                            </div>
                            <div class="form-group">
                                <label>الطبيب</label>
                                <select name="docotor_id" class="form-control">
                                    <?php
                                    $stmt = $con->prepare('select * from users where role="docotor"');
                                    $stmt->execute();
                                    $users = $stmt->fetchAll();
                                    foreach ($users as $user) { ?>

                                        <option value="<?php echo $user['id'] ?>"><?php echo $user['name'] ?></option>

                                    <?php

                                    }
                                    ?>
                                </select>
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