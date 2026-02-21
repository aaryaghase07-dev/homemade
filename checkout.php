<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");
include_once 'product-action.php';
error_reporting(0);
session_start();


function function_alert() { 
      

    echo "<script>alert('Thankyou! Your Order Placed successfully!');</script>"; 
    echo "<script>window.location.replace('your_orders.php');</script>"; 
} 

if(empty($_SESSION["user_id"]))
{
	header('location:login.php');
}
else{

										  
												foreach ($_SESSION["cart_item"] as $item)
												{
											
												$item_total += ($item["price"]*$item["quantity"]);
												
													if($_POST['submit'])
													{
						
													$SQL="insert into users_orders(u_id,title,quantity,price) values('".$_SESSION["user_id"]."','".$item["title"]."','".$item["quantity"]."','".$item["price"]."')";
						
														mysqli_query($db,$SQL);
														
                                                        
                                                        unset($_SESSION["cart_item"]);
                                                        unset($item["title"]);
                                                        unset($item["quantity"]);
                                                        unset($item["price"]);
														$success = "Thankyou! Your Order Placed successfully!";

                                                        function_alert();

														
														
													}
												}
?>


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">
    <title>Checkout</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <style>
        /* Clean and Modern Checkout Page Styling */

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }

        .site-wrapper {
            min-height: 100vh;
        }

        /* Success Message Styling */
        .container span[style*="color:green"] {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            padding: 15px 20px;
            border-radius: 8px;
            display: block;
            text-align: center;
            font-weight: 600;
            font-size: 16px;
            margin: 20px 0;
            box-shadow: 0 4px 15px rgba(40, 167, 69, 0.2);
        }

        /* Main Checkout Container */
        .container.m-t-30 {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            padding: 40px;
            margin: 40px auto;
            max-width: 800px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Widget Styling */
        .widget {
            background: #f8f9fa;
            border-radius: 12px;
            border: none;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        .widget-body {
            padding: 30px;
        }

        /* Cart Totals Section */
        .cart-totals {
            background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 30px;
            border: 1px solid #e9ecef;
        }

        .cart-totals-title h4 {
            color: #495057;
            font-weight: 700;
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
            position: relative;
        }

        .cart-totals-title h4::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 3px;
            background: linear-gradient(90deg, #667eea, #764ba2);
            border-radius: 2px;
        }

        /* Table Styling */
        .cart-totals .table {
            margin-bottom: 0;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .cart-totals .table thead th {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            font-weight: 600;
            border: none;
            padding: 15px;
            font-size: 16px;
        }

        .cart-totals .table tbody td {
            padding: 15px;
            border: none;
            border-bottom: 1px solid #e9ecef;
            font-weight: 500;
            font-size: 15px;
        }

        .cart-totals .table tbody tr:last-child td {
            border-bottom: none;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            font-weight: 700;
            font-size: 18px;
            color: #495057;
        }

        .text-color {
            color: #667eea !important;
        }

        /* Payment Options */
        .payment-option {
            background: white;
            border-radius: 10px;
            padding: 25px;
            border: 1px solid #e9ecef;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
        }

        .payment-option h4 {
            color: #495057;
            font-weight: 600;
            margin-bottom: 20px;
            text-align: center;
            font-size: 20px;
        }

        .payment-option ul {
            list-style: none;
            padding: 0;
            margin: 0 0 25px 0;
        }

        .payment-option li {
            margin-bottom: 15px;
        }

        /* Radio Button Styling */
        .custom-control-label {
            cursor: pointer;
            padding: 15px 20px;
            border-radius: 8px;
            border: 2px solid #e9ecef;
            background: #f8f9fa;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            font-weight: 500;
            font-size: 16px;
        }

        .custom-control-label:hover {
            border-color: #667eea;
            background: rgba(102, 126, 234, 0.05);
        }

        .custom-control-input:checked ~ .custom-control-label {
            border-color: #667eea;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
            color: #495057;
        }

        .custom-control-indicator {
            background-color: white;
            border: 2px solid #adb5bd;
        }

        .custom-control-input:checked ~ .custom-control-indicator {
            background-color: #667eea;
            border-color: #667eea;
        }

        /* Disabled Payment Option */
        .custom-control-input:disabled ~ .custom-control-label {
            opacity: 0.6;
            cursor: not-allowed;
        }

        /* Order Button */
        .payment-option p input[type="submit"] {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 8px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(102, 126, 234, 0.3);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .payment-option p input[type="submit"]:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(102, 126, 234, 0.4);
        }

        .payment-option p input[type="submit"]:active {
            transform: translateY(0);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container.m-t-30 {
                margin: 20px;
                padding: 20px;
            }

            .cart-totals {
                padding: 20px;
            }

            .cart-totals-title h4 {
                font-size: 20px;
            }

            .cart-totals .table thead th,
            .cart-totals .table tbody td {
                padding: 12px 8px;
                font-size: 14px;
            }

            .payment-option {
                padding: 20px;
            }

            .custom-control-label {
                padding: 12px 15px;
                font-size: 15px;
            }

            .payment-option p input[type="submit"] {
                padding: 12px 25px;
                font-size: 16px;
            }
        }

        @media (max-width: 480px) {
            .container.m-t-30 {
                margin: 10px;
                padding: 15px;
            }

            .cart-totals-title h4 {
                font-size: 18px;
            }

            .payment-option p input[type="submit"] {
                width: 100%;
                padding: 15px;
            }
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(0,0,0,0.1);
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #5a6fd8, #6a4190);
        }
    </style></head>
<body>
    
    <div class="site-wrapper">
        <header id="header" class="header-scroll top-header headrom">
            <nav class="navbar navbar-light">
                <div class="container">
                    <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
                    <a class="navbar-brand" href="index.php"> <img src="images/logo/HomeMadeWithCare.png" alt="HomeMadeWithCare Logo" class="img-rounded" style="height: 60px;"></a>
                    <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
                        <ul class="nav navbar-nav">
                            <li class="nav-item"> <a class="nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a> </li>
                            <li class="nav-item"> <a class="nav-link active" href="restaurants.php">Shop <span class="sr-only"></span></a> </li>
                            
							<?php
						if(empty($_SESSION["user_id"]))
							{
								echo '<li class="nav-item"><a href="login.php" class="nav-link active">Login</a> </li>
							  <li class="nav-item"><a href="registration.php" class="nav-link active btn signup-btn">Signup</a> </li>';
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
        
			
                <div class="container">
                 
					   <span style="color:green;">
								<?php echo $success; ?>
										</span>
					
                </div>
            
			
			
				  
            <div class="container m-t-30">
			<form action="" method="post">
                <div class="widget clearfix">
                    
                    <div class="widget-body">
                        <form method="post" action="#">
                            <div class="row">
                                
                                <div class="col-sm-12">
                                    <div class="cart-totals margin-b-20">
                                        <div class="cart-totals-title">
                                            <h4>Cart Summary</h4> </div>
                                        <div class="cart-totals-fields">
										
                                            <table class="table">
											<tbody>
                                          
												 
											   
                                                    <tr>
                                                        <td>Cart Subtotal</td>
                                                        <td> <?php echo "₹".$item_total; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Delivery Charges</td>
                                                        <td>Free</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-color"><strong>Total</strong></td>
                                                        <td class="text-color"><strong> <?php echo "₹".$item_total; ?></strong></td>
                                                    </tr>
                                                </tbody>
												
												
												
												
                                            </table>
                                        </div>
                                    </div>
                                    <div class="payment-option">
                                        <ul class=" list-unstyled">
                                            <li>
                                                <label class="custom-control custom-radio  m-b-20">
                                                    <input name="mod" id="radioStacked1" checked value="COD" type="radio" class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description">Cash on Delivery</span>
                                                </label>
                                            </li>
                                            <li>
                                                <label class="custom-control custom-radio  m-b-10">
                                                    <a href="check page.php"><input name="mod"  type="radio" value="paypal"  class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description">RazorPay <img src="images/paypal.jpg" alt="" width="90"> </span></a>
                                                  
                                                 </label>
                                            </li>
                                        </ul>
                                        <p class="text-xs-center"> <input type="submit" onclick="return confirm('Do you want to confirm the order?');" name="submit"  class="btn btn-outline-success btn-block" value="Order now"> </p>
                                    </div>
									</form>
                                </div>
                            </div>
                       
                    </div>
                </div>
				 </form>
            </div>
            
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
        </div>
         </div>

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
