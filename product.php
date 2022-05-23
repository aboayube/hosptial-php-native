<?php include('include/header.php');
$id=$_GET['id'];
if($id && is_numeric($id)){
 
 if(isset($_GET['lang']) && $_GET['lang']=='en'){
     $sql='
     products.title_en as title,
     products.discription_en as discription,
     products.content_en as content,
     products.total_count_en as total_count,
     products.countity_en as countity,
     products.price_en as price,';
 }else{
     $sql='    products.title as title,
     products.discription as discription,
     products.content as content,
     products.total_count as total_count,
     products.price as price,
     products.countity as countity,
     
     
     ';
 }
 
    $stmt=$con->prepare("
    SELECT products.id as product_id,
    products.image as product_image,".$sql."
    users.name as user_name,
    users.image as user_image
        FROM products
        INNER JOIN  users
        ON products.user_id = users.id
        where products.status=1 
        and products.total_count > 0 
        and products.id=?  limit 1");
    $stmt->execute(array($id));
    $count=$stmt->rowCount();
if($count>0){
    $product=$stmt->fetch();
}else{
    echo $count;
}

}else{
    header("location:index.php");
}

?>
<style>
    .product-single {
        padding-top: 50px;
    }

    .product-single img {
        margin-left: 100px;
    }

    .price {
        padding-top: 50px;
        margin-left: 120px;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="product-single">
    <div class="container">
        <div class="row">
            <div class="col-md-7 ">
                <img src="img/products/<?php echo $product['product_image']?>" width="100%">
                <div class="price text-center">
                    <h4 class="">salary:<span><?php echo $product['price']?>$</span></h4>
                    <p class="mt-3">for sales: <?php echo $product['total_count']?><br>
                        </p>
                    <p class="mt-3">toal shares: <?php echo $product['countity']?><br>
                        </p>

                </div>
                <div class="social">
                    <p>Share this project:
                        <i class="fab fa-facebook"></i>
                        <i class="fab fa-twitter"></i>
                        <i class="fab fa-instagram"></i>
                        <i class="fab fa-linkedin"></i>


                    </p>


                </div>


            </div>
            <div class="col-md-5    ">
                <h1 class=""><?php echo $product['title']?></h1>
                <p><?php echo $product['discription']?> </p>
                <div class="row">

                    <div class="col-md-7">
                        <img src="img/users/<?php echo $product['user_image']?>" style="  border-radius: 50%;" width="100px" height="100px">
                    </div>
                    <div class="col-md-2"> By<span class="name"><?php echo $product['user_name']?></span></div>
                </div>
                <div class="alert alert-success mt-5">
           <?php echo $product['discription']?>
                </div>
                <div class="d-flex justify-content-center">
<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
if(isset($_SESSION['id'])){
$stmt=$con->prepare('INSERT INTO `buy_product`( 
    `producty_id`, `user_id`, `created_at`, `status`) VALUES 
    (:zproduct_id,:zuser_id,:zcreated_at,:zstatus) ');
    $stmt->execute(array(
        'zproduct_id'=>$product['product_id'],
        'zuser_id'=>$_SESSION['id'],
        'zcreated_at'=>time(),
        'zstatus'=>'قابل للدفع'

    ));

    $count=$stmt->rowCount();
    if($count>0){
        echo 'تمت العملية بنجاح';
        header("Location:payment.php?name=".$product['title']."&price=".$product['price']);
    }
}else{
    echo 'يجيب ان تعمل تسجيل دخول';
}


}

?>

                    <form action="<?php $_SERVER['PHP_SELF']?>" method="POST">

                    <button class="btn btn-info">Buy Now</button>

                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
<hr style="
    border-top: 3px solid rgb(0,0,0);" >
<section>
    <div class="container text-center">
    <?php echo $product['content']?>
    </div>
</section>




<?php include('include/footer.php') ?>