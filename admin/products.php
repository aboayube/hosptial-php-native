<?php include('include/header.php');

include('include/sidebar.php');
$stmt=$con->prepare('select * from PRODUCTS ORDER BY id DESC ');
$stmt->execute();
$users=$stmt->fetchAll();

?>


<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="text-center">المنتجات </h1>
               
</div>

<div id="page-wrapper">
           
            <!-- /.row -->
            <div class="row  text-center">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                  <a href="addproducts.php" class="btn btn-info " style="    position: absolute;
    left: 226px;
    top: -45px;">اضافة منتج</a>
    <br>
                        <?php
                        if(isset($_GET['success']) && $_GET['success']=1){

                          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">تم عملية بنجاح  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button></div>';  
                        }
                        if(isset($_GET['delete']) && $_GET['delete']=1){

                          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">تم عملية الحذف بنجاح  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button></div>';  
                        }
                        if(isset($_GET['edit']) && $_GET['edit']=1){

                          echo '<div class="alert alert-info alert-dismissible fade show" role="alert">تم عملية التعديل بنجاح  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button></div>';  
                        }

                        
                        ?>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>رقم</th>
                                            <th>صورة</th>
                                            <th>منتج</th>
                                            <th>وصف</th>
                                            <th>كمية المتوفرة</th>
                                            <th>الحالة</th>
                                            <th>اعدادات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                <?php
                                foreach($users as $user){
                                ?>
                                        <tr class="gradeC">
                                            <td><?php echo $user['id']?></td>
                                            <td><img src="../img/products/<?php echo $user['image']?>" width="100px" height="100px"></td>
                                            <td><?php echo $user['title']?></td>
                                            <td class="center"><?php echo $user['discription']?></td>
                                            <td class="center"><?php echo $user['total_count']?></td>
                                            <td class="center"><?php echo $user['status']==1?'فعال':'غير فعال' ?></td>
                                            <td class="center">
                                            <?php 

if($_SESSION['role']=='admin' || $_SESSION['id']==$user['user_id']){?>        <a href="editproducts.php?id=<?php echo $user['id']?>" class="btn btn-success">تعديل</a>

                                                <a href="deleteproduct.php?id=<?php echo $user['id']?>"  onClick="return confirm('هل انت متاكد من عملية الحذف?')"  class="btn btn-danger">حذف</a>
                               <?php }?>
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