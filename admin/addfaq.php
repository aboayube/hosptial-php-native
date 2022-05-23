<?php
include('include/header.php');
include('include/sidebar.php');

$question='';
$answer='';
$question_en=''; $errors=[];
$answer_en='';
if($_SERVER['REQUEST_METHOD']=='POST'){
    $question=$_POST['question'];
    $answer=$_POST['answer'];
    $question_en=$_POST['question_en'];
    $answer_en=$_POST['answer_en'];
    $errors=[];
    if(empty($question)){
    
        $errors[]=' يجيب ان تدخل  عنوان ';
    }    if(empty($answer)){
    
        $errors[]=' يجيب ان تدخل  وصف ';
    }  if(empty($question_en)){
    
        $errors[]=' يجيب ان تدخل  عنوان ';
    }    if(empty($answer_en)){
    
        $errors[]=' يجيب ان تدخل  وصف ';
    }  
        
//يتاكد ان مستخدم مش موجود
$titleproduct=$con->prepare('select id from faq where question	= ? ');
$titleproduct->execute(array($question));
if($titleproduct->rowCount()==1){

    $errors[]='عنوان  موجود ';
} 

if(empty($errors)){
    $stmt=$con->prepare('insert into faq 
    ( `question`, `answer`,`question_en`,`answer_en`)
    VALUES
    (:zquestion,:zanswer,:zquestion_en,:zanswer_en
   ) ');

 $stmt->execute(array(
        'zquestion'=> $question,
        'zanswer'=>$answer,
        'zquestion_en'=> $question_en,
        'zanswer_en'=>$answer_en,

 ));
    
    $count=$con->lastInsertId();

$faq=$con->prepare('INSERT INTO `notification`
(`title`, `type`, `userid`, `status`, `image`, `body`, `url`, `title_en`, `body_en`)
 VALUES (:ztitle,"faq",:zuserid,:zstatus,"img/notifications/faq.png",
 :zbody,"faq.php",:title_en,:zbody_en)');
 $faq->execute(array(
     'ztitle'=>$question,
     'zuserid'=>$_SESSION['id'],
     'zstatus'=>'1',
     'zbody'=>$answer,
     'title_en'=>$question_en,
     'zbody_en'=>$answer_en,
 ));



echo '<div class="alert alert-success">تم اضافة بنجاح</div>';
header("Location:faq.php?success=1");
exit;
}else{
  
}

}








?>
<style>
form,.page-header{
    margin-right: 300px;
}
.form-control{
    width: 370px;
}
</style>
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header text-center">اضافة سؤال</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                     <?php
                       foreach($errors as $error){
                        echo  '<div class="alert alert-danger text-center mt-5" style="
                        width: 418px;
                        margin-right: 399px;">'.$error.'</div>';
                    }?>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12 ">
                                    <form role="form" action="<?php $_SERVER['PHP_SELF']?>" method="POST"  enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>سؤال</label>
                                            <input type="text" name="question" value="<?php echo $question?>" class="form-control" >
                                        </div>   <div class="form-group">
                                            <label> بلغه الانجليزية سؤال</label>
                                            <input type="text" name="question_en" value="<?php echo $question_en?>" class="form-control" >
                                        </div>
                                        <div class="form-group">
                                            <label>الاجابة</label>
                                            <textarea class="form-control" rows="3" name="answer"><?php echo $answer?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label> بلغة الانجليزية الاجابة</label>
                                            <textarea class="form-control" rows="3" name="answer_en"><?php echo $answer_en?></textarea>
                                        </div>
                                      
                         
                                      
                                        </div>
                                   
                                   
                                  
                                      
                                        <button type="submit" class="btn btn-info " style="margin-right:250px;margin-top:20px">دخول</button>
                                      
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