<?php include('include/header.php');

include('include/sidebar.php');
$stmt=$con->prepare('select * from faq  ');
$stmt->execute();
$faqs=$stmt->fetchAll();

?>


<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="text-center">الاسئلة الشائعة </h1>

            </div>

<div id="page-wrapper">

            <!-- /.row -->
            <div class="row  text-center">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                 show users in website <a href="addfaq.php" class="btn btn-info " style="    position: absolute;
    left: 226px;
    top: -39px;">add</a><?php 
  
  if(isset($_GET['success'] )){ ?>
               <div class="alert alert-success text-center">تم العملية بنجاح</div>

<?php }?><?php 
  
  if(isset($_GET['delete'] )){ ?>
               <div class="alert alert-danger text-center">تم العملية بنجاح</div>

<?php }?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>رقم</th>
                                            <th>سؤال</th>
                                            <th>اعدادات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                <?php
                                foreach($faqs as $faq){
                                ?>
                                        <tr class="gradeC">
                                            <td><?php echo $faq['id']?></td>
                                            <td><?php echo $faq['question']?></td>
                                                <td class="center">
                                                <a href="editfaq.php?id=<?php echo $faq['id']?>" class="btn btn-success">تعديل</a>
                                                <a href="deletefaq.php?id=<?php echo $faq['id']?>" class="btn btn-danger">حذف</a>
                                            </td>
                                        </tr>
                                <?php }?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                           
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
<?php include('include/footer.php') ?>