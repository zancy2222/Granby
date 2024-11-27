<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.19.0/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


<?php

include('dbcon.php');
session_start();



if ($login_success) {
    $_SESSION['id'] = $user_id; // Set user id in session
    $_SESSION['username'] = $username; // Set username in session
    $_SESSION['password'] = $password; // Set password in session (or a hashed password/token for security)
    header('Location: Teacher.php'); // Redirect to a logged-in page after successful login
    exit();
}
include('includes/header.php');
include('includes/navbar.php');
include('message.php');

$teacherId = $_GET['id'];
$query = "SELECT * FROM teacher WHERE id = '$teacherId'";
$result = mysqli_query($con, $query);
$teacher = mysqli_fetch_assoc($result);

// Get all available subjects
$subjectQuery = "SELECT DISTINCT Tsubject FROM teacher ORDER BY Tsubject";
$subjectResult = mysqli_query($con, $subjectQuery);
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>






        </nav>

        <div class="container-xl color">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Evaluate <b>Teachers</b></h2>
                    </div>
                    <div class="col-sm-6">
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Subject</th>
                        <th>School</th>
                        <th>Section</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM teacher";
                    $query_run = mysqli_query($con, $query);

                    if ($query_run) {
                        // Pagination logic
                        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                        $entriesPerPage = 8;
                        $offset = ($currentPage - 1) * $entriesPerPage;

                        // Query to fetch data with LIMIT
                        $query = "SELECT * FROM teacher LIMIT $offset, $entriesPerPage";
                        $query_run = mysqli_query($con, $query);

                        // Calculate total entries and total pages
                        $totalEntriesQuery = "SELECT COUNT(*) as total FROM teacher";
                        $totalEntriesResult = mysqli_query($con, $totalEntriesQuery);
                        $totalEntries = mysqli_fetch_assoc($totalEntriesResult)['total'];
                        $totalPages = ceil($totalEntries / $entriesPerPage);

                        foreach ($query_run as $teacher) {
                    ?>
                            <tr>
                                <td>
                                    <img src="<?= htmlspecialchars($teacher['image_path']); ?>" alt="<?= htmlspecialchars($teacher['Tname']); ?>" width="50">
                                </td>
                                <td><?= htmlspecialchars($teacher['id']); ?></td>
                                <td><?= htmlspecialchars($teacher['Tname']); ?></td>
                                <td><?= htmlspecialchars($teacher['Tsubject']); ?></td>
                                <td><?= htmlspecialchars($teacher['Branch']); ?></td>
                                <td><?= htmlspecialchars($teacher['Section']); ?></td>
                                <td>
                                    <a href="rateTeacher.php?teacher_id=<?= htmlspecialchars($teacher['id']); ?>" class="icon-link" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>

                            <!-- Edit Teacher Modal -->
                            <div id="editTeacherModal<?= $teacher['id']; ?>" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="edit_teacher.php" method="post">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Edit Teacher</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" name="id" value="<?= $teacher['id']; ?>">
                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input type="text" name="Tname" value="<?= $teacher['Tname']; ?>" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Subject</label>
                                                    <input type="text" name="Tsubject" value="<?= $teacher['Tsubject']; ?>" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                                <button type="submit" class="btn btn-primary" name="update_teacher">Save Changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="clearfix"></div>
            <ul class="pagination">
                <li class="page-item <?= $currentPage <= 1 ? 'disabled' : ''; ?>">
                    <a href="?page=<?= $currentPage - 1; ?>" class="page-link">Previous</a>
                </li>

                <?php for ($page = 1; $page <= $totalPages; $page++) : ?>
                    <li class="page-item <?= $page == $currentPage ? 'active' : ''; ?>">
                        <a href="?page=<?= $page; ?>" class="page-link"><?= $page; ?></a>
                    </li>
                <?php endfor; ?>

                <li class="page-item <?= $currentPage >= $totalPages ? 'disabled' : ''; ?>">
                    <a href="?page=<?= $currentPage + 1; ?>" class="page-link">Next</a>
                </li>
            </ul>
        </div>
    </div>
</div>


        <!-- Add Teacher Modal -->
        <div id="addTeacherModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h4 class="modal-title">Add Teacher</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="Tname" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="Tsubject">Subject</label>
                                <div class="dropdown">
                                    <input type="text" id="subjectInput" class="form-control" name="Tsubject" value="<?php echo htmlspecialchars($teacher['Tsubject']); ?>" autocomplete="off" placeholder="Select or type a subject..." required>
                                    <div id="dropdownOptions" class="dropdown-content">
                                        <?php
                                        while ($subjectRow = mysqli_fetch_assoc($subjectResult)) {
                                            $subject = htmlspecialchars($subjectRow['Tsubject']);
                                            echo "<option class='dropdown-item'>$subject</option>";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Branch</label>
                                <select name="Branch" id="branchSelect" class="form-control" required>
                                    <option value="">Select Branch</option>
                                    <?php
                                    foreach ($branchesCoursesSection as $branch => $sections) {
                                        echo "<option value='" . $branch . "'>" . $branch . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Section</label>
                                <select name="Section" id="sectionSelect" class="form-control" required>
                                    <option value="">Select Section</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Upload Image</label>
                                <input type="file" name="image" class="form-control-file" accept="image/*" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                            <button type="submit" class="btn btn-success" name="save_teacher">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var input = document.getElementById('subjectInput');
                var dropdown = document.getElementById('dropdownOptions');

                input.addEventListener('focus', function() {
                    dropdown.style.display = 'block';
                });

                input.addEventListener('blur', function() {
                    setTimeout(function() {
                        dropdown.style.display = 'none';
                    }, 200);
                });

                input.addEventListener('input', function() {
                    var filter = input.value.toUpperCase();
                    var options = dropdown.getElementsByTagName('option');
                    for (var i = 0; i < options.length; i++) {
                        if (options[i].innerHTML.toUpperCase().indexOf(filter) > -1) {
                            options[i].style.display = '';
                        } else {
                            options[i].style.display = 'none';
                        }
                    }
                });

                dropdown.addEventListener('click', function(e) {
                    if (e.target && e.target.nodeName == 'OPTION') {
                        input.value = e.target.innerHTML;
                        dropdown.style.display = 'none';
                    }
                });
            });
        </script>

        <script>
            $(document).ready(function() {
                $('#branchSelect').change(function() {
                    var branch = $(this).val();
                    var sections = <?php echo json_encode($branchesCoursesSection); ?>;
                    $('#sectionSelect').empty();
                    $('#sectionSelect').append('<option value="">Select Section</option>');
                    $.each(sections[branch], function(key, value) {
                        $('#sectionSelect').append('<option value="' + value + '">' + value + '</option>');
                    });
                });
            });
        </script>



        <div id="successModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Success</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Changes saved successfully!</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="errorModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Error</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Error occurred while saving changes!</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>



        <div id="addEmployeeModal" class="modal fade">

            <?php include('message.php'); ?>
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="" method="post">
                        <div class="modal-header">

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
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="" method="post">
                        <div class="modal-header">
                            <h4 class="modal-title">Delete Student</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete this record?</p>
                            <p class="text-warning"><small>This action cannot be undone.</small></p>
                            <!-- Hidden input to store student_id -->
                            <input type="hidden" id="delete_student_id" name="delete_students" value="">
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                            <button type="submit" class="btn btn-danger" value="Delete" name="delete">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var subjectInput = document.getElementById('subjectInput');
            var dropdownOptions = document.getElementById('dropdownOptions');
            var dropdownItems = dropdownOptions.getElementsByClassName('dropdown-item');

            subjectInput.addEventListener('focus', function() {
                dropdownOptions.parentElement.classList.add('show');
            });

            subjectInput.addEventListener('input', function() {
                var filter = subjectInput.value.toLowerCase();
                Array.from(dropdownItems).forEach(function(item) {
                    var text = item.textContent || item.innerText;
                    item.style.display = text.toLowerCase().indexOf(filter) > -1 ? '' : 'none';
                });
            });

            Array.from(dropdownItems).forEach(function(item) {
                item.addEventListener('click', function() {
                    subjectInput.value = item.textContent;
                    dropdownOptions.parentElement.classList.remove('show');
                });
            });

            document.addEventListener('click', function(event) {
                if (!event.target.closest('.dropdown')) {
                    dropdownOptions.parentElement.classList.remove('show');
                }
            });
        });
    </script>


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

            $('#editstudent').modal('show');
        });
    </script>


    <script>
        $(document).ready(function() {
            // Add an event listener to the search button
            $("#searchButton").click(function() {
                // Get the search query
                var searchQuery = $("#searchInput").val();

                // Perform an AJAX request to fetch and update content based on the search query
                $.ajax({
                    type: "GET",
                    url: "search.php",
                    data: {
                        student_id: searchQuery
                    }, // Pass the search query to the server
                    success: function(data) {
                        // Update the content area with the fetched data
                        $("#content").html(data);
                    },
                    error: function() {
                        console.error("Error in AJAX request");
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.delete').click(function() {
                var student_id = $(this).data('studentid');
                $('#delete_student_id').val(student_id);
            });
        });
    </script>




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


    <style>
        /* Dropdown styling */
        .dropdown {
            position: relative;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: white;
            min-width: 100%;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
            max-height: 150px;
            overflow-y: auto;
        }

        .dropdown-item {
            padding: 8px 16px;
            cursor: pointer;
        }

        .dropdown-item:hover {
            background-color: #ddd;
        }

        .dropdown.show .dropdown-content {
            display: block;
        }


        body {
            color: #566787;
            background: #f5f5f5;
            font-family: 'Varela Round', sans-serif;
            font-size: 13px;
        }

        .table-responsive {
            margin: 30px 0;

        }

        .table-wrapper {
            background: #fff;
            padding: 20px 25px;
            border-radius: 3px;
            min-width: 1000px;
            box-shadow: 0 1px 1px rgba(0, 0, 0, .05);

        }

        .table-title {
            padding-bottom: 15px;
            background: #4e73df;
            color: #fff;
            padding: 16px 30px;
            min-width: 100%;
            margin: -20px -25px 10px;
            border-radius: 3px 3px 0 0;
        }

        .table-title h2 {
            margin: 5px 0 0;
            font-size: 24px;
        }

        .table-title .btn-group {
            float: right;
        }

        .table-title .btn {
            color: #fff;
            float: right;
            font-size: 13px;
            border: none;
            min-width: 50px;
            border-radius: 2px;
            border: none;
            outline: none !important;
            margin-left: 10px;
        }

        .table-title .btn i {
            float: left;
            font-size: 21px;
            margin-right: 5px;
        }

        .table-title .btn span {
            float: left;
            margin-top: 2px;
        }

        table.table tr th,
        table.table tr td {

            border-color: #e9e9e9;
            padding: 5px 15px;
            vertical-align: middle;


        }


        table.table tr th:first-child {
            width: 60px;

        }

        table.table tr th:last-child {
            width: 100px;
        }

        table.table-striped tbody tr:nth-of-type(odd) {
            background-color: #fcfcfc;
        }

        table.table-striped.table-hover tbody tr:hover {
            background: #f5f5f5;
        }

        table.table th i {
            font-size: 13px;
            margin: 0 5px;
            cursor: pointer;
        }

        table.table td:last-child i {
            opacity: 0.9;
            font-size: 22px;
            margin: 0 5px;
        }

        table.table td a {
            font-weight: bold;
            color: #566787;
            display: inline-block;
            text-decoration: none;
            outline: none !important;
        }

        table.table td a:hover {
            color: #2196F3;
        }

        table.table td a.edit {
            color: #FFC107;
        }

        table.table td a.delete {
            color: #F44336;
        }

        table.table td i {
            font-size: 19px;
        }

        table.table .avatar {
            border-radius: 50%;
            vertical-align: middle;
            margin-right: 10px;
        }

        .pagination {
            float: right;
            margin: 0 0 5px;
        }

        .pagination li a {
            border: none;
            font-size: 13px;
            min-width: 30px;
            min-height: 30px;
            color: #999;
            margin: 0 2px;
            line-height: 30px;
            border-radius: 2px !important;
            text-align: center;
            padding: 0 6px;
        }

        .pagination li a:hover {
            color: #666;
        }

        .pagination li.active a,
        .pagination li.active a.page-link {
            background: #03A9F4;
        }

        .pagination li.active a:hover {
            background: #0397d6;
        }

        .pagination li.disabled i {
            color: #ccc;
        }

        .pagination li i {
            font-size: 16px;
            padding-top: 6px
        }

        .hint-text {
            float: left;
            margin-top: 10px;
            font-size: 13px;
        }

        /* Custom checkbox */
        .custom-checkbox {
            position: relative;
        }

        .custom-checkbox input[type="checkbox"] {
            opacity: 0;
            position: absolute;
            margin: 5px 0 0 3px;
            z-index: 9;
        }

        .custom-checkbox label:before {
            width: 18px;
            height: 18px;
        }

        .custom-checkbox label:before {
            content: '';
            margin-right: 10px;
            display: inline-block;
            vertical-align: text-top;
            background: white;
            border: 1px solid #bbb;
            border-radius: 2px;
            box-sizing: border-box;
            z-index: 2;
        }

        .custom-checkbox input[type="checkbox"]:checked+label:after {
            content: '';
            position: absolute;
            left: 6px;
            top: 3px;
            width: 6px;
            height: 11px;
            border: solid #000;
            border-width: 0 3px 3px 0;
            transform: inherit;
            z-index: 3;
            transform: rotateZ(45deg);
        }

        .custom-checkbox input[type="checkbox"]:checked+label:before {
            border-color: #03A9F4;
            background: #03A9F4;
        }

        .custom-checkbox input[type="checkbox"]:checked+label:after {
            border-color: #fff;
        }

        .custom-checkbox input[type="checkbox"]:disabled+label:before {
            color: #b8b8b8;
            cursor: auto;
            box-shadow: none;
            background: #ddd;
        }

        /* Modal styles */
        .modal .modal-dialog {
            max-width: 400px;
        }

        .modal .modal-header,
        .modal .modal-body,
        .modal .modal-footer {
            padding: 20px 30px;
        }

        .modal .modal-content {
            border-radius: 3px;
            font-size: 14px;
        }

        .modal .modal-footer {
            background: #ecf0f1;
            border-radius: 0 0 3px 3px;
        }

        .modal .modal-title {
            display: inline-block;
        }

        .modal .form-control {
            border-radius: 2px;
            box-shadow: none;
            border-color: #dddddd;
        }

        .modal textarea.form-control {
            resize: vertical;
        }

        .modal .btn {
            border-radius: 2px;
            min-width: 100px;
        }

        .modal form label {
            font-weight: normal;
        }

        .icon-link {
            color: #3498db;
            font-size: 18px;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .icon-link:hover {
            color: #2980b9;
        }
    </style>
    <script>
        $(document).ready(function() {
            // Activate tooltip
            $('[data-toggle="tooltip"]').tooltip();

            // Select/Deselect checkboxes
            var checkbox = $('table tbody input[type="checkbox"]');
            $("#selectAll").click(function() {
                if (this.checked) {
                    checkbox.each(function() {
                        this.checked = true;
                    });
                } else {
                    checkbox.each(function() {
                        this.checked = false;
                    });
                }
            });
            checkbox.click(function() {
                if (!this.checked) {
                    $("#selectAll").prop("checked", false);
                }
            });
        });
    </script>



    <?php
    include('includes/script.php');
    include('includes/footer.php');
    ?>