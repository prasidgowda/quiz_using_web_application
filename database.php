<?php
  $dbhost="localhost";
  $dbuser="root";
  $dbpswd=""; //pswd can check in xampp-phpmyadmin-config.inc
  $dbname="quiz";

  $connection=mysqli_connect($dbhost,$dbuser,$dbpswd,$dbname);

  if(mysqli_connect_errno()){
    die("Database connection failed".mysqli_connect_error());
  }
  
?>