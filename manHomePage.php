<?php
include 'config.php';
session_start();
if ($_SESSION["role"] != "Manager" || !isset($_SESSION['id'])) {
    header("Location: index.php");
}

?>
<!DOCTYPE>
<html>
    <head>
        <style>
        .tooltip {
          position: relative;
          display: inline-block;
        }

        .tooltip .tooltiptext {
          visibility: hidden;
          width: 300px;
          background-color: white;
          color: black;
          text-align: center;
          border-radius: 12px;
          border: 2px solid white;
          padding: 5px 0;
          box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
 
          /* Position the tooltip */
          position: absolute;
          z-index: 1;
          top: 100%;
          left: 50%;
          margin-left: -60px;
        }

        .tooltip:hover .tooltiptext {
          visibility: visible;
        }
        </style>
        <title>Manager Page</title>
        <link rel='stylesheet' href='css/manhp.css' type='text/css' media='all' />
        <link href="css/nav2.css" rel="stylesheet" type="text/css" media="all">
        <link href="css/nav.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.3.1.js" ></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script type="text/javascript">
            
            $(document).ready(function(){
                $(".names").mouseover(function(){
                    var reqId = $(this).data('value');
                    $.ajax({
                        type:"GET",
                        url:"action.php",
                        data:"reqID="+reqId, 
                        success: function(des){
                           $('span.tooltiptext').remove();
                           par = JSON.parse(des);
                          //alert(par);
                          var output = $('<span class="tooltiptext"></span>').text("Description: "+par);
                          $('.tooltip').append(output);
                            }
                        });
                    });
                 });
                 
            function action(type, id) {
                if (type == "approve") {
                    $.ajax({
                        type: "GET",
                        url: "action.php",
                        data: {approve: id},
                        success: function () {
                            window.location.reload();
                        }
                    });
                } else {
                    $.ajax({
                        type: "GET",
                        url: 'action.php',
                        data: {Decline: id},
                        success: function () {
                            window.location.reload();
                        }
                    });
                }
            }
        </script>
    </head>
    <body>
        <div id="page">
            <div class="wrapper row1">
                <header id="header" class="hoc clear">
                    <div id="logo" class="fl_left">
                        <img style="height: 50px; width: 250px; margin-top: 20px;" src='img/logo.png' alt='logo'> 
                    </div>
                    <div class="navv " >
                        <nav id="mainav" class="fl_right ">


                            <ul class="clear">
                                <li ><a href="manHomePage.php" accesskey="H">Home</a></li>

                                <li class="logout"><a href="signout.php"><img class="image2" src="img/sign-out.png" alt="sign out"></a></li>
                            </ul>

                        </nav>
                    </div>
                </header>
            </div>
            <div class="tables container">
                <?php
                $id = $_SESSION["id"];
                $sql = "SELECT * FROM Manager WHERE id='$id'";
                $result = $db->query($sql);

                if ($result->num_rows > 0) {
                    $row = mysqli_fetch_row($result);
                    echo "<h1 id='section-header' > Welcome " . $row[1] . " " . $row[2] . "</h1><br>";
                }
                ?>

                <?php
                $sqlService = "SELECT * FROM service";
                $result_ser = $db->query($sqlService);
                if ($result_ser->num_rows > 0)
                    while ($rows = mysqli_fetch_array($result_ser)) {
                        ?>
                        <div class="tables container">

                            <table>
                                <caption > <h1> <span class="  cart-header">Requests</span></h1></caption>

                                <div class="cart-row">
                                    <tr class=" thead">
                                        <th colspan="4">

                                            <span class=" cart-header " ><?php echo $rows[1] ?></span>

                                        </th>
                                    </tr>
                                </div>
                                <div class="cart-row">
                                    <tr class=" thead2">
                                        <th colspan="2">

                                            <span class=" cart-header cart-column">Employee name</span> 
                                        </th>
                                        <td >
                                            <span class=" cart-header cart-column">Status</span> 
                                        </td>
                                        <td>

                                        </td>
                                    </tr>
                                </div>

                                <?php
                                $sql1 = "SELECT id,emp_id,status FROM request WHERE service_id=$rows[0] AND status='In progress'";
                                $result1 = $db->query($sql1);

                                if ($result->num_rows > 0)
                                    while ($Mrow = mysqli_fetch_array($result1)) {
                                        $emp_sql = "SELECT first_name,last_name FROM employee WHERE id='$Mrow[1]'";
                                        $names = $db->query($emp_sql);
                                        if ($names->num_rows > 0) {
                                            $name = mysqli_fetch_array($names);
                                            $emp_name = $name[0] . " " . $name[1];
                                        }

                                        echo"<div class='cart-row'>

                            <tr style= 'background-color:#fff1d8;' >
                                <th colspan='2'><div class='tooltip'>
                                    <span class='cart-item cart-header'>"
                                        ?> <?php echo '<a href="reqInfo.php?reqID=' . $Mrow[0] . '" data-value="' . $Mrow[0] . '" class="names">' . $emp_name . '</a>' ?> <?php echo "</span>  
                               </div> </th>
                                <td>
                                    <span class='cart-item cart-header'>$Mrow[2]</span>  

                                </td>
                                <td>

                                    <span  class='cart-header cart-column'> <button class='btn btn-green'>" ?> <?php echo '<a onclick="action(\'approve\',' . $Mrow[0] . ')" href="#' . $Mrow[0] . '">Approve</a>' ?> 
                                        <?php echo "</button><pre>  </pre> <button class='btn btn-yellow'>" ?> <?php echo '<a onclick="action(\'Decline\',' . $Mrow[0] . ')" href="#' . $Mrow[0] . '">Decline</a>' ?> <?php echo "</button></span> " ?>


                                        <?php
                                        echo"
                                </td>
                            </tr>
                        
                        </div>";
                                    }

                                $sql1 = "SELECT id,emp_id,status FROM request WHERE service_id=$rows[0] AND status='Approved'";
                                $result1 = $db->query($sql1);

                                if ($result->num_rows > 0)
                                    while ($Mrow = mysqli_fetch_array($result1)) {
                                        $emp_sql = "SELECT first_name,last_name FROM employee WHERE id='$Mrow[1]'";
                                        $names = $db->query($emp_sql);
                                        if ($names->num_rows > 0) {
                                            $name = mysqli_fetch_array($names);
                                            $emp_name = $name[0] . " " . $name[1];
                                        }

                                        echo"<div class='cart-row'>

                            <tr >
                                <th colspan='2'> <div class='tooltip'>
                                    <span class='cart-item cart-header'>"
                                        ?> <?php echo '<a href="reqInfo.php?reqID=' . $Mrow[0] . '" data-value="' . $Mrow[0] . '" class="names">' . $emp_name . '</a>' ?> <?php echo "</span>  
                              </div>  </th>
                                <td>
                                    <span class='cart-item cart-header'>$Mrow[2]</span>  

                                </td>
                                <td>

                                    <span  class='cart-header cart-column'><button class='btn btn-yellow'>" ?> <?php echo '<a onclick="action(\'Decline\',' . $Mrow[0] . ')" href="#' . $Mrow[0] . '">Decline</a>' ?> <?php
                                        echo "</button></span> 

                                </td>
                            </tr>
                        </div>";
                                    }

                                $sql1 = "SELECT id,emp_id,status FROM request WHERE service_id=$rows[0] AND status='Declined'";
                                $result1 = $db->query($sql1);

                                if ($result->num_rows > 0)
                                    while ($Mrow = mysqli_fetch_array($result1)) {
                                        $emp_sql = "SELECT first_name,last_name FROM employee WHERE id='$Mrow[1]'";
                                        $names = $db->query($emp_sql);
                                        if ($names->num_rows > 0) {
                                            $name = mysqli_fetch_array($names);
                                            $emp_name = $name[0] . " " . $name[1];
                                        }
                                        echo"<div class='cart-row'>

                            <tr >
                                <th colspan='2'> <div class='tooltip'>
                                    <span class='cart-item cart-header'>"
                                        ?> <?php echo '<a href="reqInfo.php?reqID=' . $Mrow[0] . '" data-value="' . $Mrow[0] . '" class="names">' . $emp_name . '</a>' ?> <?php echo "</span>  
                              </div>  </th>
                                <td>
                                    <span class='cart-item cart-header'>$Mrow[2]</span>  

                                </td>
                                <td>
                                
                                   <span  class='cart-header cart-column'> <button class='btn btn-green'>" ?> <?php echo '<a onclick="action(\'approve\',' . $Mrow[0] . ')" href="#' . $Mrow[0] . '">Approve</a>' ?> <?php
                                        echo "</button></span>

                                </td>
                            </tr>
                        </div>";
                                    }
                            }
                        ?>

                    </table>
                </div>

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