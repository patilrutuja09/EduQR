<?php
$link= new mysqli("localhost","root","","dbqr");

if (mysqli_connect_errno())
  {

  echo "Failed to connect to MySQL: " . mysqli_connect_error();

  }
  else{
      //echo "success";
  }


mysqli_select_db($link,"dbqr");
?>