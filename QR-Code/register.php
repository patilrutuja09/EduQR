<?php
include_once('connection.php');
if($_SERVER["REQUEST_METHOD"]=="POST")
{
if(isset($_POST['register']))
{
    $name=$_POST['name'];
    $email=$_POST['email'];
    $pass=$_POST['pass'];
    $contact=$_POST['contact'];

    $query="INSERT INTO `tblregister`(`name`,`email`,`pass`,`contact`)VALUES ('$name','$email','$pass','$contact')";
   $result= mysqli_query($link,$query);
   
    $res=array();
    if($result)
    {
        $res['result']=1;
        echo json_encode($res);
        header("Location:login.html");
    }
    else{
        $res['result']=0;
        echo json_encode($res); 
    }
}
}
?>