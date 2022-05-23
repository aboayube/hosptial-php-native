<?php
include('include/header.php');
$id = $_GET['id'];
if ($id && is_numeric($id)) {
    $stmt = $con->prepare('select * from clinics where status=1 and id=?');
    $stmt->execute(array($id));
    $clinic = $stmt->fetch();

    if ($clinic) { ?>
        <div class="container mt-5  mb-5">
            <h2 class="text-center"><?php echo $clinic['name'] ?></h2>
            <div class="row">

                <div class="col-md-5 mt-5">
                    <p class="lead"><?php echo $clinic['discription'] ?></p>
                    <a href="booking.php" class="btn btn-primary">حجز موعد</a>

                </div>
                <div class="col-md-5">

                    <img src="<?php echo $clinic['image'] ?>">
                </div>
            </div>
        </div>
        <!-- عيادات التابعة  للقسم -->
        <hr>
        <div class="container mb-5">
            <h2 class="text-center">الاطباء </h2>
            <div class="row">
                <?php
                $stmt = $con->prepare('select * from users where clinic_id =? and role="docotor"');
                $stmt->execute(array($clinic['id']));
                $docotors = $stmt->fetchAll();

                if (!empty($docotors)) {
                    foreach ($docotors as $docotor) {
                ?>
                        <div class="col-md-3 text-center" style="border-right:2px solid #eee">

                            <img src="img/users/<?php echo $docotor['image'] ?>" width="150px" height="150px">
                            <h2><?php echo $docotor['name'] ?></h2>
                            <a href="datadcotors.php?id=<?php echo  $docotor['id'] ?>" class="btn btn-primary text-center mr-2 mt-2">عرض مواعيد</a>

                        </div>

                <?php }
                } ?>
            </div>
        </div>

<?php
    } else {
        header("Location: index.php");
    }
}

?>
<?php
include('include/footer.php');
