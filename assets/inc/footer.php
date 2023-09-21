<?php if (isset($_SESSION['alert']) && !empty($_SESSION['alert']) && isset($_SESSION['text']) && !empty($_SESSION['text'])) : ?>
  <div class="toast-container top-0 end-0 p-3">
    <div class="toast align-items-center text-bg-<?php echo $_SESSION['alert'] ?> border-0 fade show">
      <div class="d-flex">
        <div class="toast-body">
          <?php echo $_SESSION['text'] ?>
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>
  </div>
<?php
  unset($_SESSION['alert'], $_SESSION['text']);
endif;
?>

<script src="/vendor/components/jquery/jquery.min.js"></script>
<script src="/vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="/assets/javascript/jquery.dataTables.min.js"></script>
<script src="/assets/javascript/dataTables.bootstrap.min.js"></script>
<script src="/assets/javascript/sweetalert2.all.min.js"></script>
<script src="/assets/javascript/main.js"></script>
</body>

</html>