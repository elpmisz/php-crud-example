<?php

use app\classes\Users;
use app\classes\Validation;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

include_once(__DIR__ . "/../../vendor/autoload.php");

$Users = new Users();
$Validation = new Validation();

$result = $Users->excel();

$Spreadsheet = new Spreadsheet();
$Writer = new Xlsx($Spreadsheet);

$Spreadsheet->setActiveSheetIndex(0);
$ActiveSheet = $Spreadsheet->getActiveSheet();

$columns = ["Name", "E-Mail", "Created"];

$letter = $Validation->letters((COUNT($columns) + 1));

$letters = [];
for ($i = "A"; $i !== $letter; $i++) {
  $letters[] = $i;
}

$arr_columns = array_combine($letters, $columns);

$styleHeader = [
  "font" => [
    "bold" => true,
  ],
  "alignment" => [
    "horizontal" => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
  ],
  "borders" => [
    "allBorders" => [
      "borderStyle" => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
    ],
  ]
];

$ActiveSheet->getStyle("A2:" . end($letters) . "2")->applyFromArray($styleHeader);
$styleData = [
  "borders" => [
    "allBorders" => [
      "borderStyle" => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
    ]
  ],
];

$ActiveSheet->mergeCells("A1:C1")->setCellValue("A1", "CRUD")->getStyle("A1:C1")->applyFromArray($styleHeader);

foreach ($arr_columns as $key => $value) {
  $ActiveSheet->setCellValue($key . "2", $value);
  $ActiveSheet->getColumnDimension($key)->setAutoSize(true);
}

foreach ($result as $key => $value) {
  $key++;
  foreach ($letters as $k => $v) {
    $ActiveSheet->setCellValue($v . ($key + 2), str_replace("\r\n", " ", $value[$k]));
    $ActiveSheet->getStyle($v . ($key + 2) . ":" . end($letters) . ($key + 2))->applyFromArray($styleData);
  }
}

$date = date('Ymd');
$filename = $date . "_crud.xlsx";
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment;filename=" . $filename);
header("Cache-Control: max-age=0");
$Writer->save("php://output");
exit();
