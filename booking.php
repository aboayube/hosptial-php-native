<?php
include("include/header.php");

$name = '';
$mobial = '';
$age = '';
$email = '';
$succes;
$errors = [];
if (isset($_POST['contacutus'])) {
    $name = $_POST['name'];
    $mobial = $_POST['mobial'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $clinics_id  = $_POST['clinics_id'];

    if (empty($name)) {

        $errors[] = ' يجيب ان تدخل  اسم ';
    }
    if (empty($mobial)) {

        $errors[] = ' يجيب ان تدخل  رقم الجوال ';
    }
    if (empty($age)) {

        $errors[] = ' يجيب ان تدخل  عمر ';
    }
    if (empty($email)) {

        $errors[] = ' يجيب ان تدخل  ايميل ';
    }
    if (empty($errors)) {
        $stmt = $con->prepare('insert into users 
        ( `name`, `mobial`, `age`,
        `email`)
        VALUES
        (:zname,:zmobial,:zage,:zemail)');

        $stmt->execute(array(
            'zname' => $name,
            'zemail' => $email,
            'zage' =>  $age,
            'zmobial' =>  $mobial,

        ));
        $stmt = $con->prepare("select id from users  order by id  desc limit 1");
        $stmt->execute();
        $id = $stmt->fetch();
        $stmt = $con->prepare("insert docotor_clinic (user_id,clinic_id) values(:zuser,:zclinic)");
        $stmt->execute(array(
            'zuser' => $id['id'],
            'zclinic' => $clinics_id,
        ));

$succes='<div class="alert alert-success text-center">تم اضافة بنجاح</div>';
        $email = '';
        $name = '';
        $message = '';
        $mobial = '';
    }
}
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- Team -->
<section id="team" class="pb-5">


    <div class="container pt-5">
        <h5 class="h1 text-center"> موعد حجز</h5>
        <?php if( isset($succes)){echo $succes;}?>
        <?php


        foreach ($errors as $error) {
            echo '<div class="alert alert-danger text-center">' . $error . '</div>';
        }

        ?>
        <div class="row">
            <div class="col-md-12">
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">

                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">اسم</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" aria-describedby="emailHelp" name="name" value="<?php echo $name ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">رقم الهاتف</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" aria-describedby="emailHelp" name="mobial" value="<?php echo $mobial ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">العمر</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" aria-describedby="emailHelp" name="age" value="<?php echo $age ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">ايميل</label>
                        <div class="col-sm-10">
                            <input type="TEXT" class="form-control" aria-describedby="emailHelp" name="email" value="<?php echo $email ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">العياده</label>
                        <div class="col-sm-10">
                            <select class="form-control form-control-lg" name="clinics_id">
                                <?php
                                $stmt = $con->prepare("select * from clinics ");
                                $stmt->execute();
                                $cls = $stmt->fetchAll();
                                foreach ($cls as $cl) { ?>
                                    <option value="<?php echo $cl['id'] ?>"><?php echo $cl['name'] ?></option>

                                <?php }

                                ?>

                            </select>
                        </div>
                    </div>

                    <div class="button">
                        <input type="submit" name="contacutus" class="btn btn-info" value="ارسال">
                    </div>
                </form>


            </div>

        </div>
    </div>
    </div>
    </div>
    </div>
    </div>


    </div>
    </div>
</section>

<?php
include("include/footer.php") ?>