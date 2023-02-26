<?php
include 'config.php';
session_start();
if ($_SESSION["role"] != "Employee" || !isset($_SESSION['id'])) {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Request</title>
        <link rel='stylesheet' href='css/add_editReq.css' type='text/css' media='all' />
        <link href="css/nav2.css" rel="stylesheet" type="text/css" media="all">
        <link href="css/nav.css" rel="stylesheet">
        <script src="js/Add_EditReq.js"></script>
        <style>.form1{
                max-width: 500px;
                margin: auto;
            }
        </style>

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
            <br/><br/> <div class="fl_left"> <?php 
     //   echo'<ul class="clear" style="list-style-type: none;"> <li><a href="reqInfo.php"><img src="img//back.png" alt="return" height="30" width="30"></a></li> </ul>' ;

         ?></div>

            <div class="form1">
                <form action="edit.php"  method="POST" enctype="multipart/form-data" >

                    <?php
                    $id = $_GET["reqid"];
                  $sql = "SELECT * FROM Request INNER JOIN Service ON Request.service_id=Service.id WHERE Request.id='$id'";

                    $sql2 = "SELECT * FROM Service";
                    $result = mysqli_query($db, $sql);
                    $result2 = mysqli_query($db, $sql2);

                    if ($result->num_rows > 0) {
                        $row = mysqli_fetch_assoc($result);

                        echo '
	<div >
			<br>

	<form name="Edit" class="form1" action="reqInfo.php" method="POST">
	<fieldset>
	
		<legend>EDIT YOUR REQUEST</legend>
    <input type="hidden" name="id" value="' . $id . '" />
	        <p> Request type:</p> 

  <select id="typeRQ" name="service_id">
    
     <option value="' . $row['service_id'] . '">' . $row['type'] . '</option>
    <option value="1">Promotion</option>
    <option value="2">Leave</option>
    <option value="3">Resignation</option>
    <option value="4">Allowance</option>
	<option value="5">Health Insurance</option>
	<option value="6">Other</option>
	    
  </select>
  <br>
  <br>
  <label for="Description" >Request Description:</label> <br>
   <input type="textarea" id="des" value="' . $row['description'] . '"   name="Description" rows="8" cols="30" size="70">
		<br>

   <label for="Attachments" >Attachment1:';
       if($row['attach1_name']==null){
        echo ' <input type="textarea" placeholder="There is no attachment chosen" rows="8" cols="30" size="70">
	   Choose Attachment:';
}
   else{
     echo ' <input type="textarea" value="' . $row['attach1_name'] . '" rows="8" cols="30" size="70">
     Change Attachment:';
   }  echo ' <input type="file" name="image" id="img"  value="' . $row['attach1_name'] . '"  >
   </label> <br>

   <label for="file" >Attachment2:';
    if($row['attach2_name']==null){
     echo ' <input type="textarea" placeholder="There is no attachment chosen" rows="8" cols="30" size="70">
	   Choose Attachment:';
}
   else{
    echo '  <input type="textarea" value="' . $row['attach2_name'] . '" rows="8" cols="30" size="70">
	  Change Attachment:  ';
   } echo '
<input type="file" name="file1" id="file" placeholder="' . $row['attach2_name'] . '" value="' . $row['attach2_name'] . '"  > 
</label> <br>
                         <input type="submit" class="submit"  name="req_Id" onclick="validate(); return false;">
</form>
</div>
    ';
                    } else {
                        echo "No Requests";
                    }

                    ?>

                    <br>


                </form>
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