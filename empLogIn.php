
<?php

include 'config.php';
if(isset($_POST['login'])) {

	$emp_number = $_POST['ID'];
	$password= $_POST['password'];


	$sql= "SELECT * FROM Employee WHERE emp_number ='$emp_number'";
	$result= mysqli_query($db, $sql);
        
	if(mysqli_num_rows( $result )>0){
		$row = mysqli_fetch_row( $result );
		$userpass =$row[5];

		if(password_verify($password,$userpass)){
			session_start();
			$_SESSION["id"]= $row[0];
 		  $_SESSION["role"]= 'Employee';
			header("Location: emHomePage.php");
		}else {
			echo "<script>
			 alert('Incorrect Password please try again');
			 </script>";
		}

	}else {
		echo "<script>
		 alert('Incorrect ID please try again');
		 </script>";
	}

}
?>



<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link href="css/index.css" rel="stylesheet">
	<link href="css/nav.css" rel="stylesheet">
	<link href="css/nav2.css" rel="stylesheet" type="text/css" media="all">
    <script src="js/valid.js"></script>

</head>
<body>
<div class="wrapper row1">
	<header id="header" class="hoc clear">
		<div id="logo" class="fl_left">
			<img style="height: 50px; width: 250px; margin-top: 20px;" src='img/logo.png' alt='logo'> 
		</div>
		<div class="topnav" id="myTopnav">
			<a href="index.php">Home</a> <a class="drop active" href="menu.html">Menu</a> 
                        <a href="shop.html">Orders</a> <a href="Staff.html">Staff</a> <a href="Reservation.html">Reservation</a> <a href="javascript:void(0);" class="icon" onclick="myFunction()"> <i class="fa fa-bars"></i> </a> 
		</div>
		<nav id="mainav" class="fl_right">
			<ul class="clear">
				<li class="active"><a href="index.php" accesskey="H">Home</a></li>
				
			</ul>
		</nav>
	</header>
</div>
<div class="row3">
	<div class="container">
		
<form class="form1" name="loginEmp" action="empLogIn.php" method="POST">
<fieldset>
<legend>Employee Log-in</legend>
<br>
<input type="text" placeholder="ID" name="ID" autofocus/><br>
   
<input type="password" placeholder="Password" name="password" /><br>

<button type="submit" class="subbut" name='login' value="Log-in" onclick="valid2(); return false;">Login</button>

</fieldset>
</form>

</div>
</div>
<br><br><br><br><br>
<div id="m" class="wrapper row5">
	<div id="copyright" class="hoc clear">
		<footer>
		<p>Copyright &copy; 2022 worknet, inc.</p>
		</footer>
	</div>
	</div>
</body>
</html>
