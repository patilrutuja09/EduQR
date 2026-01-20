<?php
include_once("connection.php");
if(isset($_POST['upload_photo']))
{

  $name=$_POST['name'];
  $prn=$_POST['prn'];


    $target_dir = "uploads/";
    $countfiles = count($_FILES['uploadfile']['name']);
    $files="";
    for($i=0;$i<$countfiles;$i++){

    $target_file = $target_dir .uniqid(). basename($_FILES["uploadfile"]["name"][$i]);
    $files= $files.$target_file.'~';
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    if (move_uploaded_file($_FILES["uploadfile"]["tmp_name"][$i], $target_file)) {
        // "The file ". htmlspecialchars( basename( $_FILES["uploadfile"]["name"][$i])). " has been uploaded.";
      } else {
       // echo "Sorry, there was an error uploading your file.";
      }

    }

  
    // $photo = $_POST['photo'];
    $query="INSERT INTO `tblupload` (`name`,`prn`,`screenshot`) VALUES ('$name','$prn','$target_file')";
         $result=mysqli_query($GLOBALS['link'],$query);
        // echo $query;
         $res=array();
                if($result)
                {
                    $res['result']=1;
                    header('Location:view.php');
                    //echo "Yor car added successfuly"; 
                }
            else
        {
            $res['result']=0;
            echo "Some thing went wrong"; 
        }
      }

?>