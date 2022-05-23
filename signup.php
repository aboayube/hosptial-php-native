<?php include('include/header.php');

if(isset($_SESSION['email'])){
header("Location:index.php"); 
}
 $name='';
 $email='';
 $mobial='';

if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['register'])){

    $name=$_POST['name'];
    $email=$_POST['email'];
    $mobial=$_POST['mobial'];
    $password=$_POST['password'];
    $copassword=$_POST['copassword'];




    $hashpassword=sha1($password);
$errors=[];
if(empty($name)){

    $errors[]=' يجيب ان تدخل  اسمك ';
}
if(empty($email)){
 $errors[]=' يجيب ان تدخل  ايميلك ';
}
if(empty($password)){
       $errors[]=' يجيب ان تدخل  كلمة السر ';     
  }
if($password != $copassword){
$errors[]=' يجيب ان تكون كلمة السر متطابقة ';
 }
    if(empty($_FILES['image'])){
        $errors[]='يجيب ان تدخل صورة الهوية';
    }else{
        if ($_FILES["image"]["size"] > 500000) {
            echo "يجيب ان يكون حجم منطقي";
           
          }
    }
    
//يتاكد ان مستخدم مش موجود
$user=$con->prepare('select id from users where name=? ');
$user->execute(array($name));
if($user->rowCount()==1){

    $errors[]='اسم مستخدم موجود ';
} 
//يتاكد ان مستخدم مش موجود
$emaildd=$con->prepare('select id from users where email= ? ');
$emaildd->execute(array($email));
if($emaildd->rowCount()==1){
    $errors[]='ايميل مستخدم موجود ';
}
    if(empty($errors)){
      
      $cv =time().'-'.$_FILES['image']['name'];
        $stmt=$con->prepare('insert into users 
        ( `email`, `name`, `password`, `image`,
         `status`, `discription`, 
         `mobial`) 
        VALUES
        (:zemail,:zname,:password,:zimage,0,"SADASD",:zmobial
       ) ');
        print_r($stmt);
     $stmt->execute(array(
            'zemail'=> $email,
            'zname'=>$name,
            'password'=>$hashpassword,
           'zimage'=>$cv,
            'zmobial'=>  $mobial,
           
          
     ));
     $coun=$con->lastInsertId();
	
       move_uploaded_file 	( $_FILES["image"]["tmp_name"], 'img/users/' . $cv );
 
        $count=$stmt->rowCount();
        if($count>0){
            $_SESSION['email']=$email;
            $_SESSION['role']='user';
            $_SESSION['name']=$name;
            $_SESSION['image']=$cv;
            $_SESSION['id']=$coun;

                 
$notif=$con->prepare('INSERT INTO `notification`
 (`title`, `type`, `userid`, `status`, 
 `image`, `body`, `url`, `title_en`, `body_en`) 
 VALUES 
("add new user","user","0","1","'.$cv.'",
"add user","","","") ');

 $notif->execute();


           $host  = $_SERVER['HTTP_HOST'];
         $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
           $extra = 'admin/index.php';
         header("Location: http://$host$uri/$extra");
  
        }

    }else{
        foreach($errors as $error){
            echo '<div class="alert alert-danger">'.$error.'</div>';
        }
    }
}

?>
<?php
if($lang=='ar'){?>

<style>
  .signup{
    margin-right: 220px;
  }
</style>

<?php }else{
?>
<style>
  .signup{
    margin-left: 260px;
  }
</style>


<?php }?>
<div class="container  text-center">
    <div class="row signup">
        <div class="text-center">
<h1><?php echo $data['register-title']?></h1>
<p class="alert alert-success"><?php echo $data['register-content']?></p>
        <form action="<?php $_SERVER['PHP_SELF']?>"  method="POST" enctype="multipart/form-data">
  <div class="form-group row">
    <label for="staticEmail" class="col-sm-2 col-form-label"><?php echo $data['register-name']?></label>
    <div class="col-sm-10">
      <input type="text" name="name" value="<?php echo $name?>"  class="form-control" id="staticEmail">
    </div>
  </div>
  <div class="form-group row">
    <label for="staticEmail" class="col-sm-2 col-form-label"><?php echo $data['register-email']?></label>
    <div class="col-sm-10">
      <input type="email" name="email" value="<?php echo $email?>"   class="form-control" id="staticEmail">
    </div>
  </div>
  <div class="form-group row">
    <label for="staticEmail" class="col-sm-2 col-form-label"><?php echo $data['register-password']?></label>
    <div class="col-sm-10">
      <input type="password" name="password"  class="form-control" id="staticEmail">
    </div>
  </div>
  <div class="form-group row">
    <label for="staticEmail" class="col-sm-2 col-form-label"><?php echo $data['register-copassword']?></label>
    <div class="col-sm-10">
      <input type="password" name="copassword"  class="form-control" id="staticEmail">
    </div>
  </div>
  <div class="form-group row">
    <label for="staticEmail" class="col-sm-2 col-form-label"><?php echo $data['register-phone']?></label>
    <div class="col-sm-10">
      <input type="number" name="mobial"  value="<?php echo $mobial?>"   class="form-control" id="staticEmail">
    </div>
  </div>
  <div class="form-group row">
    <label for="staticEmail" class="col-sm-2 col-form-label"><?php echo $data['register-image']?></label>
    <div class="col-sm-10">
      <input type="file" name="image">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-10">
        <input type="submit" name="register" value="<?php echo $data['register-send']?>" class="btn btn-success">
    </div>
  </div>
</form>
        </div>
        </div>
<?php include('include/footer.php')?>