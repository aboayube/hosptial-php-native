<?php include('include/header.php');

?>


<style>
    .col-4{
        margin-top: 10px;
        margin-bottom: 10px;
    }
    .product {
        margin-bottom: 12px;
        margin-top: 20px;
        background-color: #e3f8fc;
        

    }

    .product:hover {
        background-color: #eee;
    }
</style>
<h1 class="text-center"><?php echo $data['projects']?></h1>
<div class="container">
    <div class="row">
        <?php
        if(isset($_GET['lang']) && $_GET['lang']=='en'){

            $stmt=$con->prepare("select  id,image,total_count_en as count,countity_en as countity, title_en as title,discription_en as discription,price_en as price from products where status=1 and total_count >0");
            $stmt->execute();
        }else{
            
$stmt=$con->prepare("select id,image,total_count_en as count,countity as countity, title,discription,price from products where status=1 and total_count >0");
$stmt->execute();
        }
$products=$stmt->fetchAll();
foreach($products as $product){


?>
        <div class="col-4">
            <div class="col ">
                <div class="card h-100 shadow-sm product" style="width:350px"> 
                <img src="img/products/<?php echo $product['image']?>"  height="200px"  
                <?php if($lang=='en'){?> style="margin-left:-23px"  <?php }?>
                alt="...">
                    <div class="card-body">
                        <a href="product.php?lang=<?php echo $lang?>&id=<?php echo $product['id']?>">
                        <h1 class="text-center"><a href="product.php?lang=<?php echo $lang?>&id=<?php echo $product['id']?>"><?php echo $product['title']?></a></h1>
                        <h5 class="card-title text-center"><?php echo $product['discription']?></h5>
                        <div class="clearfix text-center mb-3"> <span class="float-start badge rounded-pill bg-primary"><?php echo $data['salary project']?> </span> <span class="float-end price-hp"><?php echo $product['price']?>$</span> </div>
   <div class="text-center"> 
     <?php echo $data['buy project']?>: <?php echo $product['count']?>    
     (  <?php echo $data['count project']?> :<span><?php echo $product['countity']?>)</span>


</div>
                        <div class="text-center my-4"> <a href="#" class="btn btn-info"><?php echo $data['checkoffer project']?></a> </div>
                   
                        </a> </div>
                </div>
            </div>
        </div>

        <?php }?>
    </div>
</div>
</div>
<br>
<?php include('include/footer.php') ?>