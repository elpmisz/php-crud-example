<?php

use app\classes\Users;

include_once(__DIR__ . "/../../vendor/autoload.php");

$Users = new Users();

$result = $Users->all();

// echo "<pre>";
// print_r($result);
// die();

ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<title>CRUD</title>

<head>
  <meta charset="UTF-8">
  <style>
    * {
      padding: 5px;
    }

    table {
      width: 100%;
      font-size: 80%;
      vertical-align: top;
      border-collapse: collapse;
      margin-bottom: 20px;
    }

    table td,
    table th {
      padding: 5px;
      vertical-align: middle;
      white-space: nowrap;
    }

    table.border td,
    table.border th {
      border: 1px solid #000;
      padding: 7px;
      vertical-align: middle;
      white-space: nowrap;
    }

    .text-center {
      text-align: center !important;
    }

    .text-right {
      text-align: right !important;
    }

    .text-bold {
      font-weight: bold;
    }
  </style>
</head>

<body>
  <table class="border">
    <tr>
      <th width="10%">#</th>
      <th width="40%">Name</th>
      <th width="30%">E-Mail</th>
      <th width="20%">Created</th>
    </tr>
    <?php
    foreach ($result as $key => $user) : $key++;
    ?>
      <tr>
        <td class="text-center">
          <?php echo $key ?>
        </td>
        <td>
          <?php echo $user['name'] ?>
        </td>
        <td>
          <?php echo $user['email'] ?>
        </td>
        <td class="text-center">
          <?php echo $user['created'] ?>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
</body>

</html>
<?php
$html = ob_get_contents();
ob_end_clean();

$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'default_font' => 'garuda', 'margin_top' => 22]);

$header = '<table>
<tr><td class="text-center"><h3>CRUD</h3></td></tr>
</table>';

$footer = '
<table>
  <tr>
    <td><h5>Prited: {DATE Y/m/d H:i}</h5></td>
  </tr>
</table>';

$mpdf->SetHTMLHeader($header);
$mpdf->SetHTMLFooter($footer);

$date = date('Ymd');

$mpdf->WriteHTML($html);
$mpdf->Output("{$date}_crud.pdf", 'I');
