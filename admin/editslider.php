<?php
include('include/header.php');
$id=$_GET['id'];
if($id && is_numeric($id)){
    $stmt=$con->prepare("select * from slider where id=? limit 1");
    $stmt->execute(array($id));
    $count=$stmt->rowCount();
if($count>0){
    $slider=$stmt->fetch();
 






    $title='';
    $discription='';

    $title_en='';
    $discription_en='';
    $errors=[];
if($_SERVER['REQUEST_METHOD']=='POST'){
    $title=$_POST['title'];
    $discription=$_POST['discription'];
    //en
    $title_en=$_POST['title_en'];
    $discription_en=$_POST['discription_en'];
    
    if(empty($title)){
    
        $errors[]=' يجيب ان تدخل  عنوان ';
    } if(empty($title_en)){
    
        $errors[]=' يجيب ان تدخل  عنوان ';
    }    if(empty($discription)){
    
        $errors[]=' يجيب ان تدخل  وصف ';
    }    if(empty($discription_en)){
    
        $errors[]=' يجيب ان تدخل  وصف ';
    } 


if(empty($errors)){
    $imagename=$slider['image'];
if($_FILES['img']['name']!='' ){
    print_r($_FILES['img']);
if(file_exists('../img/sliders/'.$slider['image'])){
    unlink('../img/sliders/'.$slider['image']);
}

$cv =time().'-'.$_FILES['img']['name'];
$imagename=$cv;
move_uploaded_file 	( $_FILES["img"]["tmp_name"], '../img/sliders/' . $cv );


}else{
    
    $imagename=$slider['image'];
}

$stmt=$con->prepare('UPDATE `slider` SET
 `title`=:ztitle,
 `discription`=:zdiscription,
 `image`=:zimage,
 `title_en`=:ztitle_en,
 `discription_en`=:zdiscription_en
 where id=:zid
 ' );
 print_r($stmt);
$stmt->execute(array(
    'ztitle'=> $title,
    'zdiscription'=>$discription,
    
    'zimage'=>  $imagename,
  
    
    'ztitle_en'=> $title_en,
    'zdiscription_en'=>$discription_en,
    
    'zid'=>$id));


    header("Location:slider.php?edit=1");
}

}





include('include/sidebar.php');?>
<link rel="stylesheet" href="js/summernote/summernote-bs4.min.css">

<style>
form,.page-header{
    margin-right: 20px;
}
.form-control{
    width: 370px;
}
</style>
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header text-center"><?php echo $slider['title']?></h1>
                    <?php
                
                if($errors){
                    foreach($errors as $error){
                        echo '<div class="text-center alert alert-danger">'.$error.'</div>';
                    }
                }
                ?>    </div>
<img src="../img/sliders/<?php echo $slider['image']?>" class="" style="margin-right:500px;" width="250px">
                <!-- /.col-lg-12 -->
             
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                     
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12 ">
                                    <form role="form"  action="<?php $_SERVER['PHP_SELF']?>" method="POST"  enctype="multipart/form-data" >
                                    <div class="row">  
                                        <div class="col-md-6">
                                    <div class="form-group">
                                            <label>عنوان</label>
                                            <input class="form-control" name="title" value="<?php echo $slider['title']?>">
                                        </div> </div>  <div class="col-md-6">  <div class="form-group">
                                            <label> en عنوان</label>
                                            <input class="form-control" name="title_en" value="<?php echo $slider['title_en']?>">
                                        </div></div></div>

                                        <div class="row">
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label>وصف</label>
                                            
                                            <textarea class="form-control" name="discription"><?php echo $slider['discription']?></textarea>
                                        </div> </div>
                                        
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label> en وصف</label>
                                            
                                            <textarea class="form-control" name="discription_en"><?php echo $slider['discription_en']?></textarea>
                                        </div> </div></div>




  
                                        <div class="form-group">
                                            <label>صورة شخصية</label>
                                            <input type="file" name="img">
                                        </div>
                                      
                                        </div>
                             
                                  
                                      
                                        <button type="submit" class="btn btn-info " style="margin-right:250px;margin-top:20px">Submit Button</button>
                                      
                                    </form>
                                </div>
                               
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
   
            </div>     </div>     </div>
<?php
include('include/footer.php');
?>




























<?php
}else{
    return header('Location:index.php');
}
}else{
    return header('Location:index.php');
}


?>
