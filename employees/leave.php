<?php
session_start();
error_reporting(0);
include('../includes/dbconn.php');
require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (strlen($_SESSION['emplogin']) == 0) {
    header('location:../index.php');
} else {
    if (isset($_POST['apply'])) {
        $currentDate = date('m-d-Y'); // Get current date in 'mm-dd-yyyy' format
        $fromdate = $_POST['fromdate'];
    
        // Convert the submitted date to the same format as the current date
        $fromdateFormatted = date('m-d-Y', strtotime($fromdate));
    
        if ($fromdateFormatted < $currentDate) {
            // If the start date is past the current date, display an error message
            $error = "Please enter a start date that is not in the past.";
        } else {
          
        $empid = $_SESSION['eid'];
        

        // Fetch employee's email and full name from the database
        // $sql = "SELECT EmailId FROM tblemployees WHERE id = :empid";
        $sql = "SELECT EmailId, FirstName, LastName FROM tblemployees WHERE id = :empid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':empid', $empid, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        $employeeEmail = $result['EmailId'];
        $employeeName = $result['FirstName'] . ' ' . $result['LastName'];

        // Notify the employee that their leave request has been received
        $notificationMessage = "Dear $employeeName,<br>Your leave request has been received and is being processed. We will notify you once a decision has been made.<br><br>Thank you.<br>Your LeaveBoss Team.";

        // Send email notification
        $mail = new PHPMailer(true);
        try {
            // Email sending configuration
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'leavebossnotifications@gmail.com';
            $mail->Password = 'xwvarlqxrmsoauml';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Set email parameters
            $mail->setFrom('leavebossnotifications@gmail.com', 'Leave Boss');
            $mail->addAddress($employeeEmail);
            $mail->isHTML(true);
            $mail->Subject = 'Leave Request Received';
            $mail->Body = $notificationMessage;

            // Send email
            $mail->send();
            // echo "Email notification sent successfully\n";
        } catch (PDOException $e) {
            echo "Email notification could not be sent. Mailer Error: {$mail->ErrorInfo}\n";
        }


        $empid = $_SESSION['eid'];
        $leavetype = $_POST['leavetype'];
        $fromdate = $_POST['fromdate'];
        $todate = $_POST['todate'];
        $description = $_POST['description'];
        $reliever=$_POST['reliever'];
        $status = 0;
        $isread = 0;

        if ($fromdate > $todate) {
            $error = " Please enter correct details: End Data should be ahead of Starting Date in order to be valid! ";
        }

        $sql = "INSERT INTO tblleaves(LeaveType,FromDate,ToDate,Reliever,Description,Status,IsRead,empid) VALUES(:leavetype,:fromdate,:todate,:reliever,:description,:status,:isread,:empid)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':leavetype', $leavetype, PDO::PARAM_STR);
        $query->bindParam(':fromdate', $fromdate, PDO::PARAM_STR);
        $query->bindParam(':todate', $todate, PDO::PARAM_STR);
        $query->bindParam(':reliever', $reliever, PDO::PARAM_STR);
        $query->bindParam(':description', $description, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->bindParam(':isread', $isread, PDO::PARAM_STR);
        $query->bindParam(':empid', $empid, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();

        if ($lastInsertId) {
            $msg = "Your leave application has been applied, Thank You.";
        } else {
            $error = "Sorry, could not process this time. Please try again later.";
        }
    }
    }
?>

    <!doctype html>
    <html class="no-js" lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>LeaveBoss - Leave Application</title>
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
        <!-- page container area start -->
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
                            <li class="#">
                                    <a href="dashboard.php" aria-expanded="true"><i class="ti-user"></i><span>Dashboard
                                        </span></a>
                                </li>
                                <li class="active">
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
                        <!-- profile info & task notification -->
                        <div class="col-md-6 col-sm-4 clearfix">
                            <ul class="notification-area pull-right">
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- header area end -->
                <!-- page title area start -->
                <div class="page-title-area">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <div class="breadcrumbs-area clearfix">
                                <h4 class="page-title pull-left">Leave Application</h4>
                                <ul class="breadcrumbs pull-left">

                                    <li><span> on Leave Boss</span></li>
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
                    <div class="row">
                        <div class="col-lg-6 col-ml-12">
                            <div class="row">
                                <!-- Textual inputs start -->
                                <div class="col-12 mt-5">
                                    <?php if ($error) { ?><div class="alert alert-danger alert-dismissible fade show"><strong>Info: </strong><?php echo htmlentities($error); ?>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>

                                        </div><?php } else if ($msg) { ?><div class="alert alert-success alert-dismissible fade show"><strong>Info: </strong><?php echo htmlentities($msg); ?>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div><?php } ?>
                                    <div class="card">
                                        <form name="addemp" method="POST">

                                            <div class="card-body">
                                                <h4 class="header-title">Leave Form</h4>
                                                <p class="text-muted font-14 mb-4">Kindly fill in the form below.</p>

                                                <div class="form-group">
                                                    <label for="example-date-input" class="col-form-label">Begin Leave on</label>
                                                    <input class="form-control" type="date" value="2024-03-10" data-inputmask="'alias': 'date'" required id="example-date-input" name="fromdate">
                                                </div>

                                                <div class="form-group">
                                                    <label for="example-date-input" class="col-form-label">End Leave On</label>
                                                    <input class="form-control" type="date" value="2024-03-11" data-inputmask="'alias': 'date'" required id="example-date-input" name="todate">
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-form-label">Select Reliever</label>
                                                    <select class="custom-select" name="reliever" autocomplete="off" required>
                                                        <option value="">Click to select reliever...</option>

                                                        <?php 
                                                        $sql = "SELECT id, CONCAT(FirstName, ' ', LastName) AS Reliever  FROM tblemployees";
                                                        $query = $dbh->prepare($sql);
                                                        $query->execute();
                                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                        $cnt = 1;
                                                        if ($query->rowCount() > 0) {
                                                            foreach ($results as $result) {   ?>
                                                                <option value="<?php echo htmlentities($result->Reliever); ?>"><?php echo htmlentities($result->Reliever); ?></option>
                                                        <?php }
                                                        } ?>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-form-label">Leave Type</label>
                                                    <select class="custom-select" name="leavetype" autocomplete="off" required>
                                                        <option value="">Click to select the type of leave ...</option>

                                                        <?php $sql = "SELECT LeaveType from tblleavetype";
                                                        $query = $dbh->prepare($sql);
                                                        $query->execute();
                                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                        $cnt = 1;
                                                        if ($query->rowCount() > 0) {
                                                            foreach ($results as $result) {   ?>
                                                                <option value="<?php echo htmlentities($result->LeaveType); ?>"><?php echo htmlentities($result->LeaveType); ?></option>
                                                        <?php }
                                                        } ?>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="example-text-input" class="col-form-label">Briefly Summarize Your Situation</label>
                                                    <textarea class="form-control" name="description" type="text" name="description" length="400" id="example-text-input" rows="5" required></textarea>
                                                </div>

                                                <button class="btn btn-primary" name="apply" id="apply" type="submit">SUBMIT</button>

                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- main content area end -->
            <!-- footer area start-->
            <?php include '../includes/footer.php' ?>
            <!-- footer area end-->
        </div>
        <!-- page container area end -->
        <!-- offset area start -->
        <div class="offset-area">
            <div class="offset-close"><i class="ti-close"></i></div>


        </div>
        <!-- offset area end -->
        <!-- jquery latest version -->
        <script src="../assets/js/vendor/jquery-2.2.4.min.js"></script>
        <!-- bootstrap 4 js -->
        <script src="../assets/js/popper.min.js"></script>
        <script src="../assets/js/bootstrap.min.js"></script>
        <script src="../assets/js/owl.carousel.min.js"></script>
        <script src="../assets/js/metisMenu.min.js"></script>
        <script src="../assets/js/jquery.slimscroll.min.js"></script>
        <script src="../assets/js/jquery.slicknav.min.js"></script>

        <!-- others plugins -->
        <script src="../assets/js/plugins.js"></script>
        <script src="../assets/js/scripts.js"></script>
    </body>

    </html>

<?php } ?>