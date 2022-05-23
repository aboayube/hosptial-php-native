<?php
$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {

  $email = $_POST['email'];
  $password = $_POST['password'];

  $hashpassword = sha1($password);




  $stmt = $con->prepare('select * from users where  email=? and password=? and status =1 ');
  $stmt->execute(array($email, $hashpassword));
  $user = $stmt->fetch();
  $count = $stmt->rowCount();
  $error = '';
  if ($count == 1) {
    $_SESSION['email'] = $email;
    $_SESSION['role'] = $user['role'];
    $_SESSION['id'] = $user['id'];

    $_SESSION['name'] = $user['name'];
    $_SESSION['image'] = $user['image'];

    $host  = $_SERVER['HTTP_HOST'];
    $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $extra = 'admin/index.php';
    header("Location: http://$host$uri/$extra");
  } else {
    $error = " هناك خطا ما يرجي اعادة المحاولة";
  }
}
?>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModalLabel">تسجيل الدخول</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">

          <?php

          if ($error) { ?>
            <div class="alert alert-danger text-center"><?php echo $error ?></div>

          <?php      }
          ?>
          <div class="form-group row">
            <label for="staticEmail" class="col-sm-2 col-form-label">ايميل</label>
            <div class="col-sm-10">
              <input type="email" name="email" class="form-control" id="email">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">كلمه السر</label>
            <div class="col-sm-10">
              <input type="password" name="password" class="form-control" id="inputPassword">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
            <input type="submit" class="btn btn-primary" name="login" value="دخول">

          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
<div class="text-center" style="background:#e3f8fc;padding-top:15px">
  <div class="row">
    <div class="col-md-4">
      <h2 class="text-center">خدماتنا</h2>
      <ul>
        <li>
          <a>شسيسيش</a>
        </li>
        <?php
        $stmt = $con->prepare('select * from department where status=1 limit 5');
        $stmt->execute();
        $dps = $stmt->fetchAll();
        foreach ($dps as $dp) { ?>

          <li> <a class="dropdown-item" href="department.php?id=<?php echo $dp['id'] ?>"><?php echo $dp['name'] ?></a>
          </li> <?php
              }
                ?>
      </ul>
    </div>
    <div class="col-md-4">
      <img src="img/<?php echo $setting['image'] ?>" width="150px" height="180px" style="margin-top: 12px;">
    </div>
    <div class="col-md-4">
      <h2>تواصل معنا</h2>
      <ul class="socialmedia">

        <li><a href="<?php echo $setting['facebook'] ?>"><?php echo $setting['name'] ?></a> <i class="fab fa-facebook fa-2x"></i>
        </li>

        <li><?php echo $setting['whatsApp'] ?> <i class="fab fa-whatsapp fa-2x"></i>
        </li>

        <li><?php echo $setting['phone'] ?> <i class="fas fa-phone fa-2x"></i>
        </li>

        <li><?php echo $setting['mobial'] ?> <i class="fas fa-mobile-alt fa-2x"></i>
        </li>


      </ul>

    </div>
  </div>



</div>
<script src="include/assets/jquery-3.5.1.slim.min.js"></script>
<script src="include/assets/bootstrap.bundle.min.js"></script>



</body>

</html>

<?php
ob_end_flush(); ?>