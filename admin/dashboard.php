<!DOCTYPE html>
<html lang="en">
<?php
include("../connection/connect.php");
error_reporting(0);
session_start();
if(empty($_SESSION["adm_id"]))
{
	header('location:index.php');
}
else
{
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Admin Panel</title>
    <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="css/helper.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <style>
        /* Modern Admin Dashboard Styling */

        /* Main Dashboard Container */
        .page-wrapper {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }

        /* Dashboard Header */
        .card-outline-primary .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 15px 15px 0 0 !important;
            padding: 25px;
            box-shadow: 0 4px 20px rgba(102, 126, 234, 0.3);
        }

        .card-outline-primary .card-header h4 {
            color: #fff;
            font-size: 28px;
            font-weight: 700;
            margin: 0;
            text-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }

        /* Modern Dashboard Cards */
        .dashboard-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            border: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
            position: relative;
            margin-bottom: 30px;
            height: 180px;
        }

        .dashboard-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #667eea, #764ba2, #f093fb, #f5576c);
        }

        .dashboard-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        /* Card Variations */
        .dashboard-card.shop-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .dashboard-card.product-card {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
        }

        .dashboard-card.user-card {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
        }

        .dashboard-card.order-card {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            color: white;
        }

        /* Card Content */
        .dashboard-card .card-body {
            padding: 30px;
            height: 100%;
            display: flex;
            align-items: center;
            position: relative;
        }

        .dashboard-card .stat-icon {
            font-size: 48px;
            opacity: 0.8;
            margin-right: 25px;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
        }

        .dashboard-card .stat-content h2 {
            font-size: 42px;
            font-weight: 700;
            margin: 0 0 5px 0;
            text-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }

        .dashboard-card .stat-content p {
            font-size: 16px;
            font-weight: 500;
            margin: 0;
            opacity: 0.9;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Animated Counter Effect */
        .counter {
            animation: countUp 2s ease-out;
        }

        @keyframes countUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .dashboard-card {
                height: 150px;
                margin-bottom: 20px;
            }

            .dashboard-card .card-body {
                padding: 20px;
            }

            .dashboard-card .stat-icon {
                font-size: 36px;
                margin-right: 15px;
            }

            .dashboard-card .stat-content h2 {
                font-size: 32px;
            }

            .dashboard-card .stat-content p {
                font-size: 14px;
            }
        }

        @media (max-width: 480px) {
            .dashboard-card {
                height: 130px;
            }

            .dashboard-card .card-body {
                padding: 15px;
                flex-direction: column;
                text-align: center;
            }

            .dashboard-card .stat-icon {
                margin-right: 0;
                margin-bottom: 10px;
            }

            .dashboard-card .stat-content h2 {
                font-size: 28px;
            }
        }

        /* Modern Sidebar Styling */
        .left-sidebar {
            background: linear-gradient(180deg, #2c3e50 0%, #34495e 100%);
            box-shadow: 4px 0 15px rgba(0, 0, 0, 0.1);
            border-right: 1px solid rgba(255, 255, 255, 0.1);
        }

        .scroll-sidebar {
            height: calc(100vh - 70px);
            overflow-y: auto;
            overflow-x: hidden;
        }

        /* Custom Scrollbar for Sidebar */
        .scroll-sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .scroll-sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 3px;
        }

        .scroll-sidebar::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #667eea, #764ba2);
            border-radius: 3px;
            transition: all 0.3s ease;
        }

        .scroll-sidebar::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, #5a6fd8, #6a4190);
        }

        /* Sidebar Navigation */
        .sidebar-nav {
            padding: 20px 0;
        }

        .sidebar-nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        /* Navigation Items */
        .sidebar-nav li {
            position: relative;
            margin: 0;
        }

        .sidebar-nav li a {
            display: flex;
            align-items: center;
            padding: 15px 25px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-size: 15px;
            font-weight: 500;
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
            position: relative;
            overflow: hidden;
        }

        .sidebar-nav li a:hover,
        .sidebar-nav li a:focus {
            color: #fff;
            background: linear-gradient(90deg, rgba(102, 126, 234, 0.2) 0%, rgba(118, 75, 162, 0.2) 100%);
            border-left-color: #667eea;
            text-decoration: none;
            transform: translateX(5px);
        }

        .sidebar-nav li a i {
            margin-right: 15px;
            font-size: 18px;
            width: 20px;
            text-align: center;
            color: rgba(255, 255, 255, 0.7);
            transition: all 0.3s ease;
        }

        .sidebar-nav li a:hover i {
            color: #667eea;
            transform: scale(1.1);
        }

        /* Active Navigation Item */
        .sidebar-nav li a.active {
            color: #fff;
            background: linear-gradient(90deg, rgba(102, 126, 234, 0.3) 0%, rgba(118, 75, 162, 0.3) 100%);
            border-left-color: #667eea;
            box-shadow: inset 0 0 10px rgba(102, 126, 234, 0.2);
        }

        /* Navigation Labels */
        .nav-label {
            color: rgba(255, 255, 255, 0.6);
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 20px 25px 10px;
            margin: 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Divider */
        .nav-devider {
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            margin: 20px 0;
        }

        /* Submenu Styling */
        .sidebar-nav .collapse {
            background: rgba(0, 0, 0, 0.1);
            border-left: 2px solid rgba(102, 126, 234, 0.3);
        }

        .sidebar-nav .collapse li a {
            padding: 12px 25px 12px 50px;
            font-size: 14px;
            border-left: none;
        }

        .sidebar-nav .collapse li a:hover {
            background: rgba(102, 126, 234, 0.1);
            border-left: 4px solid rgba(102, 126, 234, 0.5);
        }

        /* Dropdown Arrow */
        .has-arrow::after {
            content: '\f107';
            font-family: 'FontAwesome';
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            transition: all 0.3s ease;
            color: rgba(255, 255, 255, 0.6);
        }

        .has-arrow[aria-expanded="true"]::after {
            transform: translateY(-50%) rotate(180deg);
            color: #667eea;
        }

        /* Hover Effects */
        .sidebar-nav li {
            transition: all 0.3s ease;
        }

        .sidebar-nav li:hover {
            transform: translateX(2px);
        }

        /* Icon Animations */
        .sidebar-nav li a .fa {
            transition: all 0.3s ease;
        }

        .sidebar-nav li a:hover .fa {
            transform: scale(1.1) rotate(5deg);
            color: #667eea;
        }

        /* Responsive Sidebar */
        @media (max-width: 768px) {
            .left-sidebar {
                position: fixed;
                top: 0;
                left: -280px;
                width: 280px;
                height: 100vh;
                z-index: 1050;
                transition: left 0.3s ease;
            }

            .left-sidebar.show {
                left: 0;
            }

            .scroll-sidebar {
                height: 100vh;
            }
        }

        /* Loading Animation */
        .preloader {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
        }

        /* Subtle background pattern */
        .page-wrapper::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image:
                radial-gradient(circle at 25% 25%, rgba(102, 126, 234, 0.1) 2px, transparent 2px),
                radial-gradient(circle at 75% 75%, rgba(240, 147, 251, 0.1) 2px, transparent 2px);
            background-size: 50px 50px;
            pointer-events: none;
            z-index: -1;
        }
    </style>
</head>

<body class="fix-header">

    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
			<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    
    <div id="main-wrapper">
     
        <div class="header">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">

            <div class="navbar-header">
                    <a class="navbar-brand" href="dashboard.php">
                        
                       <img src="../images/logo/HomeMadeWithCare.png" alt="HomeMadeWithCare Logo" style="height: 45px;">
                    </a>
                </div>

                <div class="navbar-collapse">
                    <ul class="navbar-nav mr-auto mt-md-0">
                    </ul>
                    
                       
                      
                      
                    <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted  " href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/bookingSystem/3.png" alt="user" class="profile-pic" /></a>
                            <div class="dropdown-menu dropdown-menu-right animated zoomIn">
                                <ul class="dropdown-user">
                                    <li><a href="logout.php"><i class="fa fa-power-off"></i> Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
      
        <div class="left-sidebar">
   
            <div class="scroll-sidebar">
       
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                        <li class="nav-label">Home</li>
                        <li> <a href="dashboard.php"><i class="fa fa-tachometer"></i><span>Dashboard</span></a>
                        </li>
                        <li class="nav-label">Log</li>
                        <li> <a href="all_users.php">  <span><i class="fa fa-user f-s-20 "></i></span><span>Users</span></a></li>
                        <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-archive f-s-20 color-warning"></i><span class="hide-menu">Shop</span></a>
                            <ul aria-expanded="false" class="collapse">
								<li><a href="all_restaurant.php">All Shop</a></li>
								<li><a href="add_category.php">Add Category</a></li>
                                <li><a href="add_restaurant.php">Add Shop</a></li>
                                
                            </ul>
                        </li>
                       <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-cutlery" aria-hidden="true"></i><span class="hide-menu">Menu</span></a>
                            <ul aria-expanded="false" class="collapse">
								<li><a href="all_menu.php">All Menues</a></li>
								<li><a href="add_menu.php">Add Menu</a></li>
                              
                                
                            </ul>
                        </li>
						 <li> <a href="all_orders.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span>Orders</span></a></li>
                         
                    </ul>
                </nav>
            
            </div>
           
        </div>
    
        <div class="page-wrapper">
         
        
        
            <div class="container-fluid">
            <div class="col-lg-12">
                        <div class="card card-outline-primary">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">Dashboard</h4>
                            </div>
                     <div class="row">

                    <div class="col-md-3 col-sm-6">
                        <div class="dashboard-card shop-card">
                            <div class="card-body">
                                <i class="fa fa-archive stat-icon"></i>
                                <div class="stat-content">
                                    <h2 class="counter"><?php $sql="select * from restaurant";
												$result=mysqli_query($db,$sql);
													$rws=mysqli_num_rows($result);

													echo $rws;?></h2>
                                    <p>Shops</p>
                                </div>
                            </div>
                        </div>
                    </div>

					 <div class="col-md-3 col-sm-6">
                        <div class="dashboard-card product-card">
                            <div class="card-body">
                                <i class="fa fa-cutlery stat-icon" aria-hidden="true"></i>
                                <div class="stat-content">
                                    <h2 class="counter"><?php $sql="select * from dishes";
												$result=mysqli_query($db,$sql);
													$rws=mysqli_num_rows($result);

													echo $rws;?></h2>
                                    <p>Products</p>
                                </div>
                            </div>
                        </div>
                    </div>
					
                    <div class="col-md-3 col-sm-6">
                        <div class="dashboard-card user-card">
                            <div class="card-body">
                                <i class="fa fa-users stat-icon"></i>
                                <div class="stat-content">
                                    <h2 class="counter"><?php $sql="select * from users";
												$result=mysqli_query($db,$sql);
													$rws=mysqli_num_rows($result);

													echo $rws;?></h2>
                                    <p>Users</p>
                                </div>
                            </div>
                        </div>
                    </div>

					<div class="col-md-3 col-sm-6">
                        <div class="dashboard-card order-card">
                            <div class="card-body">
                                <i class="fa fa-shopping-cart stat-icon" aria-hidden="true"></i>
                                <div class="stat-content">
                                    <h2 class="counter"><?php $sql="select * from users_orders";
												$result=mysqli_query($db,$sql);
													$rws=mysqli_num_rows($result);

													echo $rws;?></h2>
                                    <p>Orders</p>
                                </div>
                            </div>
                        </div>
                    </div>	                   
                </div>               
            </div>
        </div>     
    </div>
   
    <script src="js/lib/jquery/jquery.min.js"></script>
    <script src="js/lib/bootstrap/js/popper.min.js"></script>
    <script src="js/lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/jquery.slimscroll.js"></script>
    <script src="js/sidebarmenu.js"></script>
    <script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="js/custom.min.js"></script>

</body>

</html>
<?php
}
?>