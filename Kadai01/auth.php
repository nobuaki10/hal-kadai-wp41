<?php
  $users = ["a" => "a","b" => "b","c" => "c"];
  if(isset($_POST["k"])){
    foreach($users as $id => $pass){
      if($_POST["id"] == $id && $_POST["pass"] == $pass){
        header("Location: member.html");
        exit;
      }
    }
    header("Location: index.php?error_no=4");
    exit;
  }
  header("Location: index.php?error_no=1");
