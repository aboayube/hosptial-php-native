<?php
include('include/header.php'); ?>


<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="7000">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner" role="listbox">
        <!-- slide1 -->
        <div class="carousel-item active" style="background-image: url(img/slider/22.png);   background-size: cover !important;
    background-position: center center !important;">


        </div>
        <!-- slider 2 -->
        <div class="carousel-item " style="background-image: url(img/slider/33.jpg);   background-size: cover !important;
    background-position: center center !important;">

        </div>
        <!-- slider 3-->
        <div class="carousel-item " style="background-image: url(img/slider/44.jpg);     background-size: cover !important;
    background-position: center center !important; ">

        </div>
        <!-- prev & next buttons -->
        <a href="#carouselExampleIndicators" class="carousel-control-prev" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </a>
        <a href="#carouselExampleIndicators" class="carousel-control-next" role="button" data-slide="prev">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </a>

    </div>

</div>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-5">
            <img src="img/search.png" width="490px">
            <a href="docotors.php" class="btn btn-primary" style="
    margin-top: -162px;
    margin-left: 291px;">asdasd</a>
        </div>
        <div class="col-md-5 mr-2">
            <img src="img/DATE.png" width="490px" style="margin-right: 85px;">

            <a href="booking.php" class="btn btn-primary" style="
    margin-top: -162px;
    margin-left: 221px;">asdasd</a>
        </div>
    </div>
</div>

<div class="text-center news">
    <div class="" style=" 
    

;">
        <span style="font-size:50px;
  ;">
            <img src="img/OIP (7).jpg" alt="" width="70px" height="70px"> خدمتنا الصحية</span>
    </div>
</div>
<div class="container">
    <div class="row">

        <?php
        $stmt = $con->prepare('select * from news where status=1 order by id desc limit 4');
        $stmt->execute();
        $news = $stmt->fetchAll();
        foreach ($news as $new) { ?>
            <div class="col-md-4 new">
                <div class="row">
                    <div class="col-md-3">
                        <img src="<?php echo $new['image'] ?>" width="150px" height="150px" />
                    </div>
                    <div class="col-md-7">
                        <a href="new.php?id=<?php echo $new['id'] ?>"><?php echo $new['title'] ?></a>
                        <p><?php echo substr($new['discription'], 0, 30)  ?>...</p>
                        <a href="new.php?id=<?php echo $new['id'] ?>    " class="btn btn-primary">عرض</a>
                    </div>
                </div>
            </div>


        <?php

        }

        ?>
    </div>

</div>
<div class="searchwebsite text-center">
    <h2>بحث داخل الموقع</h2>
    <form class="form-inline">
        <input type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="ابحث داخل الموقع">



        <button type="submit" class="btn btn-primary mb-2">بحث</button>
    </form>
</div>
<?php
include('include/footer.php');
