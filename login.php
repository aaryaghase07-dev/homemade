<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php"); 
error_reporting(0); 
session_start(); 
if(isset($_POST['submit']))  
{
	$username = $_POST['username'];  
	$password = $_POST['password'];
	
	if(!empty($_POST["submit"]))   
     {
	$loginquery ="SELECT * FROM users WHERE username='$username' && password='".md5($password)."'"; //selecting matching records
	$result=mysqli_query($db, $loginquery); //executing
	$row=mysqli_fetch_array($result);
	
	                        if(is_array($row)) 
								{
                                    	$_SESSION["user_id"] = $row['u_id']; 
										 header("refresh:1;url=index.php"); 
	                            } 
							else
							    {
                                      	$message = "Invalid Username or Password!"; 
                                }
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
    <title>Login</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <style>
        /* Modern Login Page Styling */

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }

        .page-wrapper {
            min-height: 100vh;
            background: transparent;
        }

        /* Modern Login Container */
        .contact-page.inner-page .container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            padding: 50px;
            margin: 50px auto;
            max-width: 600px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Form Header */
        .contact-page.inner-page h1,
        .contact-page.inner-page h2 {
            color: #495057;
            font-weight: 700;
            text-align: center;
            margin-bottom: 40px;
            position: relative;
        }

        .contact-page.inner-page h1::after,
        .contact-page.inner-page h2::after {
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

        /* Widget Styling */
        .widget {
            background: transparent;
            border: none;
            box-shadow: none;
            margin: 0;
        }

        .widget-body {
            padding: 0;
        }

        /* Form Groups */
        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        /* Form Labels */
        .form-group label {
            color: #495057;
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 8px;
            display: block;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Form Controls */
        .form-control {
            width: 100%;
            padding: 15px 18px;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            font-size: 16px;
            color: #495057;
            background: #f8f9fa;
            transition: all 0.3s ease;
            box-sizing: border-box;
        }

        .form-control:focus {
            border-color: #667eea;
            background: #fff;
            outline: none;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
            transform: translateY(-1px);
        }

        .form-control::placeholder {
            color: #adb5bd;
            font-style: italic;
        }

        /* Button Styling */
        .btn.theme-btn,
        #buttn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 15px 40px;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 4px 20px rgba(102, 126, 234, 0.3);
        }

        .btn.theme-btn:hover,
        #buttn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(102, 126, 234, 0.4);
        }

        .btn.theme-btn:active,
        #buttn:active {
            transform: translateY(0);
        }

        /* Message Styling */
        .alert-message {
            display: block;
            padding: 14px 18px;
            margin-bottom: 24px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 500;
            text-align: center;
        }

        .alert-message.error {
            color: #dc3545;
            background: linear-gradient(135deg, #fff5f5 0%, #ffe5e5 100%);
            border: 1px solid #fecaca;
            border-left: 4px solid #dc3545;
            box-shadow: 0 2px 8px rgba(220, 53, 69, 0.1);
        }

        .alert-message.success {
            color: #28a745;
            background: linear-gradient(135deg, #f0fff4 0%, #e6ffe6 100%);
            border: 1px solid #c3e6cb;
            border-left: 4px solid #28a745;
            box-shadow: 0 2px 8px rgba(40, 167, 69, 0.1);
        }

        /* Register Link */
        .register-link {
            text-align: center;
            margin-top: 25px;
            padding-top: 25px;
            border-top: 1px solid #e9ecef;
            color: #6c757d;
            font-size: 14px;
        }

        .register-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .register-link a:hover {
            color: #5568d3;
            text-decoration: underline;
        }

        /* Row Spacing */
        .row {
            margin-bottom: 20px;
        }

        .row:last-child {
            margin-bottom: 0;
        }

        /* Column Spacing */
        [class*="col-"] {
            padding: 0 12px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .contact-page.inner-page .container {
                margin: 20px;
                padding: 30px 20px;
            }

            .contact-page.inner-page h1,
            .contact-page.inner-page h2 {
                font-size: 28px;
                margin-bottom: 30px;
            }

            .form-control {
                padding: 12px 15px;
                font-size: 15px;
            }

            .btn.theme-btn,
            #buttn {
                padding: 12px 30px;
                font-size: 15px;
            }

            [class*="col-"] {
                padding: 0 8px;
            }
        }

        @media (max-width: 480px) {
            .contact-page.inner-page .container {
                margin: 10px;
                padding: 20px 15px;
            }

            .contact-page.inner-page h1,
            .contact-page.inner-page h2 {
                font-size: 24px;
            }

            .form-group {
                margin-bottom: 20px;
            }

            .form-control {
                padding: 10px 12px;
                font-size: 14px;
            }

            .btn.theme-btn,
            #buttn {
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
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #5a6fd8, #6a4190);
        }

        /* Animation */
        .widget {
            animation: fadeInUp 0.8s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
<div style=" background-image: url('images/img/back2.jpg');">
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
         <div class="page-wrapper">
            
               <div class="container">
                  <ul>
                    
                    
                  </ul>
               </div>
            
            <section class="contact-page inner-page">
               <div class="container">
                  <div class="row">
                     <div class="col-md-8 col-md-offset-2">
                        <div class="widget" >
                           <div class="widget-body">
                              <h2>Login to your account</h2>
							  <?php if(isset($message) && !empty($message)): ?>
								  <span class="alert-message error"><?php echo $message; ?></span> 
							  <?php endif; ?>
							  <?php if(isset($success) && !empty($success)): ?>
								  <span class="alert-message success"><?php echo $success; ?></span>
							  <?php endif; ?>
							  <form action="" method="post">
                                 <div class="row">
                                    <div class="form-group col-sm-12">
                                       <label for="username">Username</label>
                                       <input class="form-control" type="text" name="username" id="username" placeholder="Enter your username"> 
                                    </div>
                                    <div class="form-group col-sm-12">
                                       <label for="password">Password</label>
                                       <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password"> 
                                    </div>
                                 </div>
                                
                                 <div class="row">
                                    <div class="col-sm-4">
                                       <p> <input type="submit" value="Login" id="buttn" name="submit" class="btn theme-btn"> </p>
                                    </div>
                                 </div>
                              </form>
                              <div class="register-link">Not registered? <a href="registration.php">Create an account</a></div>
                  
						   </div>
           
                        </div>
                     
                     </div>
                    
                  </div>
               </div>
            </section>
            
      
        <footer class="footer">
            <div class="container">



                <div class="bottom-footer">
                    <div class="row">

                        <div class="col-xs-12 col-sm-4 address color-black">
                            <h5>Shop</h5>
                            <p>Pickle|Candle</p>

                              <p>Food|Craft</p>

                              <p>Spices|Cakes</p>



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
