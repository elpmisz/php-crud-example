<?php if (isset($_COOKIE['alert']) && !empty($_COOKIE['alert']) && isset($_COOKIE['text']) && !empty($_COOKIE['text'])) : ?>
  <div class="toast-container top-0 end-0 p-3">
    <div class="toast align-items-center text-bg-<?php echo $_COOKIE['alert'] ?> border-0 fade show">
      <div class="d-flex">
        <div class="toast-body">
          <h5><?php echo $_COOKIE['text'] ?></h5>
        </div>
        <i class="fa fa-times fa-xl me-3 m-auto" data-bs-dismiss="toast"></i>
      </div>
    </div>
  </div>
<?php
  setcookie("alert", null, -1);
  setcookie("text", null, -1);
endif;
?>

<script src="/vendor/components/jquery/jquery.min.js"></script>
<script src="/vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="/assets/javascript/jquery.dataTables.min.js"></script>
<script src="/assets/javascript/dataTables.bootstrap.min.js"></script>
<script src="/assets/javascript/sweetalert2.all.min.js"></script>
<script src="/assets/javascript/axios.min.js"></script>
<script src="/assets/javascript/main.js"></script>
</body>

</html>