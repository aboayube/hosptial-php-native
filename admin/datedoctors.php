<?php include('include/header.php');

include('include/sidebar.php');
if ($_SESSION['role'] == 'docotor') {
    $stmt = $con->prepare('select 
    booking.*,
    users.name as user_name,
    users.image as user_image
    FROM booking
    INNER JOIN  users
    ON booking.docotor_id = users.id
    where users.id=?
    
    
    ');
    $stmt->execute(array($_SESSION['id']));
} else {
    $stmt = $con->prepare('select 
    booking.*,
    users.name as user_name,
    users.image as user_image
    FROM booking
    INNER JOIN  users
    ON booking.docotor_id = users.id
    
    
    ');
    $stmt->execute();
}
$dates = $stmt->fetchAll();

?>


<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="text-center">مواعيد الاطباء </h1>

</div>

<div id="page-wrapper">

    <!-- /.row -->
    <div class="row  text-center">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading"><a href="adddate.php" class="btn btn-info " style="    position: absolute;
    left: 226px;
    top: -39px;">اضافة موعد جديد</a>
                </div>
                <?php
                if (isset($_GET['success']) && $_GET['success'] = 1) {

                    echo '<div class="alert alert-success">تم عملية بنجاح</div>';
                }
                if (isset($_GET['delete']) && $_GET['delete'] = 1) {

                    echo '<div class="alert alert-danger">تم عملية  حذف بنجاح</div>';
                }
                ?>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>رقم</th>
                                    <th>صورة</th>
                                    <th>الطبيب</th>
                                    <th>يوم</th>
                                    <th>الموعد من</th>
                                    <th>الموعد الي</th>
                                    <th>اعدادات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($dates as $date) {
                                ?>
                                    <tr class="gradeC">
                                        <td><?php echo $date['id'] ?></td>
                                        <td><img src="../img/users/<?php echo $date['user_image'] ?>" width="100px" height="100px"></td>

                                        <td class="center"><?php echo $date['user_name'] ?></td>
                                        <td class="center"><?php echo $date['day'] ?></td>
                                        <td class="center"><?php echo $date['from_date'] ?></td>
                                        <td class="center"><?php echo $date['to_date'] ?></td>

                                        <td class="center">

                                            <a href="editdate.php?id=<?php echo $date['id'] ?>" class="btn btn-success">تعديل</a>



                                            <a href="deletedate.php?id=<?php echo $date['id'] ?>" class="btn btn-danger">حذف</a>

                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
        <?php include('include/footer.php') ?>