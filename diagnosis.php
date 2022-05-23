<?php
include("include/header.php");

if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
  header("Location:index.php");
}

$user_name = '';
$checkup = '';
$investigation = '';
$treatment = '';
$age = '';
$mobial = '';
$message = '';
$errors = [];
$success='';
if (isset($_POST['contacutus'])) {
  $user_name = $_POST['user_name'];
  $checkup = $_POST['checkup'];
  $investigation = $_POST['investigation'];
  $treatment = $_POST['treatment'];
  $age = $_POST['age'];
  $mobial = $_POST['mobial'];

  if (empty($user_name)) {

    $errors[] = ' يجيب ان تدخل  عنوان ';
  }
  if (empty($checkup)) {

    $errors[] = ' يجيب ان تدخل  محتوي ';
  }
  if (empty($mobial)) {

    $errors[] = ' يجيب ان تدخل  عنوان ';
  }
  if (empty($investigation)) {

    $errors[] = ' يجيب ان تدخل  محتوي ';
  }
  if (empty($age)) {

    $errors[] = ' يجيب ان تدخل  عنوان ';
  }
  if (empty($errors)) {
    $stmt = $con->prepare('insert into diagnosis 
        ( `user_name`, `docotor_id`, `checkup`, 
        `investigation`,`time`,`treatment`,`file`,`age`,`mobile`)
        VALUES
        (:zuser_name,:zdocotor_id,:zcheckup,:zinvestigation,:ztime,
        :ztreatment,:zfile,:zage,:zmobial)'); 
    $file = time() . '-' . $_FILES['img']['name'];

    $stmt->execute(array(
      'zuser_name' => $user_name,
      'zdocotor_id' => $_SESSION['id'],
      'zcheckup' => $checkup,
      'zinvestigation' =>  $investigation,
      'ztime' =>  time(),
      'ztreatment' =>  $treatment,
      'zfile' =>  $file,
      'zage' =>  $age,
      'zmobial' =>  $mobial,

    ));

    move_uploaded_file($_FILES["img"]["tmp_name"], 'img/diagnosis/' . $file);


    $success= '<div class="alert alert-success text-center">تم اضافة بنجاح</div>';
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
    <h5 class="h1 text-center">تشخيص جديد</h5>
    <?php


    foreach ($errors as $error) {
      echo '<div class="alert alert-danger text-center">' . $error . '</div>';
    }
if(isset($success)){
  echo $success;
}
    ?>
    <div class="row">
      <div class="col-md-12">
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">

          <div class="form-group row">
            <label for="staticEmail" class="col-sm-2 col-form-label">name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" aria-describedby="emailHelp" name="user_name" value="<?php echo $user_name ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="staticEmail" class="col-sm-2 col-form-label">age</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" aria-describedby="emailHelp" name="age" value="<?php echo $age ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="staticEmail" class="col-sm-2 col-form-label">mobial</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" aria-describedby="emailHelp" name="mobial" value="<?php echo $mobial ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="staticEmail" class="col-sm-2 col-form-label">فحص</label>
            <div class="col-sm-10">
              <input type="TEXT" class="form-control" aria-describedby="emailHelp" name="checkup" value="<?php echo $checkup ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="staticEmail" class="col-sm-2 col-form-label">investigation</label>
            <div class="col-sm-10">
              <input type="mobial" class="form-control" aria-describedby="emailHelp" placeholder="Enter your mobial" name="investigation" value="<?php echo $investigation ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="staticEmail" class="col-sm-2 col-form-label">treatment</label>
            <div class="col-sm-10">
              <textarea placeholder="Enter your message" class="form-control" name="treatment"><?php echo $treatment ?></textarea>
            </div>
          </div>

          <div class="form-group">
            <label>صورة</label>
            <input type="file" name="img">
          </div>
          <div class="button">
            <input type="submit" name="contacutus" class="btn btn-info" value="send">
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