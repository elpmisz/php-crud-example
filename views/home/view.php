<?php

use app\classes\Users;

include_once(__DIR__ . "/../../assets/inc/header.php");
$param = (isset($params) ? explode("/", $params) : header("Location: /error"));
$id = (isset($param[0]) ? $param[0] : die(header("Location: /error")));

$User = new Users();

$user = $User->view([$id]);
?>

<div class="container my-5">
  <div class="row">
    <div class="col-xl-12">
      <div class="card text-center">
        <div class="card-header">
          <h4>REQUEST</h4>
        </div>
        <div class="card-body">
          <form action="/update" method="post" class="needs-validation" novalidate>
            <div class="row mb-3" style="display: none;">
              <label class="col-xl-4">ID</label>
              <div class="col-xl-4">
                <input type="text" class="form-control form-control-sm" name="id" value="<?php echo $user['id'] ?>" readonly>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-xl-4">Name</label>
              <div class="col-xl-4">
                <input type="text" class="form-control form-control-sm" name="name" value="<?php echo $user['name'] ?>" required>
                <div class="invalid-feedback text-start">
                  Require!
                </div>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-xl-4">E-Mail</label>
              <div class="col-xl-4">
                <input type="email" class="form-control form-control-sm" name="email" value="<?php echo $user['email'] ?>" required>
                <div class="invalid-feedback text-start">
                  Require!
                </div>
              </div>
            </div>
            <div class="row justify-content-center">
              <div class="col-xl-3 mb-3">
                <button type="submit" class="btn btn-sm btn-primary w-100"><i class="fa fa-check fa-lg pe-2"></i>Submit</button>
              </div>
              <div class="col-xl-3 mb-3">
                <a href="/" class="btn btn-sm btn-danger w-100"><i class="fa fa-arrow-left fa-lg pe-2"></i>Back to home</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include_once(__DIR__ . "/../../assets/inc/footer.php"); ?>