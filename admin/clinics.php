<?php include('include/header.php');

include('include/sidebar.php');
$stmt = $con->prepare('select * from    clinics
        order by id  desc
');
$stmt->execute();
$clinics = $stmt->fetchAll();
?>


<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="text-center">العيادات </h1>

</div>
<?php


if (isset($_GET['delete']) && $_GET['delete'] = 1) {

    echo '<div class="text-center alert alert-danger alert-dismissible fade show" role="alert">تم عملية الحذف بنجاح  <a type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </a></div>';
} ?>

<div id="page-wrapper">

    <!-- /.row -->
    <div class="row  text-center">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="addclinics.php" class="btn btn-info " style="    position: absolute;
    left: 226px;
    top: -39px;">اضافة عيادة جديد</a>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>رقم</th>
                                    <th>الصورة</th>
                                    <th> العيادة </th>
                                    <th>الوصف </th>
                                    <th> الحاله</th>
                                    <th>القسم </th>
                                    <th> الاطباء</th>
                                    <th>اعدادات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($clinics as $clinic) {
                                ?>
                                    <tr class="gradeC">
                                        <td><?php echo $clinic['id'] ?></td>
                                        <td><img width="100px" height="100px" src="../<?php echo $clinic['image'] ?>"></td>
                                        <td><?php echo $clinic['name'] ?></td>
                                        <td class="center"><?php echo $clinic['discription'] ?></td>
                                        <td class="center"><?php echo $clinic['status'] == 1 ? 'فعال' : 'غير فعال' ?></td>
                                        <td class="center"><?php
                                                            $stmt = $con->prepare('select name from department where id=?');
                                                            $stmt->execute(array($clinic['department_id']));
                                                            $use = $stmt->fetch();
                                                            echo $use['name']


                                                            ?></td>
                                        <td class="center"><?php
                                                            $stmt2 = $con->prepare('select name from users where clinic_id =?');
                                                            $stmt2->execute(array($clinic['id']));
                                                            $users = $stmt2->fetchAll();
                                                            foreach ($users as $user) {
                                                                echo $user['name'] . "| ";
                                                            }
                                                            ?></td>
                                        <td class="center">
                                            <a href="editclinics.php?id=<?php echo $clinic['id'] ?>" class="btn btn-success">تعديل</a>
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