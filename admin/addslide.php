<?php
include('include/header.php');
include('include/sidebar.php');

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
    }    if(empty($title_en)){
    
        $errors[]=' يجيب ان تدخل  عنوان ';
    }    if(empty($discription)){
    
        $errors[]=' يجيب ان تدخل  وصف ';
    }  if(empty($discription_en)){
    
        $errors[]=' يجيب ان تدخل  وصف ';
    }  

if(empty($errors)){
    $product=$con->prepare('insert into slider 
    ( `title`, `discription`, 
    `image`, `title_en`,`discription_en`)
    VALUES
    (:ztitle,:zdiscription,:zimage,:ztitle_en,:zdiscription_en
   ) ');
    $cv =time().'-'.$_FILES['img']['name'];

 $product->execute(array(
        'ztitle'=> $title,
        'zdiscription'=>$discription,
        'zimage'=>  $cv,
        'ztitle_en'=>$title_en,
        'zdiscription_en'=>$discription_en,
 ));

   move_uploaded_file 	( $_FILES["img"]["tmp_name"], '../img/sliders/' . $cv );
  
header("Location:slider.php?success=1");
exit;
}else{
}

}








?>
<link rel="stylesheet" href="js/summernote/summernote-bs4.min.css">
<style>
form,.page-header{
    margin-right: 50px;
}
.form-control{
    width: 370px;
}
</style>
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header text-center">اضافة قسم</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                     <?php
                     if($errors){
                        foreach($errors as $error){?>
                     
               <div class="alert alert-danger text-center"><?php echo $error?></div>    
                    <?php }}
                     ?>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6 ">
                                    <form role="form" action="<?php $_SERVER['PHP_SELF']?>" method="POST"  enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>عنوان</label>
                                            <input type="text" name="title" value="<?php echo $title?>" class="form-control" >
                                        </div>
                                        <div class="form-group">
                                            <label>الوصف</label>
                                            <textarea class="form-control" rows="3" name="discription"><?php echo $discription?></textarea>
                                        </div>
  
                                        <div class="form-group">
                                            <label>صورة</label>
                                            <input type="file" name="img">
                                        </div>
                                      
                                        </div>
                                        <!-- انجليزي -->
                                        <div class="col-lg-6 ">
                                   <div class="form-group">
                                            <label>عنوان بلغة انجليزية</label>
                                            <input type="text" name="title_en" value="<?php echo $title_en?>" class="form-control" >
                                        </div>
                                        <div class="form-group">
                                            <label>الوصف</label>
                                            <textarea class="form-control" rows="3" name="discription_en"><?php echo $discription_en?></textarea>
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
<script src="js/summernote/summernote-bs4.min.js"></script>
<script>
    
$(function () {
            $('.summernote').summernote({
                tabSize: 2,
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
});
</script>