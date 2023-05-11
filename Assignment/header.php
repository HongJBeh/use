<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="CSS/assigncss.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="navbar">
        <table>
            <tr>
                <td><h1 class="hea"><a href="home.php" >Anime Society</a></h1></td>
                <td>
                    <div >
                        <?php
                        if (isset($_COOKIE['userid'])) {
                            echo "<div style='margin-left:970px'>";
                            echo $_COOKIE['userid'];
                            echo "</div>";
                            } else {
                                echo "<div style='margin-left:980px'>";
                                echo "Please log in.";
                                echo "</div>";
                                }
                                ?>
                        <a href="logout.php">
                            <img class="mem" src="img/none.png" alt=""/>
                        </a>
                        
                    </div>
                </td>
            </tr>
        </table>
            <ul>
                <li><a class="active" href="home.php">Home</a></li>
                <li><a href="E_Home.php">events</a></li>
                <li><a href="ticketrecord.php">ticket</a></li>
                <li><a href="forum.php">Forums</a></li>
                <li class="dropdown">
                    <a href="#" class="dropbtn">Member</a>
                    <div class="dropdown-content">
                        <a href="login.php">Login</a>
                        <a href="register.php">Register</a>
                    </div>
                </li>
                
                <div class="search-container">
		<input type="text" placeholder="Search...">
		<button class="search-button">Search</button>
	        </div>
            </ul>
        </div>
    </body>
</html>
