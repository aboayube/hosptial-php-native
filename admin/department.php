<?php include('include/header.php');

include('include/sidebar.php');
$stmt = $con->prepare('select  * from department order by id desc');
$stmt->execute();
$departments = $stmt->fetchAll();

?>


<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="text-center">الاقسام </h1>

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
                <div class="panel-heading"><a href="adddepartment.php" class="btn btn-info " style="    position: absolute;
    left: 226px;
    top: -39px;">اضافة قسم جديد</a>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>رقم</th>
                                    <th>الصورة</th>
                                    <th> القسم اسم</th>
                                    <th>الوصف </th>
                                    <th> الحاله</th>
                                    <th>العيادات </th>
                                    <th>اعدادات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($departments as $department) {
                                ?>
                                    <tr class="gradeC">
                                        <td><?php echo $department['id'] ?></td>
                                        <td><img width="100px" height="100px" src="../<?php echo $department['image'] ?>"></td>
                                        <td><?php echo $department['name'] ?></td>
                                        <td class="center"><?php echo $department['discription'] ?></td>
                                        <td class="center"><?php echo $department['status'] == 1 ? 'فعال' : 'غير فعال' ?></td>

                                        <td class="center"><?php
                                                            $stmt2 = $con->prepare('SELECT * from clinics where department_id=?');
                                                            $stmt2->execute(array($department['id']));
                                                            $clins = $stmt2->fetchAll();
                                                            if ($clins) {
                                                                foreach ($clins as $clin) {
                                                                    echo $clin['name'] . '|';
                                                                }
                                                            }


                                                            ?></td>
                                        <td class="center">
                                            <a href="editdepartment.php?id=<?php echo $department['id'] ?>" class="btn btn-success">تعديل</a>
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