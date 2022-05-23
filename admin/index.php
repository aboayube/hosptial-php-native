<?php include('include/header.php');

include('include/sidebar.php');

$stmt = $con->prepare("select count(id) from users");
$stmt->execute();
$usercount = $stmt->fetchColumn();



$stmt2 = $con->prepare("select count(id) from booking");
$stmt2->execute();
$bookingcount = $stmt2->fetchColumn();



$stmt3 = $con->prepare("select count(id) from clinics");
$stmt3->execute();
$clinicscount = $stmt3->fetchColumn();


$stmt4 = $con->prepare("select count(id) from department");
$stmt4->execute();
$departmentcount = $stmt4->fetchColumn();


$stmt5 = $con->prepare("select count(id) from diagnosis");
$stmt5->execute();
$diagnosiscount = $stmt5->fetchColumn();

?>

<style>
  a:hover {
    text-decoration: none;
  }

  /* canva */
  #myChart {
    max-width: 590px !important;
    height: 450px;
  }



  /* calcender */

  .calendar {
    margin-top: -450px;
  }
</style>
<link rel="stylesheet" href="include/app.css">
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="text-center">لوحة التحكم</h1>
</div>
<div class="dashborad">
  <div class="container">
    <div class="row">
      <!-- start users -->
      <div class="col-xl-4 col-md-6 mb-4">
        <div class="card h-100" style="border-radius:22px
;">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col mr-2">
                <div class="text-xl  text-center font-weight-bold  mb-1">المستخدمين </div>

                <div class="mt-2 mb-0  text-center">
                  <a href="#"> <span class="text-success mr-2 text-center" style="font-size: 25px;">
                      <?php echo $usercount ?></span>
                  </a>
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-users  text-primary" style="font-size:60px"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- end users -->

      <div class="col-xl-4 col-md-6 mb-4">
        <div class="card h-100" style="border-radius:22px
;">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col mr-2">
                <div class="text-xl text-center font-weight-bold  mb-1">الحجوزات </div>

                <div class="mt-2 mb-0  text-center">
                  <a href="#"> <span class="text-success mr-2 text-center" style="font-size: 25px;">
                      <?php echo $bookingcount ?></span>
                  </a>
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-calendar fa-2x text-primary" style="font-size:60px"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- end product -->
      <div class="col-xl-4 col-md-6 mb-4">
        <div class="card h-100" style="border-radius:22px
;">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col mr-2">
                <div class="text-xl  text-center font-weight-bold  mb-1">عيادات</div>

                <div class="mt-2 mb-0  text-center">
                  <a href="#"> <span class="text-success mr-2 text-center" style="font-size: 25px;">
                      <?php echo $clinicscount ?></span>
                  </a>
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-shopping-basket fa-2x text-primary" style="font-size:60px"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- salary product -->


      <div class="col-xl-4 col-md-6 mb-4">
        <div class="card h-100" style="border-radius:22px
;">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col mr-2">
                <div class="text-xl  text-center font-weight-bold  mb-1">اقسام </div>

                <div class="mt-2 mb-0  text-center">
                  <a href="#"> <span class="text-success mr-2 text-center" style="font-size: 25px;">
                      <?php echo $departmentcount ?></span>
                  </a>
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-envelope-open-text fa-2x text-primary" style="font-size:60px"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- اسئلة الشائعه -->

      <div class="col-xl-4 col-md-6 mb-4">
        <div class="card h-100" style="border-radius:22px
;">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col mr-2">
                <div class="text-xl  text-center font-weight-bold  mb-1">عدد حالات التشخيص </div>

                <div class="mt-2 mb-0  text-center">
                  <a href="#"> <span class="text-success mr-2 text-center" style="font-size: 25px;">
                      <?php echo $diagnosiscount ?></span>
                  </a>
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-question-circle fa-2x text-primary" style="font-size:60px"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include('include/footer.php') ?>