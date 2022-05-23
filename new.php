<?php
include('include/header.php');
$id = $_GET['id'];
if ($id && is_numeric($id)) {
    $stmt = $con->prepare('select * from news where status=1 and id=?');
    $stmt->execute(array($id));
    $new = $stmt->fetch();
    if ($new) { ?>
        <div class="container mt-5">
            <h2 class="text-center"><?php echo $new['title'] ?></h2>
            <div class="row">

                <div class="col-md-5 mt-5">
                    <p class="lead"><?php echo $new['discription'] ?></p>

                </div>
                <div class="col-md-5">

                    <img src="<?php echo $new['image'] ?>" width="250px">
                </div>
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
