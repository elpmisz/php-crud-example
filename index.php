<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once(__DIR__ . "/vendor/autoload.php");
$Router = new AltoRouter();

$Router->map("GET", "/", function () {
  require(__DIR__ . "/views/home/index.php");
});
$Router->map("GET", "/request", function () {
  require(__DIR__ . "/views/home/request.php");
});
$Router->map("GET", "/view/[**:params]", function ($params) {
  require(__DIR__ . "/views/home/view.php");
});
$Router->map("GET", "/excel", function () {
  require(__DIR__ . "/views/home/excel.php");
});
$Router->map("GET", "/pdf", function () {
  require(__DIR__ . "/views/home/pdf.php");
});
$Router->map("GET", "/logout", function () {
  require(__DIR__ . "/views/home/logout.php");
});
$Router->map("POST", "/[**:params]", function ($params) {
  require __DIR__ . "/views/home/action.php";
});

###########################################
$Router->map("GET", "/error", function () {
  require(__DIR__ . "/views/home/error.php");
});

$Match = $Router->match();

if (is_array($Match) && is_callable($Match['target'])) {
  call_user_func_array($Match['target'], $Match['params']);
} else {
  header("HTTP/1.1 404 Not Found");
  require __DIR__ . "/views/home/error.php";
}
