<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");
error_reporting(0);
session_start();

if(empty($_SESSION['user_id']))  
{
	header('location:login.php');
}
else
{
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">
    <title>Your Orders</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
<style>
        /* Clean and Modern Your Orders Page Styling */

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }

        .page-wrapper {
            min-height: 50vh;
            background: transparent;
        }

        /* Hero Section */
        .inner-page-hero {
            position: relative;
            height: 300px;
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .inner-page-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.4);
        }

        .inner-page-hero .container {
            position: relative;
            z-index: 2;
            text-align: center;
        }

        /* Orders Table Container */
         .bg-gray {
            padding: 20px 40px;
            margin: 0px 7px 0px 7px;
            max-width: 12S00px;
        } 

        /* Page Title */
        .result-show h1 {
            color: #495057;
            font-size: 32px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 40px;
            position: relative;
        }

        .result-show h1::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, #667eea, #764ba2);
            border-radius: 2px;
        }

        /* Table Styling */
        .table {
            width: 100%;
            margin-bottom: 0;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: none;
        }

        .table thead th {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            font-weight: 600;
            font-size: 16px;
            padding: 20px 15px;
            border: none;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table tbody td {
            padding: 18px 15px;
            border: none;
            border-bottom: 1px solid #e9ecef;
            font-size: 15px;
            vertical-align: middle;
            background: white;
        }

        .table tbody tr:nth-child(even) td {
            background: #f8f9fa;
        }

        .table tbody tr:hover td {
            background: rgba(102, 126, 234, 0.05);
            transition: background-color 0.3s ease;
        }

        .table tbody tr:last-child td {
            border-bottom: none;
        }

        /* Status Badges */
        .btn {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: none;
            cursor: default;
        }

        .btn-info {
            background: linear-gradient(135deg, #17a2b8, #138496);
            color: white;
        }

        .btn-warning {
            background: linear-gradient(135deg, #ffc107, #e0a800);
            color: #212529;
        }

        .btn-success {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
        }

        .btn-danger {
            background: linear-gradient(135deg, #dc3545, #c82333);
            color: white;
        }

        /* Delete Button */
        .btn-danger.btn-flat {
            background: linear-gradient(135deg, #dc3545, #c82333);
            color: white;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 14px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-danger.btn-flat:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .bg-gray {
                margin: 20px;
                padding: 20px;
            }

            .result-show h1 {
                font-size: 24px;
                margin-bottom: 30px;
            }

            .table thead th,
            .table tbody td {
                padding: 12px 8px;
                font-size: 14px;
            }

            .inner-page-hero {
                height: 200px;
            }

            .btn {
                padding: 4px 8px;
                font-size: 11px;
            }

            .col-xs-12.col-sm-7.col-md-7 {
                display: block;
            }

            .col-xs-12.col-sm-7.col-md-7 .row {
                display: block;
            }
        }

        @media (max-width: 480px) {
            .bg-gray {
                margin: 10px;
                padding: 15px;
            }

            .result-show h1 {
                font-size: 20px;
            }

            .col-xs-12.col-sm-7.col-md-7 {
                display: block;
            }

            .col-xs-12.col-sm-7.col-md-7 .row {
                display: block;
            }

            /* Mobile Table Styles */
            .table, .table thead, .table tbody, .table th, .table td, .table tr {
                display: block;
            }

            .table thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            .table tr {
                border: 1px solid #ddd;
                margin-bottom: 10px;
                border-radius: 8px;
                background: white;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            }

            .table td {
                border: none;
                border-bottom: 1px solid #eee;
                position: relative;
                padding-left: 50%;
                text-align: right;
                white-space: normal;
            }

            .table td:before {
                content: attr(data-column);
                position: absolute;
                left: 10px;
                top: 50%;
                transform: translateY(-50%);
                font-weight: bold;
                color: #495057;
                text-transform: uppercase;
                font-size: 12px;
                letter-spacing: 0.5px;
            }

            .table td:last-child {
                border-bottom: none;
            }
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(0,0,0,0.1);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #5a6fd8, #6a4190);
        }

        /* Loading Animation Enhancement */
        .preloader {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
        }
.form-group.internal {
  margin-bottom: 0;
}
.dialog-panel {
  margin: 10px;
}
.datepicker-dropdown {
  z-index: 200 !important;
}
label.control-label {
  font-weight: 600;
  color: #777;
}


/* Center table container */
.col-xs-12.col-sm-7.col-md-7 {
	display: flex;
	justify-content: center;
}

.col-xs-12.col-sm-7.col-md-7 .row {
	display: flex;
	justify-content: center;
	align-items: flex-start;
	width: 100%;
}

table { 
	width: 1000px; 
	max-width: 100%;
	border-collapse: collapse; 
	margin: 0 auto;
	height: 400px;
	display: table;
	}

/* Zebra striping */
/* tr:nth-of-type(odd) { 
	background: #eee; 
	} */

th { 
	background: #ff3300; 
	color: white; 
	font-weight: bold; 
	
	}

 td, th { 
	padding: 30px; 
	border: 1px solid #241818; 
	text-align: left; 
	font-size: 18px;
	
	} 


@media 
only screen and (max-width: 760px),
(min-device-width: 768px) and (max-device-width: 1024px)  {

	.col-xs-12.col-sm-7.col-md-7 {
		display: block;
	}

	.col-xs-12.col-sm-7.col-md-7 .row {
		display: block;
	}

	table { 
	  	width: 100%; 
	  	margin: 0 auto;
	}

	
	table, thead, tbody, th, td, tr { 
		display: block; 
	}
	
	
	thead tr { 
		position: absolute;
		top: -9999px;
		left: -9999px;
	}
	
	tr { border: 1px solid #ccc; }
	
	td { 
		
		border: none;
		border-bottom: 1px solid #eee; 
		position: relative;
		padding-left: 50%; 
	}

	td:before { 
		
		position: absolute;
	
		top: 6px;
		left: 6px;
		width: 45%; 
		padding-right: 10px; 
		white-space: nowrap;
		
		content: attr(data-column);

		color: #000;
		font-weight: bold;
	}

}







	</style>

	</head>

<body>
    
      
        <header id="header" class="header-scroll top-header headrom">
  
            <nav class="navbar navbar-dark">
                <div class="container">
                    <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
                    <a class="navbar-brand" href="index.php"> <img class="img-rounded" src="images/food-mania-logo.png" alt=""> </a>
                    <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
                        <ul class="nav navbar-nav">
                            <li class="nav-item"> <a class="nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a> </li>
                            <li class="nav-item"> <a class="nav-link active" href="restaurants.php">Shop <span class="sr-only"></span></a> </li>
                            
							<?php
						if(empty($_SESSION["user_id"]))
							{
								echo '<li class="nav-item"><a href="login.php" class="nav-link active">Login</a> </li>
							  <li class="nav-item"><a href="registration.php" class="nav-link active">Signup</a> </li>';
							}
						else
							{
									
									
									echo  '<li class="nav-item"><a href="your_orders.php" class="nav-link active">Your Orders</a> </li>';
									echo  '<li class="nav-item"><a href="logout.php" class="nav-link active">Logout</a> </li>';
							}

						?>
							 
                        </ul>
                    </div>
                </div>
            </nav>
  
        </header>
        <div class="page-wrapper">
       
           
    
            <div class="inner-page-hero bg-image" data-image-src="images/img/are.jpg" width=auto, height=50px>
                <div class="container"> </div>
        
            </div>
            <div class="result-show">
                <div class="container">
                    <div class="row">
                       
                       
                    </div>
                </div>
            </div>
    
            <section class="restaurants-page">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-5 col-md-5 col-lg-3">
                          </div>
                        <div class="col-xs-12 col-sm-7 col-md-7 ">
                            <!-- <div class="bg-gray restaurant-entry"> -->
                                <div class="row">
								
							<table >
						  <thead>
							<tr>
							
							  <th>Item</th>
							  <th>Quantity</th>
							  <th>Price</th>
							   <th>Status</th>
							     <th>Date</th>
								   <th>Action</th>
							  
							</tr>
						  </thead>
						  <tbody>
						  
						  
							<?php 
				
						$query_res= mysqli_query($db,"select * from users_orders where u_id='".$_SESSION['user_id']."'");
												if(!mysqli_num_rows($query_res) > 0 )
														{
															echo '<td colspan="6"><center>You have No orders Placed yet. </center></td>';
														}
													else
														{			      
										  
										  while($row=mysqli_fetch_array($query_res))
										  {
						
							?>
												<tr>	
														 <td data-column="Item"> <?php echo $row['title']; ?></td>
														  <td data-column="Quantity"> <?php echo $row['quantity']; ?></td>
														  <td data-column="price">₹<?php echo $row['price']; ?></td>
														   <td data-column="status"> 
														   <?php 
																			$status=$row['status'];
																			if($status=="" or $status=="NULL")
																			{
																			?>
																			<button type="button" class="btn btn-info" style="font-weight:bold;"><span class="fa fa-bars"  aria-hidden="true" > Dispatch</button>
																		   <?php 
																			  }
																			   if($status=="in process")
																			 { ?>
																				<button type="button" class="btn btn-warning"><span class="fa fa-cog fa-spin"  aria-hidden="true" ></span> On The Way!</button>
																			<?php
																				}
																			if($status=="closed")
																				{
																			?>
																			 <button type="button" class="btn btn-success" ><span  class="fa fa-check-circle" aria-hidden="true"> Delivered</button> 
																			<?php 
																			} 
																			?>
																			<?php
																			if($status=="rejected")
																				{
																			?>
																			 <button type="button" class="btn btn-danger"> <i class="fa fa-close"></i> Cancelled</button>
																			<?php 
																			} 
																			?>
														   
														   
														   
														   
														   
														   
														   </td>
														  <td data-column="Date"> <?php echo $row['date']; ?></td>
														   <td data-column="Action"> <a href="delete_orders.php?order_del=<?php echo $row['o_id'];?>" onclick="return confirm('Are you sure you want to cancel your order?');" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10"><i class="fa fa-trash-o" style="font-size:16px"></i></a> 
															</td>
														 
												</tr>
												
											
														<?php }} ?>					
							
							
										
						
						  </tbody>
					</table>
						
					
                                    
                                </div>
                           
                            </div>
                         
                            
                                
                            </div>
                          
                          
                           
                        <!-- </div> -->
                    </div>
                </div>
            </section>


            <footer class="footer">
            <div class="container">
                
          
                <div class="bottom-footer">
                    <div class="row">
                        
                        <div class="col-xs-12 col-sm-4 address color-black">
                            <h5>Shop</h5>
                            <p>pickle,candle</p>
                            
                              <p>food,craft</p>
                              
                              <p>spices,Cakes</p>
                              
                              
                        </div>
                               <div class="col-xs-12 col-sm-5 additional-info color-black">     
                            <h5>HELP</h5>
                            | <a href="contact.html">Contact Us</a><br><br>
                             | <a href="faq.html">FAQ</a><br>  <br><br><br><br><br>
                    
                               <p>&copy; 2026 Homemade. All rights reserved </p>
                </div>

                
                <a href="term.html" style="margin-bottom:30px">Terms & Conditions</a>      <a href="privacy.html"  style="margin-bottom:30px">|  PrivacyPolicy</a>
                
              </div>

              
            </div>
            
            
        </footer>
        
  
    
    <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/animsition.min.js"></script>
    <script src="js/bootstrap-slider.min.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/headroom.js"></script>
    <script src="js/foodpicky.min.js"></script>
</body>

</html>
<?php
}
?>