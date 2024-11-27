
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="logo-image">
    <img src="img/logobg.png" alt="" style="max-width: 60px; height: auto;">
</div>
<div class="sidebar-brand-text mx-3">Admin</div>
<style>
    .logo-image img {
    max-width: 150px;
    height: auto;
}

</style>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    

   

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
     <!-- Nav Item - Charts -->




    <li class="nav-item">
        <a class="nav-link" href="Teacher.php">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Manage Subject</span></a>
    </li>
        
    <li class="nav-item">
        <a class="nav-link" href="login.php">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Manage Student</span></a>
    </li>
        

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Manage Evaluation</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Category</h6>
                <a class="collapse-item" href="question.php">Manage Question</a>
                
                <a class="collapse-item" href="evaluateTeacher.php">Evaluate Teacher</a>
                <a class="collapse-item" href="evaluationstatus.php">Evaluation status</a>
                <a class="collapse-item" href="top_rateteacher.php">Teacher ranking</a>
            </div>
        </div>
    </li>

   

    

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="logout.php">
            <i class="fas fa-fw fa-table"></i>
            <span>Log out</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    

    <!-- Sidebar Message -->
   

</ul>
<!-- End of Sidebar -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>
<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="logout.php">Logout</a>
            </div>
        </div>
    </div>
</div>
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>



