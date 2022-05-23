<?php
include('include/header.php');
$id=$_GET['id'];
if($id && is_numeric($id)){
    $stmt=$con->prepare("select * from products where id=? limit 1");
    $stmt->execute(array($id));
    $count=$stmt->rowCount();
if($count>0){
    $product=$stmt->fetch();
 






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
    $total_count_en='';
    $countity_en='';
    $errors=[];
if($_SERVER['REQUEST_METHOD']=='POST'){
    $title=$_POST['title'];
    $discription=$_POST['discription'];
    $content=$_POST['content'];
    $status=$_POST['status'];
    $total_count=$_POST['total_count'];
    $price=$_POST['price'];
    $countity=$_POST['countity'];
    $countity_en=$_POST['countity_en'];

   
    //en
    $title_en=$_POST['title_en'];
    $discription_en=$_POST['discription_en'];
    $content_en=$_POST['content_en'];
    $total_count_en=$_POST['total_count_en'];
    $price_en=$_POST['price_en'];
    $total_count_en=$_POST['total_count_en'];

    
    if(empty($title)){
    
        $errors[]=' يجيب ان تدخل  عنوان ';
    } if(empty($title_en)){
    
        $errors[]=' يجيب ان تدخل  عنوان ';
    }    if(empty($discription)){
    
        $errors[]=' يجيب ان تدخل  وصف ';
    }    if(empty($discription_en)){
    
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
$titleproduct=$con->prepare('select id from products where title= ? and id != ?');
$titleproduct->execute(array($title,$id));
if($titleproduct->rowCount()==1){

    $errors[]='عنوان  موجود ';
} 
if(empty($errors)){
    $imagename=$product['image'];
if($_FILES['img']['name']!='' ){
    print_r($_FILES['img']);
if(file_exists('../img/products/'.$product['image'])){
    unlink('../img/products/'.$product['image']);
}

$cv =time().'-'.$_FILES['img']['name'];
$imagename=$cv;
move_uploaded_file 	( $_FILES["img"]["tmp_name"], '../img/products/' . $cv );


}else{
    
    $imagename=$product['image'];
}

$stmt=$con->prepare('UPDATE `products` SET
 `title`=:ztitle,
 `discription`=:zdiscription,
 `content`=:zcontent,
 `total_count`=:ztotal,
 `image`=:zimage,
 `status`=:zstatus,
 `created_at`="dsaasd",
 `price`=:zprice,
 `countity`=:zcountity,

 `title_en`=:ztitle_en,
 `discription_en`=:zdiscription_en,
 `content_en`=:zcontent_en,
 `total_count_en`=:ztotal_en,
 `price_en`=:zprice_en,
 `countity_en`=:zcountity_en
 where id=:zid
 ' );

$stmt->execute(array(
    'ztitle'=> $title,
    'zdiscription'=>$discription,
    'zcontent'=>$content,
   'ztotal'=>$total_count,
    'zimage'=>  $imagename,
    'zstatus'=>  $status,
    'zprice'=>$price,
    'zcountity'=>$countity,

    
    'ztitle_en'=> $title_en,
    'zdiscription_en'=>$discription_en,
    'zcontent_en'=>$content_en,
   'ztotal_en'=>$total_count_en,
    'zprice_en'=>$price_en,
    'zcountity_en'=>$countity_en,
    'zid'=>$id));

    echo 'yes';
    header("Location:products.php?edit=1");
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
                    <h1 class="page-header text-center"><?php echo $product['title']?></h1>
                </div>
<img src="../img/products/<?php echo $product['image']?>" class="" style="margin-right:500px;" width="250px">
                <!-- /.col-lg-12 -->
                <?php
                
                if($errors){
                    foreach($errors as $error){
                        echo '<div class="alert alert-danger">'.$error.'</div>';
                    }
                }
                ?>
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
                                            <input class="form-control" name="title" value="<?php echo $product['title']?>">
                                        </div> </div>  <div class="col-md-6">  <div class="form-group">
                                            <label> en عنوان</label>
                                            <input class="form-control" name="title_en" value="<?php echo $product['title_en']?>">
                                        </div></div></div>

                                        <div class="row">
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label>وصف</label>
                                            
                                            <textarea class="form-control" name="discription"><?php echo $product['discription']?></textarea>
                                        </div> </div>
                                        
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label> en وصف</label>
                                            
                                            <textarea class="form-control" name="discription_en"><?php echo $product['discription_en']?></textarea>
                                        </div> </div></div>

                                        
                                        <div class="row">
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label>محتوي</label>
                                            <textarea class="form-control summernote" name="content"><?php echo $product['content']?>
                                            </textarea>  
                                        </div> </div>
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label>محتوي en</label>
                                            <textarea class="form-control summernote" name="content_en"><?php echo $product['content_en']?>
                                            </textarea>  
                                        </div>  </div>   </div> 


                                        <div class="row">
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label>كمية المتوافره</label>
                                            <input class="form-control" name="total_count" value="<?php echo $product['total_count']?>">
                                        </div>    </div> 
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label> en كمية المتوافره</label>
                                            <input class="form-control" name="total_count_en" value="<?php echo $product['total_count_en']?>">
                                        </div>    </div>    </div>
                                        
                                        
                                        <div class="row">
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label>  كمية الكلية</label>
                                            <input class="form-control" name="countity" value="<?php echo $product['countity']?>">
                                        </div>   </div> 
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label> en كمية الكلية</label>
                                            <input class="form-control" name="countity_en" value="<?php echo $product['countity_en']?>">
                                        </div> 
                                        </div>   </div> 


                                        <div class="row">
                                        <div class="col-md-6">
                                         <div class="form-group">
                                            <label>سعر</label>
                                            <input class="form-control" name="price" value="<?php echo $product['price']?>">
                                        </div> </div>
                                        <div class="col-md-6">
                                         <div class="form-group">
                                            <label>سعر en</label>
                                            <input class="form-control" name="price_en" value="<?php echo $product['price_en']?>">
                                        </div> </div> </div>



                                        <div class="form-group">
                                            <label>الحالة</label>  
                                               <select  name="status" class="form-control">
         <option value="0" <?php if($product['status']==0){echo 'selected';}?>>غير فعال</option>      
         <option value="1" <?php if($product['status']==1){echo 'selected';}?>>فعال</option>                       
</select>
                                        </div>
  
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




























<?php
}else{
    return header('Location:index.php');
}
}else{
    return header('Location:index.php');
}


?>
