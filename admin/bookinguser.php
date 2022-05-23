<?php include('include/header.php');

include('include/sidebar.php');

if ($_SESSION['role'] == 'docotor') {

    $stmt2 = $con->prepare("select clinic_id  from users where id =?");
    $stmt2->execute(array($_SESSION['id']));
    $user = $stmt2->fetch();
    $stmt = $con->prepare('select 
    users.name as user_name,
    users.age as user_age,
    clinics.name as clinics_name,
    docotor_clinic.id as docotor_clinic_id
    FROM docotor_clinic
    
    INNER JOIN  users
    ON docotor_clinic.user_id = users.id
    INNER JOIN  clinics
    ON clinics.id = docotor_clinic.clinic_id
    where docotor_clinic.clinic_id =?
    
    ');
    $stmt->execute(array($user['clinic_id']));
} else {
    $stmt = $con->prepare('select 
users.name as user_name,
users.age as user_age,
clinics.name as clinics_name,
docotor_clinic.id as docotor_clinic_id
FROM docotor_clinic

INNER JOIN  users
ON docotor_clinic.user_id = users.id
INNER JOIN  clinics
ON clinics.id = docotor_clinic.clinic_id


');
    $stmt->execute();
}
$diagnosis = $stmt->fetchAll();
?>


<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="text-center"> حجوزات المستخدمين </h1>

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
                                    <th>المريض</th>
                                    <th> عمر المريض</th>
                                    <th>القسم</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($diagnosis as $diagnos) {
                                ?>
                                    <tr class="gradeC">
                                        <td><?php echo $diagnos['docotor_clinic_id'] ?></td>
                                        <td><?php echo $diagnos['user_name'] ?></td>

                                        <td class="center"><?php echo $diagnos['user_age'] ?></td>

                                        <td class="center"><?php echo $diagnos['clinics_name'] ?></td>


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