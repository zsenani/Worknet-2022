<?php




include 'config.php';
if(isset($_POST['id'])){
    $id  = $_POST['id'];
    $service_id  = $_POST['service_id'];
    $description = $_POST['Description']; 
    
    
    $sql= 'UPDATE `Request` SET `service_id`="'.$service_id.'", `description`="'.$description.'" WHERE id='.$id.' ';
    $result= mysqli_query($db, $sql);
    $msg="info Updated Successfully";
    
    $uploadFileDir = 'uploads//';

    if(!empty($_FILES['image']['name'])){
        
      $imageName = $_FILES['image']['name'];
      $imageTmp	= $_FILES['image']['tmp_name'];
      $ex1 = explode('.', $imageName);
      $fileExtension1 = strtolower(end($ex1));
      if($imageName == null){
        $new_name1 = null;
    }else{
    $new_name1 = uniqid('',true) . '.' . $fileExtension1;}
      move_uploaded_file($imageTmp, $uploadFileDir . $new_name1);
      $sql= 'UPDATE `Request` SET  `attachment1`="'.$new_name1.'" ,`attach1_name`="'.$imageName.'" WHERE id='.$id.' ';
      $result= mysqli_query($db, $sql);
      
    }

    if(!empty($_FILES['file1']['name'])){
        
      $fileName = $_FILES['file1']['name'];
      $fileTmp	= $_FILES['file1']['tmp_name'];
      $ex2  = explode('.', $fileName);
      $fileExtension2 = strtolower(end($ex2));
      if($fileName == null){
        $new_name2 = null;
    }else{
    $new_name2 = uniqid('',true).'.'.$fileExtension2;}
      move_uploaded_file($fileTmp, $uploadFileDir . $new_name2);
      $sql= 'UPDATE `Request` SET  `attachment2`="'.$new_name2.'" ,`attach2_name`="'.$fileName.'"  WHERE id='.$id.' ';
      $result= mysqli_query($db, $sql);
      
      
      
    }

    if($result){
    header('Location: reqInfo.php?msg='.$msg.'&&reqID='.$id);
    }
 }