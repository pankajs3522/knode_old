<?php
include("db.ini.php");
include("auth.ini.php");

$count_company = 0;
$count_company_active = 0;

//Count All Companies
$query1 = "SELECT * FROM companies";
$result1 = mysqli_query($con, $query1) or die(mysqli_error($con));
if (mysqli_num_rows($result1) == 0) {
} else {

    while (mysqli_fetch_array($result1)) {
        $count_company = $count_company + 1;
    }
}

//Count Active Companies
$query = "SELECT * FROM companies WHERE active=1";
$result = mysqli_query($con, $query) or die(mysqli_error($con));
if (mysqli_num_rows($result) == 0) {
} else {

    while (mysqli_fetch_array($result)) {
        $count_company_active = $count_company_active + 1;
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

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"><a href='javascript:history.go(-1);'>< Back</a><button
                                    style="float:right;cursor:pointer;border:0px" data-toggle="modal"
                                    data-target="#addFilterModal"><i class="fas fa-filter"></i> Filter</h6>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr style="cursor:pointer">
                                            <th>S&nbsp;No</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Address</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr style="cursor:pointer">
                                            <th>S&nbsp;No</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Address</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $filter = "";
                                        if (isset($_GET['filter_active']) && $_GET['filter_active'] != "") {
                                            $filter = mysqli_real_escape_string($con, $_GET['filter_active']);
                                            if ($filter == "all") {
                                                $query2 = "SELECT * FROM companies ORDER BY id DESC";
                                            } else if ($filter == 1) {
                                                $query2 = "SELECT * FROM companies WHERE active=1 ORDER BY id DESC";
                                            } else if ($filter == 0) {
                                                $query2 = "SELECT * FROM companies WHERE active=0 ORDER BY id DESC";
                                            }
                                        } else {
                                            $query2 = "SELECT * FROM companies ORDER BY id DESC";
                                        }

                                        $result2 = mysqli_query($con, $query2) or die(mysqli_error($con));
                                        if (mysqli_num_rows($result2) == 0) {
                                        } else {
                                            $sno = 0;
                                            while ($result = mysqli_fetch_array($result2)) {
                                                $sno++;
                                                $id = $result['id'];
                                                $name = $result["name"];
                                                $description = $result['description'];
                                                $address = $result['address'];
                                                $active = $result['active'];
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $sno; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $name; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $description; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $address; ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($active == 0) {
                                                            echo "Inactive";
                                                        } else if ($active == 1) {
                                                            echo "Active";
                                                        }
                                                        ?>
                                                    </td>
                                                    <td style="width:30%">
                                                        <button class="btn btn-success" data-toggle="modal"
                                                            data-target="#editCompanyModal" data-id="<?php echo $id; ?>"
                                                            data-name="<?php echo $name; ?>"
                                                            data-description="<?php echo $description; ?>"
                                                            data-address="<?php echo $address; ?>"
                                                            data-active="<?php echo $active; ?>">
                                                            <font class="fas fa-edit"></font> Edit
                                                        </button>
                                                        &nbsp;
                                                        <button class="btn btn-primary" onclick='window.open("survey_view.php?company=<?php echo $id; ?>","_self");'>
                                                            <font class="fas fa-clipboard-list"></font> Surveys
                                                        </button>
                                                        &nbsp;
                                                        <button class="btn btn-danger">
                                                            <font class="fas fa-user"></font> Employees
                                                        </button>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
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

    <div class="modal fade" id="addCompanyModal" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">New Company Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="company_new.php?from=<?php echo basename($_SERVER['PHP_SELF']); ?>">
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

    <!-- Edit Company Modal -->

    <div class="modal fade" id="editCompanyModal" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Company Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="company_edit.php?from=<?php echo basename($_SERVER['PHP_SELF']); ?>">
                    <div class="modal-body">
                        <input type="hidden" id="id_edit" name="id"><br>
                        <input type="text" required class="form-control" id="name_edit" name="name"
                            placeholder="Name of Company"><br>
                        <textarea required class="form-control" id="desc_edit" name="description"
                            placeholder="Description"></textarea><br>
                        <textarea required class="form-control" id="address_edit" name="address"
                            placeholder="Address"></textarea><br>
                        <select id="name_edit" class="form-control" name="active">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add Filter Modal -->

    <div class="modal fade" id="addFilterModal" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Select Filter</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="get" action="companies_view.php?filter=true">
                    <div class="modal-body">
                        Status &nbsp;
                        <select class="form-control" name="filter_active">
                            <option value="1" <?php if ($filter == 1) {
                                echo "selected";
                            } ?>>Active</option>
                            <option value="0" <?php if ($filter == 0) {
                                echo "selected";
                            } ?>>Inactive</option>
                            <option value="all" <?php if ($filter == "all") {
                                echo "selected";
                            } ?>>All</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Apply</button>
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
        echo '<script>alert("New Company Added");location.replace("' . basename($_SERVER['PHP_SELF']) . '");</script>';
    }
    if (isset($_GET['edit_company']) && $_GET['edit_company'] == 1) {
        echo '<script>alert("Changes saved Successfully!");location.replace("' . basename($_SERVER['PHP_SELF']) . '");</script>';
    }
    ?>
    <script>
        //Open Modal for Editing Company
        $('#editCompanyModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var id = button.data('id') // Extract info from data-* attributes
            var name = button.data('name') // Extract info from data-* attributes
            var desc = button.data('description') // Extract info from data-* attributes
            var address = button.data('address') // Extract info from data-* attributes
            var active = button.data('active') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('#id_edit').val(id)
            //modal.find('#active_edit').val(active).change()
            modal.find('#name_edit').val(name)
            modal.find('#desc_edit').text(desc)
            modal.find('select[id=active_edit] option[value='+active+']').attr('selected','selected');
            modal.find('#address_edit').text(address)
            //modal.find('.modal-body input').val(recipient)
        });
    </script>

</body>

</html>