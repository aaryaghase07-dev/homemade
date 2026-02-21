<!DOCTYPE html>
<html lang="en">
<?php

session_start(); 
error_reporting(0); 
include("connection/connect.php"); 
if(isset($_POST['submit'] )) 
{
     if(empty($_POST['firstname']) || 
   	    empty($_POST['lastname'])|| 
		empty($_POST['email']) ||  
		empty($_POST['phone'])||
		empty($_POST['password'])||
		empty($_POST['cpassword']) ||
		empty($_POST['cpassword']))
		{
			$message = "All fields must be Required!";
		}
	else
	{
	
	$check_username= mysqli_query($db, "SELECT username FROM users where username = '".$_POST['username']."' ");
	$check_email = mysqli_query($db, "SELECT email FROM users where email = '".$_POST['email']."' ");
		

	
	if($_POST['password'] != $_POST['cpassword']){  
       	
          echo "<script>alert('Password not match');</script>"; 
    }
	elseif(strlen($_POST['password']) < 6)  
	{
      echo "<script>alert('Password Must be >=6');</script>"; 
	}
	elseif(strlen($_POST['phone']) < 10)  
	{
      echo "<script>alert('Invalid phone number!');</script>"; 
	}

    elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
    {
          echo "<script>alert('Invalid email address please type a valid email!');</script>"; 
    }
	elseif(mysqli_num_rows($check_username) > 0) 
     {
       echo "<script>alert('Username Already exists!');</script>"; 
     }
	elseif(mysqli_num_rows($check_email) > 0) 
     {
       echo "<script>alert('Email Already exists!');</script>"; 
     }
	else{
       
	 
	$mql = "INSERT INTO users(username,f_name,l_name,email,phone,password,address) VALUES('".$_POST['username']."','".$_POST['firstname']."','".$_POST['lastname']."','".$_POST['email']."','".$_POST['phone']."','".md5($_POST['password'])."','".$_POST['address']."')";
	mysqli_query($db, $mql);
	
		 header("refresh:0.1;url=login.php");
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
    <title>Registration</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <style>
        /* Modern Registration Page Styling */

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }

        .page-wrapper {
            min-height: 100vh;
            background: transparent;
        }

        /* Modern Registration Container */
        .contact-page.inner-page .container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            padding: 50px;
            margin: 50px auto;
            max-width: 900px;
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

        /* Textarea Styling */
        textarea.form-control {
            resize: vertical;
            min-height: 80px;
        }

        /* Button Styling */
        .btn.theme-btn {
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

        .btn.theme-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(102, 126, 234, 0.4);
        }

        .btn.theme-btn:active {
            transform: translateY(0);
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

            .btn.theme-btn {
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

            .btn.theme-btn {
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
    </style></head>
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
                     <div class="col-md-8">
                        <div class="widget" >
                           <div class="widget-body">
                            
							  <form action="" method="post">
                                 <div class="row">
								  <div class="form-group col-sm-12">
                                       <label for="exampleInputEmail1">User-Name</label>
                                       <input class="form-control" type="text" name="username" id="example-text-input"> 
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="exampleInputEmail1">First Name</label>
                                       <input class="form-control" type="text" name="firstname" id="example-text-input"> 
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="exampleInputEmail1">Last Name</label>
                                       <input class="form-control" type="text" name="lastname" id="example-text-input-2"> 
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="exampleInputEmail1">Email Address</label>
                                       <input type="text" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp"> 
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="exampleInputEmail1">Phone number</label>
                                       <input class="form-control" type="text" name="phone" id="example-tel-input-3"> 
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="exampleInputPassword1">Password</label>
                                       <input type="password" class="form-control" name="password" id="exampleInputPassword1"> 
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="exampleInputPassword1">Confirm password</label>
                                       <input type="password" class="form-control" name="cpassword" id="exampleInputPassword2"> 
                                    </div>
									 <div class="form-group col-sm-12">
                                       <label for="exampleTextarea">Delivery Address</label>
                                       <textarea class="form-control" id="exampleTextarea"  name="address" rows="3"></textarea>
                                    </div>
                                   
                                 </div>
                                
                                 <div class="row">
                                    <div class="col-sm-4">
                                       <p> <input type="submit" value="Register" name="submit" class="btn theme-btn"> </p>
                                    </div>
                                 </div>
                              </form>
                  
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