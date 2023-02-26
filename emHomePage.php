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
        <title>Employee Home Page</title>
        <link rel='stylesheet' href='css/emhp.css' type='text/css' media='all' />
        <link href="css/nav2.css" rel="stylesheet" type="text/css" media="all">
        <link href="css/nav.css" rel="stylesheet">
	<style>
	   .image{width:30%;}
	   .image3{width:25%;margin-left:30%;float:right;}

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
            <div class="tables container">
                <?php
		
                $id = $_SESSION["id"];
                $sql = "SELECT * FROM Employee WHERE id='$id'";
                $result = mysqli_query($db,$sql);

                if ($result->num_rows > 0) {
                    $row = mysqli_fetch_row($result);
                    echo "<h1 id='section-header' > Welcome ".$row[2]." ".$row[3]."</h1><br>";
                } 
                ?>
               
                <br>
                <br>
                <div>
                    <h2>
                        Employee's ID: <?php echo "$row[1]";?> <br><br>
                        Job Title: <?php echo "$row[4]";?>
                    </h2>
                    <span  ><a href="AddNewReq.php"><img id="image3" src="img/add.jpg" alt="edit"></a></span> 
                </div>
                <br>
                <br>
                <br>

                <hr>
                <table style="width:100%">
                    <caption class=" thead"> <h1> <span class=" cart-header">Requests</span></h1></caption>
                    <div class="cart-row">
                        <tr class=" thead2">
                            <th colspan="6">

                                <span class=" cart-header " >In progress</span>
				
				          </th>
                        </tr>
                    </div>
			  <?php 
    $reqId = $_SESSION["id"];
    settype($reqId, "integer");
      $reqsql = "SELECT * FROM Request WHERE emp_id='$reqId' AND status='In progress'";
      $reqsql2 = "SELECT * FROM Request INNER JOIN Service ON Request.service_id=Service.id WHERE emp_id='$reqId' AND status='In progress'";

    $reqsqlresult = mysqli_query($db,$reqsql);
    $reqsqlresult2 = mysqli_query($db,$reqsql2);

     if ($reqsqlresult->num_rows > 0) {
  
       while ($reqrow = mysqli_fetch_array($reqsqlresult) ) {
	    $reqrow2 = mysqli_fetch_array($reqsqlresult2) ;

              echo "<div class='req'>";
	      echo "  <div class='cart-row'>
                        <tr>
                            <th style='width:30%; text-align:left;' colspan='2'>";
              echo "<span ><a href= 'reqInfo.php?reqID=".$reqrow['id']."'> " .$reqrow2['type']."-".$reqrow['id'] ."</a></span>";
	      echo "</th>";
	      echo " <th style='width:5%' colspan='2'>";
              echo "<span ><a href='reqInfo.php?reqID=".$reqrow['id']."'>Display info</a></span>";
	      echo "</th>";
	      echo " <th style='width:5%'>";
              echo "<span> <a href='EditReq.php?reqid=".$reqrow['id']."'><img class='image' src='img/edit.png' alt='edit'></a> </span>";
	      
              echo " </th></tr>
                    </div>";
              echo "</div>";
         }
       
    }
    
  ?>

                 
                  </table>
            </div>

            <div class="tables container">

                <table style="width:100%">
                    <div class="cart-row">
                        <tr class=" thead">
                            <th colspan="4">

                                <span class=" cart-header " >Previous Requests</span>
                            </th>
                        </tr>
                    </div>
                   <div class="cart-row">
                        <tr class=" thead2">
                            <th>

                                <span class="cart-item cart-header cart-column">Requests</span> 
                            </th>
                            <td >
                                <span class="cart-item cart-header cart-column">Status</span> 
                            </td>
                           <td colspan="2">
                            </td>
                        </tr>
                    </div>
		    
		    			  <?php
    $reqId2 = $_SESSION["id"];
    settype($reqId2, "integer");
    $reqsql3 = "SELECT * FROM Request WHERE emp_id='$reqId2' AND status<>'In progress'";
    $reqsql4 = "SELECT * FROM Request INNER JOIN Service ON Request.service_id=Service.id WHERE emp_id='$reqId2' AND status<>'In progress'";
    $reqsqlresult3 = mysqli_query($db,$reqsql3);
    $reqsqlresult4 = mysqli_query($db,$reqsql4);

     if ($reqsqlresult3->num_rows > 0) {

       while ($reqrow3 = mysqli_fetch_array($reqsqlresult3)) {
	   $reqrow4 = mysqli_fetch_array($reqsqlresult4);
                 echo "<div class='req'>";
	      echo "  <div class='cart-row'>
                        <tr>
                            <th style='width:10%; text-align:left;'>";
              echo "<span><a href= 'reqInfo.php?reqID=".$reqrow3['id']."'> ".$reqrow4['type'] ."-".$reqrow3['id'] ."</a></span>";
	      echo "</th>";
	      echo " <th style='width:10%;color:black; text-align:left;'>";
	      echo $reqrow3[6];
	      echo " </th>";
	      echo " <th style='width:5%'>";
              echo "<span class='info'><a href='reqInfo.php?reqID=".$reqrow3['id']."'>Display info</a></span>";
	      echo "</th>";
	      echo " <th style='width:5% '>";
              echo "<span> <a href='EditReq.php?reqid=".$reqrow3['id']."'><img class='image3' src='img/edit.png' alt='edit'>"."</a> </span>";
	      
              echo " </th></tr>
                    </div>";
              echo "</div>";
         }
    }
  ?>
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