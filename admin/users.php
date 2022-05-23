<?php include('include/header.php');

include('include/sidebar.php');
$stmt = $con->prepare('select * from users
   where id!=' . $_SESSION['id'] . ' and role="docotor" ORDER BY id DESC');
$stmt->execute();
$users = $stmt->fetchAll();

?>


<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="text-center">المستخدمين</h1>
</div>

<div id="page-wrapper">

    <!-- /.row -->
    <div class="row  text-center">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading"><a href="adduser.php" class="btn btn-info " style="    position: absolute;
    left: 226px;
    top: -39px;">add</a>
                </div>
                <?php
                if (isset($_GET['success'])) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">تم تعديل الحالة بنجاح <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button></div>';
                }
                if (isset($_GET['delete'])) {
                    echo '<div class="alert alert-danger  alert-dismissible fade show" role="alert">تم تعديل الحالة بنجاح<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button></div>';
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
                                    <th>اسم</th>
                                    <th>ايميل</th>
                                    <th>الجوال</th>
                                    <th>العياده</th>
                                    <th>الحالة</th>
                                    <th>اعدادات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($users as $user) {
                                ?>
                                    <tr class="gradeC">
                                        <td><?php echo $user['id'] ?></td>
                                        <td><img src="../img/users/<?php echo $user['image'] ?>" width="100px" height="100px"></td>
                                        <td><?php echo $user['name'] ?></td>
                                        <td><?php echo $user['email'] ?></td>
                                        <td><?php echo $user['mobial'] ?></td>
                                        <td><?php
                                            $stmt2 = $con->prepare('select * from clinics where id =?');
                                            $stmt2->execute(array($user['clinic_id']));
                                            $u = $stmt2->fetch();
                                            if (!empty($u)) {
                                                echo $u['name'];
                                            } ?></td>
                                        <td><?php echo $user['status'] ? 'فعال' : 'غير فعال' ?></td>



                                        <td class="center">

                                            <a class="btn btn-info" onClick="return confirm('هل انت متاكد من عملية الحذف?')" href="deleteuser.php?id=<?php echo $user['id'] ?>">تعديل الحاله</a>
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