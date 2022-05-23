<?php
include('include/header.php');
$id = $_GET['id'];
if ($id && is_numeric($id)) {
    $stmt = $con->prepare('select * from users where id=? and role="docotor" ');
    $stmt->execute(array($id));
    $clinic = $stmt->fetch();
    if ($clinic) { ?>
        <div class="container mt-5 mb-5">
            <h2 class="text-center"><?php echo $clinic['name'] ?></h2>
            <div class="row">

                <div class="col-md-5 mt-5">
                    <p class="lead"><?php echo $clinic['discription'] ?></p>
                    <button class="btn btn-primary">حجز موعد</button>
                </div>
                <div class="col-md-5">

                    <img src="img/users/<?php echo $clinic['image'] ?>" height="340px">
                </div>
            </div>
        </div>
        <h1 CLASS="text-center mt-4">مواعيد</h1>
        <div class="container">
            <?php

            $stmt = $con->prepare('select * from booking where docotor_id=? and status=1');
            $stmt->execute(array($clinic["id"]));
            $datas = $stmt->fetchAll(); ?>
            <table class="table mt-4 table-sm table-info  table-bordered text-center table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">يوم</th>
                        <th scope="col">من ساعه</th>
                        <th scope="col">الي ساعه</th>
                    </tr>
                </thead>

                <?php
                foreach ($datas as $data) { ?>
                    <tbody>
                        <tr>
                            <th scope="row"><?php echo $data['id'] ?></th>
                            <td><?php echo $data['day'] ?></td>
                            <td><?php echo $data['from_date'] ?></td>
                            <td><?php echo $data['to_date'] ?></td>
                        </tr>
                    </tbody>

                <?php
                }
                ?>
            </table>

        </div>
<?php
    } else {
        header("Location: index.php");
    }
}

?>
<?php
include('include/footer.php');
