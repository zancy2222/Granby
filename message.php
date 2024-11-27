<?php
if (isset($_SESSION['message'])) :
?>



<!-- Modal -->
<div class="modal fade" id="messageModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
          <span class="bi bi-exclamation-triangle"></span> Message!
        </h5>
       
      </div>
      <div class="modal-body">
        <?php echo $_SESSION['message']; ?>
      </div>
      <div class="modal-footer">
      <input type="button" class="btn btn-success" data-dismiss="modal" value="Done">
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap Icons -->


<script>
  // Function to close the modal
  function closeModal() {
    var myModal = new bootstrap.Modal(document.getElementById('messageModal'));
    myModal.hide();
  }

  // Trigger the modal using JavaScript
  document.addEventListener('DOMContentLoaded', function () {
    var myModal = new bootstrap.Modal(document.getElementById('messageModal'));
    myModal.show();
  });
</script>

<?php
unset($_SESSION['message']);
endif;
?>
