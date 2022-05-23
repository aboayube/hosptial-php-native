<?php
include('include/header.php');
include('include/sidebar.php');

$title='';
$discription='';
$content='';
$total_count='';
$price='';

$title_en='';
$discription_en='';
$content_en='';
$total_count_en='';
$price_en='';
$countity='';
$countity_en	='';
$errors=[];
if($_SERVER['REQUEST_METHOD']=='POST'){
    $title=$_POST['title'];
    $discription=$_POST['discription'];
    $content=$_POST['content'];
    $status=$_POST['status'];
    $total_count=$_POST['total_count'];
    $price=$_POST['price'];
    $countity=$_POST['countity'];
    //en
    
    $title_en=$_POST['title_en'];
    $discription_en=$_POST['discription_en'];
    $content_en=$_POST['content_en'];
    $total_count_en=$_POST['total_count_en'];
    $price_en=$_POST['price_en'];
    $countity_en=$_POST['countity_en'];
    
    if(empty($title)){
    
        $errors[]=' يجيب ان تدخل  عنوان ';
    }    if(empty($title_en)){
    
        $errors[]=' يجيب ان تدخل  عنوان ';
    }    if(empty($discription)){
    
        $errors[]=' يجيب ان تدخل  وصف ';
    }  if(empty($discription_en)){
    
        $errors[]=' يجيب ان تدخل  وصف ';
    }   if(empty($content)){
    
        $errors[]=' يجيب ان تدخل  محتوي ';
    } if(empty($content_en)){
    
        $errors[]=' يجيب ان تدخل  محتوي ';
    }if(empty($total_count)){
    
        $errors[]=' يجيب ان تدخل  كمية ';
    }if(empty($total_count_en)){
    
        $errors[]=' يجيب ان تدخل  كمية ';
    }if(empty($price)){
    
        $errors[]=' يجيب ان تدخل  كمية ';
    }if(empty($price_en)){
    
        $errors[]=' يجيب ان تدخل  كمية ';
    }if(empty($countity)){
    
        $errors[]=' يجيب ان تدخل  كمية ';
    }if(empty($countity_en)){
    
        $errors[]=' يجيب ان تدخل  كمية ';
    }


        
//يتاكد ان مستخدم مش موجود
$titleproduct=$con->prepare('select id from products where title= ? ');
$titleproduct->execute(array($title));
if($titleproduct->rowCount()==1){

    $errors[]='عنوان  موجود ';
} 

if(empty($errors)){
    $product=$con->prepare('insert into products 
    ( `title`, `discription`, `content`, `total_count`, 
    `image`, `status`,`price`,`user_id`,
    `title_en`,`discription_en`,`content_en`,`price_en`,
    `total_count_en`,`countity`,`countity_en`)
    VALUES
    (:ztitle,:zdiscription,:zcontent,:ztotal_count,:zimage,
    :zstatus,:zprice,:zuser_id,:ztitle_en,:zdiscription_en,
    :zcontent_en,:zprice_en,:ztotal_count_en,:zcountity,
    :zcountity_en
   ) ');
    $cv =time().'-'.$_FILES['img']['name'];

 $product->execute(array(
        'ztitle'=> $title,
        'zdiscription'=>$discription,
        'zcontent'=>$content,
       'ztotal_count'=>$total_count,
        'zimage'=>  $cv,
        'zstatus'=>  $status,
        'zprice'=>$price,
        'zuser_id'=>$_SESSION['id'],
        'ztitle_en'=>$title_en,
        'zdiscription_en'=>$discription_en,
        'zcontent_en'=>$content_en,
        'zprice_en'=>$price_en,
        'ztotal_count_en'=>$total_count_en,
        'zcountity'=>$countity,
        'zcountity_en'=>$countity_en,

 ));

   move_uploaded_file 	( $_FILES["img"]["tmp_name"], '../img/products/' . $cv );
  
    $count=$con->lastInsertId();

$data='product.php?id='.$count;

 
// add notifiication
$stmt=$con->prepare('insert into notification 
(`title`, `type`, `userid`, `status`, `image`, `body`, 
`url`, `title_en`, `body_en`) VALUES 
("'.$title.'","منتج",'.$_SESSION['id'].','.$status.',
"'.'img/products/'.$cv.'","'.$discription.'","da","'.$title_en.'","'.$discription_en.'")');
echo $title.' - '.$_SESSION['id'].' - '.$status.' - '.$cv.' - '.$discription.' - '.$title_en.' - '.$discription_en;
$stmt->execute(array(
));

   move_uploaded_file 	( $_FILES["img"]["tmp_name"], '../img/notifications/' . $cv );



header("Location:products.php?success=1");
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
                    <h1 class="page-header text-center">اضافة منتج</h1>
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
                                            <label>المحتوي</label>
                                            <textarea class="form-control summernote" rows="3" name="content"><?php echo $content?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>الحالة</label>
                                            <select  name="status" class="form-control">
         <option value="0">غير فعال</option>      
         <option value="1">فعال</option>                       
</select>
                                        </div>
                                        <div class="form-group">
                                            <label>الكمية</label>
                                            <input class="form-control" name="total_count" value="<?php echo $total_count?>"  placeholder="Enter text">
                                        </div>
                                        <div class="form-group">
                                            <label> الكلية الكمية</label>
                                            <input class="form-control" name="countity" value="<?php echo $countity?>"  placeholder="Enter text">
                                        </div>
                                        <div class="form-group">
                                            <label>سعر</label>
                                            <input class="form-control" name="price" value="<?php echo $price?>"  placeholder="Enter text">
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
                                        <div class="form-group">
                                            <label>المحتوي</label>
                                            <textarea class="form-control summernote" rows="3" name="content_en"><?php echo $content_en?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>الكمية</label>
                                            <input class="form-control" name="total_count_en" value="<?php echo $total_count_en?>"  placeholder="Enter text">
                                        </div>
                                        <div class="form-group">
                                            <label> الكلية الكمية</label>
                                            <input class="form-control" name="countity_en" value="<?php echo $countity_en?>"  placeholder="Enter text">
                                        </div>
                                        <div class="form-group">
                                            <label>سعر</label>
                                            <input class="form-control" name="price_en" value="<?php echo $price_en?>"  placeholder="Enter text">
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