<?php
require_once("ModelProduct.class.php");

$model = new ModelProduct;

switch($_GET["state"]){
  case "add":
    $model->add($_GET["id"],$_GET["name"]);
  break;

  case "remove":
    $model->remove($_GET["id"]);
  break;

  case "update":
    $model->update($_GET["id"],$_GET["name"]);
  break;
}
