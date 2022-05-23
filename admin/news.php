<?php include('include/header.php');

include('include/sidebar.php');
$stmt = $con->prepare('select * from news  order by id desc ');
$stmt->execute();
$news = $stmt->fetchAll();

?>


<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="text-center">الاخبار </h1>

</div>

<div id="page-wrapper">

    <!-- /.row -->
    <div class="row  text-center">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading"><a href="addnews.php" class="btn btn-info " style="    position: absolute;
    left: 226px;
    top: -39px;">اضافة خبر جديد</a>
                </div>
                <?php
                if (isset($_GET['success']) && $_GET['success'] = 1) {

                    echo '<div class="alert alert-success">تم عملية بنجاح</div>';
                }
                if (isset($_GET['delete']) && $_GET['success'] = 1) {

                    echo '<div class="alert alert-danger">تم عملية الحذف  بنجاح</div>';
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
                                    <th>عنوان</th>
                                    <th>وصف</th>
                                    <th>الحالة</th>
                                    <th>اعدادات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($news as $new) {
                                ?>
                                    <tr class="gradeC">
                                        <td><?php echo $new['id'] ?></td>
                                        <td><img src="../<?php echo $new['image'] ?>" width="100px" height="100px"></td>

                                        <td class="center"><?php echo $new['title'] ?></td>
                                        <td class="center"><?php echo $new['discription'] ?></td>

                                        <td class="center"><?php echo $new['status'] == 1 ? 'فعال' : 'غير فعال' ?></td>
                                        <td class="center">

                                            <a href="editnews.php?id=<?php echo $new['id'] ?>" class="btn btn-success">تعديل</a>



                                            <a href="deletenews.php?id=<?php echo $new['id'] ?>" class="btn btn-danger">حذف</a>

                                        </td>
                                    </tr>
                                <?php } ?>
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