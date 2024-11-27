<?php

include('dbcon.php');

if (isset($_GET['student_id'])) {
    $student_id = mysqli_real_escape_string($con, $_GET['student_id']);

  
    $query = "SELECT * FROM students WHERE id = '$student_id'";
    $result = mysqli_query($con, $query);

    if ($result) {
       
        $student = mysqli_fetch_assoc($result);

        if ($student) {
            ?>
            <div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">

    <!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>

        <!-- Topbar Search -->
<!-- Topbar Search -->
<form id="searchForm" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
    <div class="input-group">
        <input type="text" id="searchInput" class="form-control bg-light border-0 small" placeholder="Search for student Id?" aria-label="Search" aria-describedby="basic-addon2">
        <div class="input-group-append">
            <button class="btn btn-primary" type="button" id="searchButton">
                <i class="fas fa-search fa-sm"></i>
            </button>
        </div>
    </div>
</form>





        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-search fa-fw"></i>
                </a>
                <!-- Dropdown - Messages -->
                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                    <form class="form-inline mr-auto w-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>

            <!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-bell fa-fw"></i>
                    <!-- Counter - Alerts -->
                    <span class="badge badge-danger badge-counter">3+</span>
                </a>
                <!-- Dropdown - Alerts -->
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                    <h6 class="dropdown-header">
                        Alerts Center
                    </h6>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="mr-3">
                            <div class="icon-circle bg-primary">
                                <i class="fas fa-file-alt text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div class="small text-gray-500">December 12, 2019</div>
                            <span class="font-weight-bold">A new monthly report is ready to download!</span>
                        </div>
                    </a>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="mr-3">
                            <div class="icon-circle bg-success">
                                <i class="fas fa-donate text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div class="small text-gray-500">December 7, 2019</div>
                            $290.29 has been deposited into your account!
                        </div>
                    </a>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="mr-3">
                            <div class="icon-circle bg-warning">
                                <i class="fas fa-exclamation-triangle text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div class="small text-gray-500">December 2, 2019</div>
                            Spending Alert: We've noticed unusually high spending for your account.
                        </div>
                    </a>
                    <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                </div>
            </li>

            <!-- Nav Item - Messages -->
            <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-envelope fa-fw"></i>
                    <!-- Counter - Messages -->
                    <span class="badge badge-danger badge-counter">7</span>
                </a>
                <!-- Dropdown - Messages -->
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                    <h6 class="dropdown-header">
                        Message Center
                    </h6>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="dropdown-list-image mr-3">
                            <img class="rounded-circle" src="img/undraw_profile_1.svg" alt="...">
                            <div class="status-indicator bg-success"></div>
                        </div>
                        <div class="font-weight-bold">
                            <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                problem I've been having.</div>
                            <div class="small text-gray-500">Emily Fowler · 58m</div>
                        </div>
                    </a>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="dropdown-list-image mr-3">
                            <img class="rounded-circle" src="img/undraw_profile_2.svg" alt="...">
                            <div class="status-indicator"></div>
                        </div>
                        <div>
                            <div class="text-truncate">I have the photos that you ordered last month, how
                                would you like them sent to you?</div>
                            <div class="small text-gray-500">Jae Chun · 1d</div>
                        </div>
                    </a>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="dropdown-list-image mr-3">
                            <img class="rounded-circle" src="img/undraw_profile_3.svg" alt="...">
                            <div class="status-indicator bg-warning"></div>
                        </div>
                        <div>
                            <div class="text-truncate">Last month's report looks great, I am very happy with
                                the progress so far, keep up the good work!</div>
                            <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                        </div>
                    </a>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="dropdown-list-image mr-3">
                            <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="...">
                            <div class="status-indicator bg-success"></div>
                        </div>
                        <div>
                            <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                told me that people say this to all dogs, even if they aren't good...</div>
                            <div class="small text-gray-500">Chicken the Dog · 2w</div>
                        </div>
                    </a>
                    <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
                    <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Profile
                    </a>
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                        Settings
                    </a>
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                        Activity Log
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </a>
                </div>
            </li>

        </ul>

    </nav>
            <!-- Display the student information -->
              <div class="container-xl color">
            <div class="table-responsive">
                <div class="table-wrapper">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-6">
                                <h2>Manage <b>Students</b></h2>
                            </div>
                            <div class="col-sm-6">
                                <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Student</span></a>

                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Section</th>
                                <th>Grade Level</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $entriesPerPage = 7;
                            $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

                            $query = "SELECT * FROM students";
                            $query_run = mysqli_query($con, $query);

                            if ($query_run) {
                                $totalEntries = mysqli_num_rows($query_run);
                                $totalPages = ceil($totalEntries / $entriesPerPage);


                                $offset = ($currentPage - 1) * $entriesPerPage;
                                $query = "SELECT * FROM students LIMIT $offset, $entriesPerPage";
                                $query_run = mysqli_query($con, $query);

                                if ($query_run) {
                        

                            ?>
                                        <tr>
                                            <td><?= $student['id']; ?></td>
                                            <td><?= $student['name']; ?></td>
                                            <td><?= $student['email']; ?></td>
                                            <td><?= $student['section']; ?></td>
                                            <td><?= $student['gradelevel']; ?></td>
                                            <td>

                                                <form action="" method="post">
                                                    <input type="hidden" name="delete_student" value="<?= $student['id']; ?>">
                                                    <a href="#" class="edit" title="Edit" data-toggle="modal" data-target="#editEmployeeModal" data-student-id="<?= $student['id']; ?>" data-student-name="<?= $student['name']; ?>" data-student-email="<?= $student['email']; ?>" data-student-section="<?= $student['section']; ?>" data-student-gradelevel="<?= $student['gradelevel']; ?>">
                                                        <i class="material-icons">&#xE254;</i>
                                                    </a>
                                                    <a href="#" class="delete" title="Delete" data-toggle="modal" data-target="#deleteConfirmationModal<?= $student['id']; ?>"><i class="material-icons">&#xE872;</i></a>


                                                    <!-- Delete Confirmation Modal -->
                                                    <div id="deleteConfirmationModal<?= $student['id']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="deleteConfirmationModalLabel">Delete Student</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Are you sure you want to delete this student?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>


                                            </td>
                                        </tr>
                            <?php
                                    
                                } else {
                                    echo "<h5>Record not found!!</h5>";
                                }
                            } else {
                                echo "<h5>Error executing the query</h5>";
                            }
                            ?>
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="clearfix">
                    <a href="student_info.php" type="submit" class="btn btn-success">Back</a>
                        
                    </div>
                </div>
            </div>
        </div>

            <!-- Edit Modal HTML -->

        <div id="editEmployeeModal" class="modal fade">
            <?php include('message.php'); ?>
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="" method="post">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Students</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="text" name="student_id" id="edit_student_id" class="form-control" required readonly>
                            </div>
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" id="edit_name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" id="edit_email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Section</label>
                                <input type="text" class="form-control" name="section" id="edit_section" required>
                            </div>
                            <div class="form-group">
                                <label for="gradelevel">Grade Level</label>
                                <select class="form-control" name="gradelevel" id="edit_gradelevel" required>
                                    <option>First year college</option>
                                    <option>2nd year college</option>
                                    <option>Third year college</option>
                                    <option>fourth year college</option>
                                    <!-- Add more options as needed -->
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                            <input type="submit" class="btn btn-success" value="Save Changes" name="save_changes">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div id="addEmployeeModal" class="modal fade">

            <?php include('message.php'); ?>
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="" method="post">
                        <div class="modal-header">
                            <h4 class="modal-title">Add Students</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Section</label>
                                <input type="text" class="form-control" name="section" required></input>
                            </div>
                            <div class="form-group">
                                <label for="gradelevel">Grade Level</label>
                                <select class="form-control" name="gradelevel" required>
                                    <option>First year college</option>
                                    <option>2nd year college</option>
                                    <option>Third year college</option>
                                    <option>fourth year college</option>
                                    <!-- Add more options as needed -->
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                            <input type="submit" class="btn btn-success" value="Add" name="save_student" data-bs-toggle="modal" data-bs-target="#exampleModal">

                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Delete Modal HTML -->

        <div id="deleteStudent" class="modal fade">
            <?php include('delete_student.php'); ?>
            <div class="modal-dialog">
                <div class="modal-content">
                    <form>
                        <div class="modal-header">
                            <h4 class="modal-title">Delete Employee</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete these Records?</p>
                            <p class="text-warning"><small>This action cannot be undone.</small></p>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                            <input type="submit" class="btn btn-danger" value="Delete">
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- End of Main Content -->

    <script>
        $(document).on('click', ".edit", function() {
            var student_id = $(this).data('student-id');
            var name = $(this).data('student-name');
            var email = $(this).data('student-email');
            var section = $(this).data('student-section');
            var gradelevel = $(this).data('student-gradelevel');

            // Set values in the modal
            $('#edit_student_id').val(student_id);
            $('#edit_name').val(name);
            $('#edit_email').val(email);
            $('#edit_section').val(section);
            $('#edit_gradelevel').val(gradelevel);

            $('#editEmployeeModal').modal('show');
        });
    </script>


<script>
  $(document).ready(function () {
    // Add an event listener to the search button
    $("#searchButton").click(function () {
        // Get the search query
        var searchQuery = $("#searchInput").val();

        // Perform an AJAX request to fetch and update content based on the search query
        $.ajax({
            type: "GET",
            url: "search.php",
            data: { student_id: searchQuery }, // Pass the search query to the server
            success: function (data) {
                // Check if the returned data indicates that the student ID was not found
                if (data.trim() === 'not_found') {
                    // Display SweetAlert popup for not found
                    Swal.fire({
                        icon: 'error',
                        title: 'Student ID Not Found',
                        text: 'The entered student ID was not found. Please try again.',
                    });
                } else {
                    // Update the content area with the fetched data
                    $("#content").html(data);
                }
            },
            error: function () {
                console.error("Error in AJAX request");
            }
        });
    });
});


 


</script>
<script>
    function showPopup(message) {
        alert(message); // You can use any other pop-up mechanism here
    }
    
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

    

            <?php
        
    } else if (empty($student_id)) {
        echo "<script>
            alert('No student ID provided');
            location.href = 'student_info.php';
        </script>";
    }
    
    else {
        echo "<script>
        alert('student id not found: $student_id');
        location.href = 'student_info.php';
        </script>";
    }
    
} else {
    echo "<script>
    alert('No student found with ID: $student_id');
    location.href = 'student_info.php';
  </script>";
}

}
?>
