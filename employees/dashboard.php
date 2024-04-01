<?php
session_start();
error_reporting(0);
// error_reporting(E_ALL);
//  ini_set('display_errors', 1);
include('../includes/dbconn.php');
if (strlen($_SESSION['alogin']) == 1) {
    header('location:../index.php');
    exit;
} else {


    try {
        // Get the total approved days
        $sql = "SELECT SUM(DATEDIFF(todate, fromdate) + 1) AS total_approved_days FROM tblleaves WHERE Status = '1' AND empid = :empid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':empid', $_SESSION['eid'], PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        $total_approved_days = $result['total_approved_days'];
    
        // Get the date when the leave was applied and the current date
        $sql = "SELECT FromDate FROM tblleaves WHERE empid = :empid ORDER BY FromDate DESC LIMIT 1";
        $query = $dbh->prepare($sql);
        $query->bindParam(':empid', $_SESSION['eid'], PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
    
        if ($result) {
            // Calculate the date when the leave begins
            $leave_fromdate = new DateTime($result['FromDate']);
                
            // Get the current date
            $current_date = new DateTime();
    
            // Calculate the difference in days
            $days_until_leave_starts = $current_date->diff($leave_fromdate)->days;
    
            // Calculate remaining leave days dynamically
            $remaining_leave_days = max(0, $total_approved_days - max(0, $days_until_leave_starts));
    
            // Update remaining leave days in the database if needed
            if ($remaining_leave_days !== $result['remaining_days']) {
                // Update remaining leave days in the database
                $sql = "UPDATE tblleaves SET remaining_days = :remaining_days WHERE empid = :empid";
                $query = $dbh->prepare($sql);
                $query->bindParam(':remaining_days', $remaining_leave_days, PDO::PARAM_INT);
                $query->bindParam(':empid', $_SESSION['eid'], PDO::PARAM_INT);
                $query->execute();
            }
        } else {
            // echo "No leave date found for the employee.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    

?>


    <!doctype html>
    <html class="no-js" lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>LeaveBoss - Employee Panel</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/png" href="../assets/images/icon/favicon.ico">
        <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="../assets/css/themify-icons.css">
        <link rel="stylesheet" href="../assets/css/metisMenu.css">
        <link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
        <link rel="stylesheet" href="../assets/css/slicknav.min.css">
        <!-- amchart css -->
        <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
        <!-- others css -->
        <link rel="stylesheet" href="../assets/css/typography.css">
        <link rel="stylesheet" href="../assets/css/default-css.css">
        <link rel="stylesheet" href="../assets/css/styles.css">
        <link rel="stylesheet" href="../assets/css/responsive.css">
        <!-- modernizr css -->
        <script src="../assets/js/vendor/modernizr-2.8.3.min.js"></script>
    </head>

    <body>
        <!-- preloader area start -->

        <div id="preloader">
            <div class="loader"></div>
        </div>
        <!-- preloader area end -->

        <div class="page-container">
            <!-- sidebar menu area start -->
            <div class="sidebar-menu">
                <div class="sidebar-header">
                    <div class="logo">
                        <a href="leave.php"><img src="../assets/images/icon/logo.png" alt="logo"></a>
                    </div>
                </div>
                <div class="main-menu">
                    <div class="menu-inner">
                        <nav>
                            <ul class="metismenu" id="menu">
                                <li class="active">
                                    <a href="dashboard.php" aria-expanded="true"><i class="ti-dashboard"></i><span>Dashboard
                                        </span></a>
                                </li>

                                <li class="#">
                                    <a href="leave.php" aria-expanded="true"><i class="ti-user"></i><span>Leave Application
                                        </span></a>
                                </li>

                                <li class="#">
                                    <a href="leave-history.php" aria-expanded="true"><i class="ti-agenda"></i><span>My Leave History
                                        </span></a>
                                </li>

                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- sidebar menu area end -->
            <!-- main content area start -->
            <div class="main-content">
                <!-- header area start -->
                <div class="header-area">
                    <div class="row align-items-center">
                        <!-- nav and search button -->
                        <div class="col-md-6 col-sm-8 clearfix">
                            <div class="nav-btn pull-left">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- header area end -->
                <!-- page title area start -->
                <div class="page-title-area">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <div class="breadcrumbs-area clearfix">
                                <h4 class="page-title pull-left">Dashboard</h4>
                                <ul class="breadcrumbs pull-left">
                                    <li><a href="dashboard.php">Home</a></li>
                                    <li><span>Employee's Dashboard</span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-6 clearfix">

                            <?php include '../includes/employee-profile-section.php' ?>

                        </div>
                    </div>
                </div>
                <!-- page title area end -->
                <div class="main-content-inner">
                    <!-- sales report area start -->
                    <div class="sales-report-area mt-5 mb-5">
                        <div class="row">
                            <div class="col-lg-8 mb-5">
                                <div class="single-report mb-xs-30 custom-box">
                                    <div class="s-report-inner pr--20 pt--30 mb-3 ">
                                        <div class="icon"><i class="fa fa-calendar"></i></div>
                                        <div class="s-report-title d-flex justify-content-between">
                                            <h4 class="header-title mb-0">Leave Days Taken</h4>

                                        </div>
                                        <!-- <div class="d-flex justify-content-between pb-2"> -->
                                        <div class="float-right">
                                            <!-- <h1><?php include '../admin/counters/leavedays-counter.php' ?></h1> -->
                                            <h1 class="pl-4"><?php echo ($total_approved_days); ?></h1>
                                            <span>Total Days</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="single-report mb-xs-30">
                                    <div class="s-report-inner pr--20 pt--30 mb-3">
                                        <div class="icon"><i class="fa fa-calendar"></i></div>
                                        <div class="s-report-title d-flex justify-content-between">
                                            <h4 class="header-title mb-0">Leave Balance</h4>

                                        </div>
                                        <div class="float-right">
                                            <h1 class="pl-4"><?php echo $remaining_leave_days; ?></h1>
                                            <span>Days Remaining</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <br>
                    </div>
                </div>
            </div>
            <!-- footer area start-->
            <?php include '../includes/footer.php' ?>
            <!-- footer area end-->
        </div>
        <!-- main content area end -->



        </div>
        <!-- jquery latest version -->
        <script src="../assets/js/vendor/jquery-2.2.4.min.js"></script>
        <!-- bootstrap 4 js -->
        <script src="../assets/js/popper.min.js"></script>
        <script src="../assets/js/bootstrap.min.js"></script>
        <script src="../assets/js/owl.carousel.min.js"></script>
        <script src="../assets/js/metisMenu.min.js"></script>
        <script src="../assets/js/jquery.slimscroll.min.js"></script>
        <script src="../assets/js/jquery.slicknav.min.js"></script>

        <!-- start chart js -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
        <!-- start highcharts js -->
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <!-- start zingchart js -->
        <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
        <script>
            zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
            ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
        </script>
        <!-- all line chart activation -->
        <script src="assets/js/line-chart.js"></script>
        <!-- all pie chart -->
        <script src="assets/js/pie-chart.js"></script>

        <!-- others plugins -->
        <script src="../assets/js/plugins.js"></script>
        <script src="../assets/js/scripts.js"></script>
    </body>

    </html>

<?php } ?>