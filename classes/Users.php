<?php

namespace app\classes;

use PDO;

class Users
{
  private $dbcon;

  public function __construct()
  {
    $db = new Database();
    $this->dbcon = $db->getConnection();
  }

  public function count($data)
  {
    $sql = "SELECT COUNT(*) FROM jwt.crud WHERE email = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchColumn();
  }

  public function detail($data)
  {
    $sql = "SELECT * FROM jwt.crud WHERE email = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function create($data)
  {
    $sql = "INSERT INTO crud(name,email) VALUES(?,?)";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function update($data)
  {
    $sql = "UPDATE crud SET
    name = ?,
    email = ?,
    updated = NOW()
    WHERE id = ?";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function delete($data)
  {
    $sql = "DELETE FROM crud WHERE id = ?";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function view($data)
  {
    $sql = "SELECT * FROM crud WHERE id = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function all()
  {
    $sql = "SELECT name,email,created FROM crud";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function excel()
  {
    $sql = "SELECT name,email,created FROM crud";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_NUM);
  }

  public function data()
  {
    $sql = "SELECT COUNT(*) FROM crud";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    $count = $stmt->fetchColumn();

    $column = ["id", "name", "email", "created"];

    $keyword = (isset($_POST['search']['value']) ? $_POST['search']['value'] : "");
    $order = (isset($_POST['order']) ? $_POST['order'] : "");
    $order_column = (isset($_POST['order']['0']['column']) ? $_POST['order']['0']['column'] : "");
    $order_dir = (isset($_POST['order']['0']['dir']) ? $_POST['order']['0']['dir'] : "");
    $limit_start = (isset($_POST['start']) ? $_POST['start'] : "");
    $limit_length = (isset($_POST['length']) ? $_POST['length'] : "");
    $draw = (isset($_POST['draw']) ? $_POST['draw'] : "");

    $sql = "SELECT id,name,email,created FROM crud ";

    if ($keyword) {
      $sql .= " WHERE (name LIKE '%{$keyword}%' OR email LIKE '%{$keyword}%') ";
    }

    if ($order) {
      $sql .= "ORDER BY {$column[$order_column]} {$order_dir} ";
    } else {
      $sql .= "ORDER BY created ASC ";
    }

    $query = "";
    if (!empty($limit_length)) {
      $query .= "LIMIT {$limit_start}, {$limit_length}";
    }

    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    $filter = $stmt->rowCount();
    $stmt = $this->dbcon->prepare($sql . $query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $data = [];
    foreach ($result as $row) {
      $view = "<a href='/view/{$row['id']}' class='badge text-bg-primary fw-lighter'>view</a> <a href='javascript:void(0)' class='badge text-bg-danger fw-lighter user-delete' id='{$row['id']}'>delete</a>";

      $data[] = [
        $view,
        $row['name'],
        $row['email'],
        $row['created'],
      ];
    }

    $output = [
      "draw"    => $draw,
      "recordsTotal"  =>  $count,
      "recordsFiltered" => $filter,
      "data"    => $data
    ];

    return $output;
  }
}
