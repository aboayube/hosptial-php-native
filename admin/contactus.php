<?php include('include/header.php');

include('include/sidebar.php');
$stmt = $con->prepare('select 
clinics.*,
users.name as user_name
FROM clinics
        INNER JOIN  users
        ON clinics.docotor_id = users.id
');
$stmt->execute();
$clinics = $stmt->fetchAll();

?>


<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="text-center">طلبات تواصل من قبل الزوار </h1>

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
                    show users in website
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
                                        <td><img src="../img/clinic/<?php echo $clinic['name'] ?>"></td>
                                        <td><?php echo $clinic['name'] ?></td>
                                        <td class="center"><?php echo $clinic['discription'] ?></td>
                                        <td class="center"><?php foreach ($clinics as $da) {
                                                                echo $da['user_name'] . "| ";
                                                            } ?></td>
                                        <td class="center">
                                            <a href="editcontacuts.php?id=<?php echo $clinic['id'] ?>" class="btn btn-danger">حذف</a>
                                            <a onClick="return confirm('هل انت متاكد من عملية الحذف?')" href="deletecontacuts.php?id=<?php echo $clinic['id'] ?>" class="btn btn-danger">حذف</a>
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