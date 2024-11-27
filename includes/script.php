
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11">

</script>
<script src="sweetalert2.js"></script>
<script>
    Swal.fire({
  title: "The Internet?",
  text: "That thing is still around?",
  icon: "question"
});

<?php
if(isset($_SESSION['status']) && $_SESSION['status'] !='')
{
    ?>
    <script>
    Swal.fire({
    title: "<?php echo $_SESSION['status']; ?>",
    icon: "<?php echo $_SESSION['status_code']; ?>",
    button: "done",
    });

    </script>
    <?php
    unset($_SESSION['status']);
}
?>

