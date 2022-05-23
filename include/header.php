<?php
ob_start();
session_start();

include('connect.php');
include('functions.php');

$stmt = $con->prepare('select * from setting where id=1');
$stmt->execute();
$setting = $stmt->fetch();


?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="include/assets/bootstrap.min.css">
    <link rel="stylesheet" href="include/assets/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/owal.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            direction: rtl !important;
            background: linear-gradient(135deg, #c6e8ff, #0193ccc5);
        }

        .carousel-item {
            min-height: 80vh;
            background-color: white
        }

        .carousel-text {
            margin-top: -200px;
            color: #f9f9f9;
        }

        .news {
            padding-top: 20px;
            padding-bottom: 20px;
            background-color: #eee;

        }
        

        .new {
            margin: 40px;
            background-color: #e4e4e4;
            border: 1px solid #111;
            padding-top: 20px;

        }


        .statics {
            padding-top: 50px;
            padding-bottom: 50px;
            background-color: skyblue;
        }

        .searchwebsite {
            padding-top: 150px;
            padding-bottom: 150px;

        }

        .searchwebsite form {
            padding-top: 12px !important;
            margin-right: 300px;
        }

        .searchwebsite form input {
            width: 620px !important;
        }

        .searchwebsite form button {
            margin-right: 5px;
        }

        ul {
            list-style: none;
        }

        .socialmedia li {
            margin-top: 12px !important;
        }
    </style>
    <title><?php echo $setting['name'] ?></title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-primary">
        <a class="navbar-brand" href="index.php"><img src="img/<?php echo $setting['image'] ?>" width="50px" height="50px" /> <?php echo $setting['name']?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item ">
                    <a class="nav-link" href="news.php"> اخر اخبار <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="booking.php">حجز موعد <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="docotors.php">الاطباء</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        اقسام
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php
                        $stmt = $con->prepare('select * from department where status=1');
                        $stmt->execute();
                        $dps = $stmt->fetchAll();
                        foreach ($dps as $dp) { ?>

                            <a class="dropdown-item" href="department.php?id=<?php echo $dp['id'] ?>"><?php echo $dp['name'] ?></a>
                        <?php
                        }
                        ?>

                    </div>
                </li>
                <?php
                if (!isset($_SESSION['email'])) { ?>

                    <li class="nav-item active">
                        <a class="nav-link" href="#" data-toggle="modal" data-target="#exampleModal">تسجيل الدخول <span class="sr-only">(current)</span></a>
                    </li>


                <?php } else { ?>


                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="img/users/<?php echo $_SESSION['image'] ?>" style="    border-radius: 50%;
" width="45px" height="37px"> <?php echo $_SESSION['name'] ?>
                        </a>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                            <a class="dropdown-item" href="admin/index.php"> لوحه التحكم</a>
                            <?php if ($_SESSION['role'] == 'docotor') { ?>
                                <a class="dropdown-item" href="diagnosis.php"> اضافة تشخيص</a>
                            <?php } ?>
                            <a class="dropdown-item" href="logout.php">تسجيل الخروج</a>
                        </div>
                    </li>

                <?php }

                ?>


            </ul>
        </div>
    </nav>