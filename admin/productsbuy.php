<?php include('include/header.php');

include('include/sidebar.php');
$stmt=$con->prepare('SELECT 

buy_product.id as id,
buy_product.status as buystatus,
products.title as product_title,
products.image as product_image,
products.price as productsprice,
users.name as user_name
FROM buy_product
INNER JOIN  products
ON buy_product.producty_id  = products.id
INNER JOIN  users
ON buy_product.user_id  = users.id
where products.status=1
LIMIT 4 ');
$stmt->execute();
$buys=$stmt->fetchAll();


?>


<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="text-center">المنتجات التي تم شرائها </h1>
               
</div>

<div id="page-wrapper">
           
            <!-- /.row -->
            <div class="row  text-center">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                 show users in website 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>رقم</th>
                                            <th>منتج</th>
                                            <th>صورة</th>
                                            <th>اسم المستخدم</th>
                                            <th>سعر</th>
                                            <th>الحالة</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                <?php
                                foreach($buys as $buy){
                                ?>
                                
                                
                                user_name
                                        <tr class="gradeC">
                                            <td><?php echo $buy['id']?></td>
                                            <td><?php echo $buy['product_title']?></td>
                                            <td><img src="../img/products/<?php echo $buy['product_image']?>" width="150px" height="100px"></td>
                                            <td class="center"><?php echo $buy['user_name']?></td>
                                            <td class="center"><?php echo $buy['productsprice']?></td>
                                            <td class="center"><?php echo $buy['buystatus']?></td>
                                         
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