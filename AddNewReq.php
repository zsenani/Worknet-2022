<?php
include 'config.php';
session_start();
if ($_SESSION["role"] != "Employee" || !isset($_SESSION['id'])) {
    header("Location: index.php");
}
if (isset($_POST['addReq'])) {
    $emp_id = $_SESSION['id'];
    $service_id = $_POST['type'];
    $description = $_POST['description'];
    
    $uploadFileDir = 'uploads//';

    $fileName1 = $_FILES['attach1']['name'];
    $fileTmp1 = $_FILES['attach1']['tmp_name'];
    $ex1 = explode('.', $fileName1);
    $fileExtension1 = strtolower(end($ex1));
    if($fileName1 == null){
        $new_name1 = null;
    }else{
    $new_name1 = uniqid('',true) . '.' . $fileExtension1;}
    move_uploaded_file($fileTmp1, $uploadFileDir . $new_name1);
      
    
    
    $fileName2 = $_FILES['attach2']['name'];
    $fileTmp2 = $_FILES['attach2']['tmp_name'];
    $ex2  = explode('.', $fileName2);
    $fileExtension2 = strtolower(end($ex2));
    if($fileName2 == null){
        $new_name2 = null;
    }else{
    $new_name2 = uniqid('',true).'.'.$fileExtension2;}
    
    move_uploaded_file($fileTmp2, $uploadFileDir . $new_name2);
         
   
    

    $status = "In progress";

    $sql = "INSERT INTO Request(emp_id, service_id, description, attachment1, attachment2, status,attach1_name,attach2_name) VALUES ('$emp_id','$service_id','$description','$new_name1','$new_name2','$status','$fileName1','$fileName2')";
    $result = mysqli_query($db, $sql);
    $reqID = mysqli_insert_id($db); 
    
    // directory in which the uploaded file will be moved
    /*$uploadFileDir = '/Applications/MAMP/htdocs/';
    $fileExtension1 = substr($fileName1, strrpos($fileName1, '.') + 1);
    $fileExtension2 = substr($fileName2, strrpos($fileName2, '.') + 1);
    $newFileName1 = md5(time() . $fileName1) . '.' . $fileExtension1;
    $newFileName2 = md5(time() . $fileName2) . '.' . $fileExtension2;
    $dest_path1 = $uploadFileDir . $newFileName1;
    $dest_path2 = $uploadFileDir . $newFileName2;

     move_uploaded_file($fileTmp1, $dest_path1);
     move_uploaded_file($fileTmp2, $dest_path2);*/
    
    
    header('Location: reqInfo.php?reqID='.$reqID);
    
    

}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Add New Request</title>
        <link rel='stylesheet' href='css/add_editReq.css' type='text/css' media='all' />
        <link href="css/nav2.css" rel="stylesheet" type="text/css" media="all">
        <link href="css/nav.css" rel="stylesheet">
        <script src="js/Add_EditReq.js"></script>
    </head>
    <body>
        <div id="page">
            <div class="wrapper row1">
                <header id="header" class="hoc clear">
                    <div id="logo" class="fl_left">
                        <img style="height: 50px; width: 250px; margin-top: 20px;" src='img/logo.png' alt='logo'> 
                    </div>
                    <div class="navv">
                        <nav id="mainav" class="fl_right ">


                            <ul class="clear">
                                <li ><a href="emHomePage.php" accesskey="H">Home</a></li>

                                <li class="logout"><a href="signout.php"><img class="image2" src="img/sign-out.png" alt="sign out"></a></li>
                            </ul>

                        </nav>
                    </div>
                </header>
            </div>
           <br/><br/> <div class="fl_left"> 
            
        <ul class="clear" style="list-style-type: none;"> <li><a href="emHomePage.php"><img src="img//back.png" alt="return" height="30" width="30"></a></li> </ul>
        
        
         </div>

            <div class="container " id="editForm1">

                <h2 class="section-header hh">
                    Add Your Request 
                </h2>

                <form name="addReq" class="form1" action="AddNewReq.php" method="POST" enctype="multipart/form-data">
                    <fieldset>
                        <legend>ADD YOUR REQUEST</legend>
                        <br>
                        <br>
                        <label  placeholder="Request Type">Request Type: </label>
                        <select id="typeRQ" name="type">
                            <option value="1">Promotion</option>
                            <option value="2">Leave</option>
                            <option value="3">Resignation</option>
                            <option value="4">Allowance</option>
                            <option value="5">Health Insurance</option>
                            <option value="6">Other</option>
                        </select>
                        <br><br>

                        <label for="myfile">Attachments:</label>
                        <input type="file" id="myfile" name="attach1" >
                        <input type="file" id="myfile" name="attach2" >
                        <br>


                        <textarea name='description' placeholder='Request Description...' rows='6' cols='60'></textarea>


                        <br>
                       <input type="submit" class="submit"  name="addReq">
                          



                    </fieldset>
                </form>
            </div>		
            <div id="AfterSubmit">
                <h2 id="sentM">Your request was sent</h2>
                <a href="emHomePage.php"><img id="image2" src="img/back.png" alt="back"></a>
                <a href="AddNewReq.php"><img id="image3" src="img/add.jpg" alt="edit"></a>

            </div> 

            <br>

        </div>
        <div id="m" class="wrapper row5">
            <div id="copyright" class="hoc clear">
                <footer>
                    <p>Copyright &copy; 2022 worknet, inc.</p>
                </footer>
            </div>
        </div>
    </body>
</html>
