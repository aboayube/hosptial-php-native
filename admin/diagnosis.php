<?php include('include/header.php');

include('include/sidebar.php');

if ($_SESSION['role'] == 'docotor') {
    $stmt = $con->prepare('select 
    diagnosis.*,
    users.name as user_docotor,
    users.image as user_image
    FROM diagnosis
    INNER JOIN  users
    ON diagnosis.docotor_id = users.id
    where users.id=?
    
    
    ');
    $stmt->execute(array($_SESSION['id']));
} else {
    $stmt = $con->prepare('select 
diagnosis.*,
users.name as user_docotor,
users.image as user_image
FROM diagnosis
INNER JOIN  users
ON diagnosis.docotor_id = users.id


');
    $stmt->execute();
}
$diagnosis = $stmt->fetchAll();

?>


<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="text-center">تشخيص الحالات </h1>

</div>

<div id="page-wrapper">

    <!-- /.row -->
    <div class="row  text-center">
        <div class="col-lg-12">
            <div class="panel panel-default">

                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>رقم</th>
                                    <th>الطبيب</th>
                                    <th>المريض</th>
                                    <th> عمر المريض</th>
                                    <th> رقم جوال المريض</th>
                                    <th>الفحص</th>
                                    <th> التحاليل</th>
                                    <th> العلاج</th>
                                    <th> الملف</th>
                                    <th>الموعد </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($diagnosis as $diagnos) {
                                ?>
                                    <tr class="gradeC">
                                        <td><?php echo $diagnos['id'] ?></td>
                                        <td><?php echo $diagnos['user_docotor'] ?></td>

                                        <td class="center"><?php echo $diagnos['user_name'] ?></td>
                                        <td class="center"><?php echo $diagnos['age'] ?></td>
                                        <td class="center"><?php echo $diagnos['mobile'] ?></td>
                                        <td class="center"><?php echo $diagnos['checkup'] ?></td>
                                        <td class="center"><?php echo $diagnos['investigation'] ?></td>
                                        <td class="center"><?php echo $diagnos['treatment'] ?></td>
                                        <td class="center">ملف التحاليل</td>

                                        <td class="center"><?php echo date('Y-m-d', $diagnos['time']) ?></td>

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