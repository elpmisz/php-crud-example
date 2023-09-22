<?php

declare(strict_types=1);

use app\classes\Users;
use app\classes\Validation;

ini_set("display_errors", "1");
ini_set("display_startup_errors", "1");
error_reporting(E_ALL);

require_once(__DIR__ . "/../../vendor/autoload.php");

$Users = new Users();
$Validation = new Validation();

$param = (isset($params) ? explode("/", $params) : header("Location: /error"));
$action = (isset($param[0]) ? $param[0] : die(header("Location: /error")));
$param1 = (isset($param[1]) ? $param[1] : "");
$param2 = (isset($param[2]) ? $param[2] : "");

if ($action === "create") {
  try {
    $name = (isset($_POST['name']) ? $Validation->input($_POST['name']) : "");
    $email = (isset($_POST['email']) ? $Validation->input($_POST['email']) : "");

    $count = $Users->count([$email]);
    if (intval($count) !== 0) {
      $Validation->alert("danger", "E-Mail Already in use!", "/");
    }

    $Users->create([$name, $email]);

    $Validation->alert("success", "Created!", "/");
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "update") {
  try {
    $id = (isset($_POST['id']) ? $Validation->input($_POST['id']) : "");
    $name = (isset($_POST['name']) ? $Validation->input($_POST['name']) : "");
    $email = (isset($_POST['email']) ? $Validation->input($_POST['email']) : "");

    $Users->update([$name, $email, $id]);

    $Validation->alert("success", "Updated!", "/");
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "delete") {
  try {
    $obj = json_decode(file_get_contents('php://input'));
    $id = $obj->id;
    if (!empty($id)) {
      $Users->delete([$id]);
      $Validation->alert("success", "Deleted!");
      echo json_encode(200);
    } else {
      $Validation->alert("danger", "Error!");
      echo json_encode(500);
    }
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "data") {
  try {
    $data = $Users->data();
    echo json_encode($data);
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}
