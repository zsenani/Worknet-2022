<?php
session_start();
include 'config.php';

if(isset($_GET['approve'])){
  $id  = $_GET['approve'];
  $sql= "UPDATE request SET status='Approved' WHERE id='$id'";
 $result= mysqli_query($db, $sql);
  if(isset($_GET['file'])){
    $file=$_GET['file'];
    header('Location: '.$file.'?msg=approve Successfully&&reqID='.$id.'');
}}

if(isset($_GET['Decline'])){
    $id  = $_GET['Decline'];
    $sql= "Update request SET status='Declined' WHERE id='$id'";
    $result= mysqli_query($db, $sql);
     if(isset($_GET['file'])){
    $file=$_GET['file'];
    header('Location: '.$file.'?msg=Decline Successfully&&reqID='.$id.'');
}
}
  if (isset($_GET['reqID'])){
    $reqid = $_GET['reqID'];
    $sql4 = "SELECT * FROM request WHERE id= '".$reqid."'";
    if($re = mysqli_query($db, $sql4)){
        $row = mysqli_fetch_assoc($re);
            $value = $row["description"];   
    }
    $des = json_encode($value,JSON_UNESCAPED_SLASHES);
    print $des;
    }
?>