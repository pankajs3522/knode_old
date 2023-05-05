<?php
include("db.ini.php");
include("auth.ini.php");

$count_company = 0;
$count_company_active = 0;
$count_company_survey = 0;

//Count All Companies
$query1 = "SELECT * FROM companies";
$result1 = mysqli_query($con, $query1) or die(mysqli_error($con));
if (mysqli_num_rows($result1) == 0) {
} else {

    while ($row=mysqli_fetch_array($result1)) {
        if($row['active'] == 1)
        {
            $count_company_active = $count_company_active + 1;
        }
        $count_company = $count_company + 1;
    }
}

//Count Active Companies
$query = "SELECT COUNT(company) FROM survey_details GROUP BY company";
$result = mysqli_query($con, $query) or die(mysqli_error($con));
if (mysqli_num_rows($result) == 0) {
} else {

    while ($row1=mysqli_fetch_array($result)) {
        $count_company_survey=$row1['COUNT(company)'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Knode - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php
        include("sidebar.php");
        ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php
                include("header.php");
                ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Companies</h1>
                        <a href="#" data-toggle="modal" data-target="#addCompanyModal"
                            class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-plus fa-sm text-white-50"></i> Add New Company</a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <div class="col-xl-3 col-md-6 mb-4 select_box" onclick="window.open('companies_view.php?filter_active=all','_self');">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                All Companies
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo $count_company; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-industry fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4 select_box" onclick="window.open('companies_view.php?filter_active=1','_self');">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Active Companies
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo $count_company_active; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-industry fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4 select_box">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Companies (with active surveys)
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo $count_company_survey; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php
            include("footer.php");
            ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->
    <!-- Add Company Modal -->

    <div class="modal fade" id="addCompanyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">New Company Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="company_new.php">
                    <div class="modal-body">
                        <input type="text" required class="form-control" name="name" placeholder="Name of Company"><br>
                        <textarea required class="form-control" name="description"
                            placeholder="Description"></textarea><br>
                        <textarea required class="form-control" name="address" placeholder="Address"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add New Company</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php
    include("footer_scripts.php");
    ?>
    <?php
    if (isset($_GET['new_company']) && $_GET['new_company'] == 1) {
        echo '<script>alert("New Company Added");location.replace("companies.php");</script>';
    }
    ?>

</body>

</html>