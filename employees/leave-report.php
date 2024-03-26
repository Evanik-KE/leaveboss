<?php
session_start();
error_reporting(0);
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
include('../includes/dbconn.php');

if (strlen($_SESSION['alogin']) == 1) {
    header('location:../index.php');
    exit;
} else {
    // Check if leaveid is provided in the URL
    if (isset($_GET['leaveid'])) {
        // Sanitize the leaveid to prevent SQL injection
        $leaveid = filter_input(INPUT_GET, 'leaveid', FILTER_SANITIZE_NUMBER_INT);

        // Prepare and execute SQL statement
        $sql = "SELECT tblleaves.id as lid, tblemployees.FirstName, tblemployees.LastName, tblemployees.EmpId, tblemployees.id as emp_id, tblemployees.Gender, tblemployees.Phonenumber, tblemployees.EmailId, tblleaves.LeaveType, tblleaves.ToDate, tblleaves.FromDate, tblleaves.Description, tblleaves.PostingDate, tblleaves.Status, tblleaves.Reliever, tblleaves.AdminRemark, tblleaves.AdminRemarkDate FROM tblleaves JOIN tblemployees ON tblleaves.empid = tblemployees.id WHERE tblleaves.id = :lid";

        // Prepare the SQL statement
        $query = $dbh->prepare($sql);

        // Bind parameter
        $query->bindParam(':lid', $leaveid, PDO::PARAM_INT);

        // Execute the query
        $query->execute();

        // Fetch the result
        $leaveDetails = $query->fetch(PDO::FETCH_ASSOC);

        // Output leave details
        if ($leaveDetails) {
            // Calculate the number of days taken for the leave
            $fromDate = new DateTime($leaveDetails['FromDate']);
            $toDate = new DateTime($leaveDetails['ToDate']);
            $interval = $fromDate->diff($toDate);
            $daysTaken = $interval->days + 1; // Add 1 to include both the start and end dates
            // Determine status text based on status value
            $statusText = ($leaveDetails['Status'] == 0) ? 'Pending' : 'Approved';

            // Output HTML for displaying leave details and number of days taken
?>
            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="utf-8">
                <meta http-equiv="x-ua-compatible" content="ie=edge">
                <title>LeaveBoss - Leave Report</title>
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link rel="shortcut icon" type="image/png" href="../assets/images/icon/favicon.ico">
                <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
                <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
                <link rel="stylesheet" href="../assets/css/themify-icons.css">
                <link rel="stylesheet" href="../assets/css/metisMenu.css">
                <link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
                <link rel="stylesheet" href="../assets/css/slicknav.min.css">
                <!-- amchart css -->

                <link rel="stylesheet" href="../assets/css/typography.css">
                <link rel="stylesheet" href="../assets/css/default-css.css">
                <link rel="stylesheet" href="../assets/css/styles.css">
                <link rel="stylesheet" href="../assets/css/responsive.css">
                <!-- modernizr css -->
                <script src="../assets/js/vendor/modernizr-2.8.3.min.js"></script>
                <style>
                    h1 {
                        font-family: "Lato", sans-serif;
                    }

                    body {
                        margin: 20px;
                        padding: 20px;
                        font-size: 24px;
                    }

                    @media print {
                        button.btn.btn-primary.blue-background {
                            display: none !important;
                        }
                    }

                    /* Set the page size to A4 */
                    @page {
                        size: A4;
                    }
                </style>
            </head>

            <body>
                <div class="container text-center">
                    <h1>LeaveBoss</h1>
                    <br>
                    <hr><hr>
                </div>
                <h3>Leave Report</h3>
                <p><strong>Leave ID:</strong> <?php echo $leaveDetails['lid']; ?></p>
                <p><strong>Employee Name:</strong> <?php echo $leaveDetails['FirstName'] . ' ' . $leaveDetails['LastName']; ?></p>
                <p><strong>Employee ID:</strong> <?php echo $leaveDetails['EmpId']; ?></p>
                <p><strong>Gender:</strong> <?php echo $leaveDetails['Gender']; ?></p>
                <p><strong>Phone Number:</strong> <?php echo $leaveDetails['Phonenumber']; ?></p>
                <p><strong>Email ID:</strong> <?php echo $leaveDetails['EmailId']; ?></p>
                <p><strong>Leave Type:</strong> <?php echo $leaveDetails['LeaveType']; ?></p>
                <p><strong>From Date:</strong> <?php echo $leaveDetails['FromDate']; ?></p>
                <p><strong>To Date:</strong> <?php echo $leaveDetails['ToDate']; ?></p>
                <p><strong>Number of Days Taken:</strong> <?php echo $daysTaken; ?></p>
                <p><strong>Description:</strong> <?php echo $leaveDetails['Description']; ?></p>
                <p><strong>Posting Date:</strong> <?php echo $leaveDetails['PostingDate']; ?></p>
                <p><strong>Status:</strong> <?php echo $statusText; ?></p>
                <p><strong>Reliever:</strong> <?php echo $leaveDetails['Reliever']; ?></p>
                <p><strong>Admin Remark:</strong> <?php echo $leaveDetails['AdminRemark']; ?></p>
                <p><strong>Admin Remark Date:</strong> <?php echo $leaveDetails['AdminRemarkDate']; ?></p>
                <br>
                <button class="btn btn-primary blue-background" onclick="window.print()">Print Leave Report</button>
                <hr>
                <div>
                    <p class="text-center">Thanks for trusting LeaveBoss Team!</p>
                </div>
                <!-- Add a link to download the page as a PDF -->
                <!-- Update the link to include the leave ID as a query parameter -->
                <!-- <a href="get-leave-details.php?leaveid=<?php echo $leaveid; ?>" id="downloadPDF">Download Report</a> -->

                <!-- Include the jsPDF library -->
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

                <script>
                    // JavaScript to handle downloading the page as PDF
                    document.getElementById('downloadPDF').addEventListener('click', function() {
                        // Create a new jsPDF instance
                        var doc = new jsPDF();

                        // Add HTML content to the PDF
                        doc.fromHTML(document.documentElement.outerHTML, function() {
                            // Save the PDF
                            doc.save('leave_details.pdf');
                        });
                    });
                </script>
            </body>

            </html>
<?php
        } else {
            // If leave details are not found, display an error message
            echo "Leave details not found.";
        }
    } else {
        // If leaveid is not provided, show an error message
        echo "Leave ID not provided.";
    }
}
?>