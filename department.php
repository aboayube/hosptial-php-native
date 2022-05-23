<?php
include('include/header.php');
$id = $_GET['id'];
if ($id && is_numeric($id)) {
    $stmt = $con->prepare('select * from department where status=1 and id=?');
    $stmt->execute(array($id));
    $department = $stmt->fetch();
    if ($department) { ?>
        <div class="container mt-5  mb-2">
            <h2 class="text-center"><?php echo $department['name'] ?></h2>
            <div class="row">

                <div class="col-md-5 mt-5">
                    <p class="lead"><?php echo $department['discription'] ?></p>

                </div>
                <div class="col-md-5">

                    <img src="<?php echo $department['image'] ?>">
                </div>
            </div>
        </div>
        <!-- عيادات التابعة  للقسم -->
        <hr>
        <div class="container mb-5">
            <div class="row">
                <?php
                $stmt = $con->prepare('select * from clinics where department_id=?');
                $stmt->execute(array($department['id']));
                $datas = $stmt->fetchAll();
                if (!empty($datas)) {
                    foreach ($datas as $data) {
                ?>
                        <div class="col-md-3 text-center" style="border-right:2px solid #eee">

                            <img src="<?php echo $data['image'] ?>" width="150px" height="150px">
                            <h2><?php echo $data['name'] ?></h2>
                            <a href="clinics.php?id=<?php echo $data['id'] ?>" class="btn btn-primary text-center mr-2 mt-2">عرض اطباء</a>

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
