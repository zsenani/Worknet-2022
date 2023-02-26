<?php
include 'config.php';
session_start();
if (($_SESSION["role"] != "Employee" && $_SESSION["role"] != "Manager") || !isset($_SESSION['id'])) {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Request Information</title>
	<link rel='stylesheet' href='css/reqInfo.css' type='text/css' media='all' />
	<link rel='stylesheet' href='css/add_editReq.css' type='text/css' media='all' />
	<link href="css/nav2.css" rel="stylesheet" type="text/css" media="all">
	<link href="css/nav.css" rel="stylesheet">
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
							

				<ul class="clear"><?php  if($_SESSION["role"] == "Employee"){
					echo '<li ><a href="emHomePage.php" accesskey="H">Home</a></li>';}else
                                        {echo '<li ><a href="manHomePage.php" accesskey="H">Home</a></li>';}?> 
					
					<li class="logout"><a href="signout.php"><img class="image2" src="img/sign-out.png" alt="sign out"></a></li>
				</ul>

			</nav>
			</div>
		</header>
            
        </div> <br/><br/> <div class="fl_left"> <?php if($_SESSION["role"] == "Employee"){
            
        echo'<ul class="clear" style="list-style-type: none;"> <li><a href="emHomePage.php"><img src="img//back.png" alt="return" height="30" width="30"></a></li> </ul>' ;
        
        }
         else {
             echo'<ul class="clear" style="list-style-type: none;"> <li><a href="manHomePage.php"><img src="img//back.png" alt="return" height="30" width="30"></a></li> </ul>' ;
         }
         ?></div>
	<div class="tables container">
		<h2 class="cart-header">
			Promotion 
		</h2>
            <table style=" margin-left: auto; margin-right: auto;width: 100%">
		<div class="cart-row">
                   <tr> 
                       <td><span class=" cart-header ">EMPLOYEE'S NAME</span> </td>
                       <td><span class=" cart-header ">TYPE</span> </td>
                       <td> <span class="cart-header ">STATUS</span> </td>
                       <td>           </td>
                </tr>
		</div>
            
            <?php
           
           if( isset($_GET['msg'])){
               $msg =$_GET['msg'];
           echo "<script> alert('$msg');</script>";
           }
           
            error_reporting(E_ALL);
          
            $reqNum = $_GET['reqID'];
           
           
            $reqNum = filter_var($reqNum, FILTER_SANITIZE_NUMBER_INT);
            settype($reqNum, "integer");
            $Info = "SELECT * FROM Request WHERE id=".$reqNum."";
            $resultInfo = mysqli_query($db, $Info);
             mysqli_store_result($db);
             
            if(mysqli_num_rows($resultInfo) > 0 ){
             
            $row = mysqli_fetch_row($resultInfo);
             
            
           

               $sqlName = "SELECT * FROM Employee WHERE id=".$row[1]."";

               $fName = mysqli_query($db, $sqlName);
               if(mysqli_num_rows($fName) > 0 ){  
                       
               $fr = mysqli_fetch_row($fName);}
               
               //".$fName."  ".$lname."
                
               $sqlSer = "SELECT * FROM Service WHERE id=".$row[2]."";
               $ser = mysqli_query($db, $sqlSer);
               
               if(mysqli_num_rows($ser) > 0 ){
                   $service = mysqli_fetch_row($ser);
               }
               $empName = $fr[2]." ".$fr[3];
                 echo "<tr>
                    
                 <td>".$empName." </td> 
                      
                 <td>".$service[1]."</td>
                   
                 <td>".$row[6]."</td>
                      
                 <td style='width: 30%'> ";
                 ?>
                 <?php 
                 
                 if($_SESSION["role"] == "Manager" && $row[6] == 'In progress'){ ?>
                <div style="margin: auto;">
                      <button class='btn-green btn' style="width: 35%;"><?php echo '<a href="action.php?approve='.$reqNum.'&&file='.$_SERVER['PHP_SELF'].'">Approve</a>'?></button>
                      <button class='btn-yellow btn' style="width: 35%; "><?php echo '<a href="action.php?Decline='.$reqNum.'&&file='.$_SERVER['PHP_SELF'].'">Decline</a>'?></button> 
                     </div>
                   <?php }else if($_SESSION["role"] == "Manager" && $row[6] == 'Declined'){ ?>
                    <div style="margin: auto;">
                      <button class='btn-green btn' style="width: 70%;"><?php echo '<a href="action.php?approve='.$reqNum.'&&file='.$_SERVER['PHP_SELF'].'">Approve</a>'?></button>
                    </div>
                   <?php }else if($_SESSION["role"] == "Manager" && $row[6] == 'Approved'){ ?>
                    <div style="margin: auto;">
                      <button class='btn-yellow btn' style="width: 70%;"><?php echo '<a href="action.php?Decline='.$reqNum.'&&file='.$_SERVER['PHP_SELF'].'">Decline</a>'?></button> 
                    </div>
                   
                   <?php } else if ($_SESSION["role"] == "Employee") { ?>
                     
                   <button class='btn-danger btn' style="width: 70%"><?php echo "<a href='EditReq.php?reqid=".$reqNum."'>Edit</a></button> "; ?>
                   
            <?php   }} 
               echo ' </td></tr>'; ?>
                  </table>
                </div>
        </div>
     
           
            
		
	
	<div class="tables container">
		<table style="width: 100%;">
			<tr>
				<th colspan="2" class="cart-header">REQUEST DESCRIPTION</th>
			</tr>
                        
                        
			 <tr>
			<?php  echo'<td colspan="2" style="color:black;">'.$row[3].' </td> ';?>
			</tr> 
                              
			<tr>
				<th class="cart-header" colspan="2">Attached File</th>   
                        </tr>   
                        
                        <tr>
                            <?php 
                             
                                  $ext1 = substr($row[4], strrpos($row[4], '.') + 1); //explode('.', $fileName1);
                                  $ext2 = substr($row[5], strrpos($row[5], '.') + 1);
                                   
                                  echo '<td>';
                                
                                   if($row[4] != null){
                                   if($ext1 != "jpg" && $ext1 != "png" && $ext1 != "jpeg" && $ext1 != "gif"){
                                      
                                       echo'<a href="uploads//'.$row[4].'">attachment1 link </a>';
                                       
                                   }
                                   else {
                                      echo'<img src="uploads//'.$row[4].'" alt="attachment1" height="300" width="300">';
                                   }
                                   }else {
                                   echo'<p> No File uploaded </p>';}
                                   echo '</td> <td>';
                                   //echo '<tr>';
                                    if($row[5] != null){
                                   if($ext2 != "jpg" && $ext2 != "png" && $ext2 != "jpeg" && $ext2 != "gif"){
                                        
                                        echo'<a href="uploads//'.$row[5].'">attachment2 link </a> ';
                                   }
 
                                   else{
                                       //link($row[5], "attach2");
                                       echo'<img src="uploads//'.$row[5].'" alt="attachment2" height="300" width="300">';
                                    }}else{
                                    echo'<p>No File uploaded </p>';}
                                   echo '</td>';
                                    
                                    ?>
                        </tr>
                             
                             
                                
              
			
		</table>
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