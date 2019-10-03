<?php
session_start();
include_once 'db_function/insurance_func.php';
include_once 'db_function/patient_func.php';
include_once 'db_function/user_func.php';
include_once 'db_function/db_helper.php';
include_once 'view/view_util.php';

if(!isset($_SESSION['user_logged'])) {
    $_SESSION['user_logged'] = false;
}



?>

<!DOCTYPE html>

<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/tableStyle.css">
    <script src="js/my_js.js"></script>
</head>

<body>
<div class="page">
    <?php

    if($_SESSION['user_logged']) {?>
        <h4><?php echo "Selamat Datang " . $_SESSION['name']?></h4><hr>

   <?php if ($_SESSION['role'] == 1) {
    ?>
    <h4>Menu</h4>


    <nav>
        <ul>
            <li><a href="?menu=hm">Home</a></li>
            <li><a href="?menu=pt">Patient</a></li>
            <li><a href="?menu=ins">Insurance</a></li>
            <li><a href="?menu=out">Logout</a></li>
        </ul>
    </nav>

    <main>
        <?php
        $targetMenu = filter_input(INPUT_GET, 'menu');
        switch ($targetMenu) {
            case 'hm':
                include_once 'view/home.php';
                break;
            case 'pt':
                include_once 'view/patient.php';
                break;
            case 'ins':
                include_once 'view/insurance.php';
                break;
            case 'updIns':
                include_once 'view/insurance_update.php';
                break;
            case 'updPat':
                include_once 'view/patient_update.php';
                break;
            case 'updUser':
                include_once 'view/user_update.php';
                break;
            case 'out':
                session_destroy();
                header("location:index.php");
                break;
            default ;
        }
        ?>
    </main>


        <?php
        } elseif ($_SESSION['role'] == 2) {
        ?>
        <nav>
            <ul>
                <li><a href="?menu=pt">Patient</a></li>
                <li><a href="?menu=ins">Insurance</a></li>
                <li><a href="?menu=out">Logout</a></li>
            </ul>
        </nav>
        <main>
        <?php
        $targetMenu = filter_input(INPUT_GET, 'menu');
        switch ($targetMenu) {
            case 'pt':
                include_once 'view/patient.php';
                break;
            case 'ins':
                include_once 'view/insurance.php';
                break;
            case 'updPat':
                include_once 'view/patient_update.php';
                break;
            case 'updIns':
                include_once 'view/insurance_update.php';
                break;
            case 'out':
                session_destroy();
                header("location:index.php");
            default;
        }
        ?>
        </main>
        <?php
        } elseif ($_SESSION['role'] == 3) {?>
        <nav>
            <ul>
                <li><a href="?menu=pt">Patient</a></li>
                <li><a href="?menu=out">Logout</a></li>
            </ul>
        </nav>
        <main>
        <?php
        $targetMenu = filter_input(INPUT_GET, 'menu');
        switch ($targetMenu) {
            case 'pt':
                include_once 'view/patient.php';
                break;
            case 'updPat':
                include_once 'view/patient_update.php';
                break;
            case 'out':
                session_destroy();
                header("location:index.php");
            default;
        }
        ?>
        </main>
        <?php
        }
        ?>
        <?php
        } else {
            include_once 'view/login.php';
        }
        ?>
        </div>
        </body>

        <script>
        $(document).ready(function () {
            $('#patient').DataTable();
            $('#insurance').DataTable();
            $('#user').DataTable();
        });
    </script>

</html>
