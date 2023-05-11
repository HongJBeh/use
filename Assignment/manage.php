<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Manage ticket system</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    </head>
    <?php include './adminheader.php';?>
    <div>
                <div class="dash-content">
                <div class="overview">
                    <div class="title">
                        <i class="uil uil-map"></i>
                        <span class="text">Manage ticket System</span>
                    </div>
                </div>
                </div>
            </div>
    <div class="container mt-5">
            <div class="text-center">
                <h1 class="display-5 mb-5"><strong>Manage Ticket System</strong></h1>
            </div>
            <div class="main row justify-content-center">
                <div class="col-12 col-md-10 mt-5">
                    <table class="table table-striped table-dark">
                        <thead>
                            <tr>
                                <th>Event Name</th>
                                <th>Ticket Price</th>
                                <th>Seat</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="event-list">
                            <tr>
                                <td>Amigo Grand Time</td>
                                <td>RM 30</td>
                                <td>300</td>
                                <td>
                                    <a href="" class="btn btn-warning btn-sm edit">Edit</a>
                                    <a href="" class="btn btn-danger btn-sm delete">Delete</a>
                                </td>
                            </tr>
                             <tr>
                                <td>Comic Fiesta 2023</td>
                                <td>RM 60</td>
                                <td>5000</td>
                                <td>
                                    <a href="" class="btn btn-warning btn-sm edit">Edit</a>
                                    <a href="" class="btn btn-danger btn-sm delete">Delete</a>
                                </td>
                            </tr>
                             <tr>
                                <td>Cosplay Festival@Penang</td>
                                <td>RM 20</td>
                                <td>500</td>
                                <td>
                                    <a href="" class="btn btn-warning btn-sm edit">Edit</a>
                                    <a href="" class="btn btn-danger btn-sm delete">Delete</a>
                                </td>
                            </tr>
                        </tbody>         
                    </table>         
            </div>
                <form action="" id="event-form" class="row justify-content-center mb-4" autocomplete="off" >
                    <div class="col-10 col-md-8 mb-3">
                        <label for="eventName">Event Name</label>
                        <input class="form-control" id="eventName" type="text" placeholder="Enter Event Name">
                    </div>
                    <div class="col-10 col-md-8 mb-3">
                        <label for="tPrice">Ticket Price</label>
                        <input class="form-control" id="tPrice" type="text" placeholder="Enter Ticket Price">
                    </div>  
                    <div class="col-10 col-md-8 mb-3">
                        <label for="wSeat">Seat</label>
                        <input class="form-control" id="wSeat" type="text" placeholder="Enter Number Of Seat">
                    </div>
                     <div class="col-10 col-md-8">
                         <input class="btn btn-success add-btn" type="submit" value="Submit">
                    </div>
                </form>          
            </div>  
            </div>
        <script src="javascript/script20.js" type="text/javascript"></script>
        </section>
    </body>
</html>
