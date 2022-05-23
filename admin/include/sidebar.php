<!-- Page Wrapper -->
<div id="wrapper">
    <!-- Sidebar -->
    <ul style="background: green;" class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../index.php">
            <div class="sidebar-brand-icon">
                <?php
                $stmt = $con->prepare('select image from setting');
                $stmt->execute();
                $set = $stmt->fetch();


                ?>
                <img src=" ../img/<?php echo $set['image'] ?>" width="150px" height="70px">
            </div>
        </a>

        <!-- Divider -->

        <li class="nav-item">
            <a class="nav-link" href="../index.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>صفحة رئيسية</span></a>
        </li>
        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="index.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>لوحة التحكم</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="diagnosis.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>التشخيص المرضي</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="datedoctors.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span> مواعيد الاطباء</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="bookinguser.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span> حجوزات المستخدمين</span></a>
        </li>
        <!-- Nav Item - Dashboard -->

        <!-- Nav Item - Dashboard -->
        <?php
        if ($_SESSION['role'] == 'admin') {
        ?> <li class="nav-item">
                <a class="nav-link" href="department.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>اقسام</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="clinics.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>العيادات</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="users.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>المستخدمين</span></a>
            </li>
            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="settings.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>اعدادات الموقع</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="news.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>اخبار</span></a>
            </li>
        <?php } ?>
        <li class="nav-item">
            <a class="nav-link" href="../logout.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>تسجيل الخروج</span></a>
        </li>
        <!-- Sidebar Toggler (Sidebar) -->

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            <!-- Topbar -->
            <nav class="
              navbar navbar-expand navbar-light
              bg-white
              topbar
              mb-4
              static-top
              shadow
            ">
                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Search -->

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search fa-fw"></i>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="
                    dropdown-menu dropdown-menu-right
                    p-3
                    shadow
                    animated--grow-in
                  " aria-labelledby="searchDropdown">
                            <form class="form-inline mr-auto w-100 navbar-search">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>

                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="profile.php" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo  $_SESSION['name'] ?></span>
                            <img class="img-profile rounded-circle" src="../img/users/<?php echo $_SESSION['image'] ?>" />
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="
                    dropdown-menu dropdown-menu-right
                    shadow
                    animated--grow-in
                  " aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="profile.php">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                حسابي
                            </a>

                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                تسجيل الخروج
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <!-- End of Topbar -->