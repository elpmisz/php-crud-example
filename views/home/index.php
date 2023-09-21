<?php include_once(__DIR__ . "/../../assets/inc/header.php"); ?>

<div class="container my-5">
  <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-header">
          <h4 class="text-center">CRUD</h4>
        </div>
        <div class="card-body">
          <div class="row justify-content-end mb-3">
            <div class="col-xl-3">
              <a href="/pdf" class="btn btn-sm btn-danger w-100"><i class="fa fa-file-pdf fa-lg pe-2"></i>PDF</a>
            </div>
            <div class="col-xl-3">
              <a href="/excel" class="btn btn-sm btn-success w-100"><i class="fa fa-file-excel fa-lg pe-2"></i>EXCEL</a>
            </div>
            <div class="col-xl-3">
              <a href="/request" class="btn btn-sm btn-primary w-100"><i class="fa fa-plus fa-lg pe-2"></i>Request</a>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-xl-12">
              <div class="table-responsive">
                <table class="table table-sm table-bordered table-hover data w-100">
                  <thead>
                    <tr>
                      <th width="10%">#</th>
                      <th width="40%">Name</th>
                      <th width="30%">E-Mail</th>
                      <th width="20%">Created</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include_once(__DIR__ . "/../../assets/inc/footer.php"); ?>
<script>
  $(".data").DataTable({
    serverSide: true,
    scrollX: true,
    searching: true,
    order: [],
    ajax: {
      url: "/data",
      type: "POST",
    },
    columnDefs: [{
      targets: [0, 3],
      className: "text-center",
    }],
  });

  $(document).on("click", ".user-delete", function(e) {
    let id = $(this).prop("id");
    e.preventDefault();
    Swal.fire({
      title: "Confirm?",
      icon: "question",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Submit",
      cancelButtonText: "Close",
    }).then((result) => {
      if (result.value) {
        window.location.href = "/delete/" + id;
      } else {
        return false;
      }
    })
  });
</script>