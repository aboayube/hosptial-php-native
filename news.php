<?php
include('include/header.php'); ?>
<div class=" news">
    <h2 class="text-center">اخر اخبار</h2>
    <div class="container">
        <div class="row">

            <?php
            $stmt = $con->prepare('select * from news where status=1 order by id desc limit 4');
            $stmt->execute();
            $news = $stmt->fetchAll();
            foreach ($news as $new) { ?>
                <div class="col-md-4 new">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="<?php echo $new['image'] ?>" width="150px" height="150px" />
                        </div>
                        <div class="col-md-6">
                            <a href=""><?php echo $new['title'] ?></a>
                            <p><?php echo substr($new['discription'], 0, 20) ?></p>
                            <a href="new.php?id=<?php echo $new['id'] ?>" class="btn btn-primary">عرض</a>
                        </div>
                    </div>
                </div>


            <?php

            }

            ?>
        </div>
    </div>

</div>
</div>
<?php
include('include/footer.php');
