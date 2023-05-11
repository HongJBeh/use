<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
	<head>
		<meta charset="utf-8">
		<title>Invoice | Anime Society</title>
                <link href="css/ticket-records.css" rel="stylesheet" type="text/css"/>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
                <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
                <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
	</head>
        <?php 
        require_once './config/helper.php';
        ?>
	<body>
		<header>
                    <form action="" method="post">
			<h1>Invoice</h1>
            <address>
            <table>
            <tbody>
            <tr id="list" class="add">
                <td width = "150" >Participant name</td>
                <td width = "150pt" >Email</td>
                <td width = "100pt" >Contact Number</td>

            </tr>
            
            <tr>
                <?php
                $con = new mysqli(HOST, USER, PASS, NAME);
                $sql = "SELECT * FROM ticket";
                
                if($result = $con->query($sql))
            {
                while($record = $result->fetch_object())
                {
                    printf("
                        <tr>
                            <td class='username'>%s</td>
                            <td class='email'>%s</td>
                            <td class='contact'>%s</td>
                        </tr>
                            ", $record->UserName,
                               $record->ticket_email,
                               $record->ticket_contact,
                               $record->TicketID,
                               $record->TicketID);
                    
                            }
            } 
          ?>   
            </tr>
        </tbody>
            </table>
            </address>
			<span><img alt="" src=""><input type="file" accept="image/*"></span>
		</header>
		<article>
			<address>
				<p>Anime Society<br>Join Us</p>
			</address>
			<table class="number">
				<tr>
					<th><span>Invoice #</span></th>
					<td><span>000001</span></td>
				</tr>
				<tr>
					<th><span>Date</span></th>
					<td><span>May 12, 2023</span></td>
				</tr>
				<tr>
					<th><span>Amount Due</span></th>
					<td><span>RM</span><span>60.00</span></td>
				</tr>
			</table>
			<table class="information">
				<thead>
					<tr>
						<th><span>Event Name</span></th>
						<th><span>Location</span></th>
						<th><span>Rate</span></th>
						<th><span>Quantity</span></th>
						<th><span>Price</span></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><span>Amigo Grand Time</span></td>
						<td><span>Penang</span></td>
						<td><span>RM</span><span>30.00</span></td>
						<td><span>2</span></td>
						<td><span>RM</span><span>60.00</span></td>
					</tr>
				</tbody>
			</table>
                </article>
            <div class="btn">
                <a href="home.php" class="btn btn-light border">⏮Back</a>
                <a href="javascript:window.print()" class="btn btn-light border"><ion-icon name="print-outline"></ion-icon>Print</a>
            </div>
</form>
	</body>
</html>