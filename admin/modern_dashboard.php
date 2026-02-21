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
    <title>Modern Admin Dashboard</title>
    <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="css/helper.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        /* Modern Advanced Admin Dashboard */

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
        }

        .page-wrapper {
            background: transparent;
            min-height: 100vh;
        }

        /* Dashboard Header */
        .dashboard-header {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 40px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .dashboard-header h1 {
            color: #fff;
            font-size: 36px;
            font-weight: 700;
            margin: 0;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .dashboard-header p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 18px;
            margin: 10px 0 0 0;
        }

        /* Modern Dashboard Cards */
        .modern-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border: none;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
            position: relative;
            margin-bottom: 30px;
            backdrop-filter: blur(10px);
        }

        .modern-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, #667eea, #764ba2, #f093fb, #f5576c, #4facfe, #00f2fe, #43e97b, #38f9d7);
            background-size: 400% 400%;
            animation: gradientShift 3s ease infinite;
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .modern-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.2);
        }

        /* Card Variants */
        .users-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(255, 193, 7, 0.1));
            border-left: 5px solid #ffc107;
        }

        .shops-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(102, 126, 234, 0.1));
            border-left: 5px solid #667eea;
        }

        .menu-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(240, 147, 251, 0.1));
            border-left: 5px solid #f093fb;
        }

        .orders-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(67, 233, 123, 0.1));
            border-left: 5px solid #43e97b;
        }

        /* Card Content */
        .card-content {
            padding: 40px;
            display: flex;
            align-items: center;
            min-height: 200px;
        }

        .card-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            margin-right: 30px;
            position: relative;
        }

        .users-card .card-icon {
            background: linear-gradient(135deg, #ffc107, #ffb300);
            color: white;
            box-shadow: 0 8px 25px rgba(255, 193, 7, 0.3);
        }

        .shops-card .card-icon {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        }

        .menu-card .card-icon {
            background: linear-gradient(135deg, #f093fb, #f5576c);
            color: white;
            box-shadow: 0 8px 25px rgba(240, 147, 251, 0.3);
        }

        .orders-card .card-icon {
            background: linear-gradient(135deg, #43e97b, #38f9d7);
            color: white;
            box-shadow: 0 8px 25px rgba(67, 233, 123, 0.3);
        }

        .card-stats {
            flex: 1;
        }

        .card-title {
            font-size: 16px;
            font-weight: 600;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 10px;
        }

        .card-number {
            font-size: 48px;
            font-weight: 800;
            color: #333;
            margin: 0;
            line-height: 1;
            animation: numberPulse 2s ease-out;
        }

        .card-description {
            font-size: 14px;
            color: #888;
            margin-top: 8px;
            font-weight: 500;
        }

        @keyframes numberPulse {
            0% { transform: scale(0.8); opacity: 0; }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); opacity: 1; }
        }

        /* Card Actions */
        .card-actions {
            margin-top: 20px;
        }

        .card-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 25px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .card-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        }

        /* Grid Layout */
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-bottom: 40px;
        }

        /* Stats Overview */
        .stats-overview {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 40px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .stat-item {
            text-align: center;
            padding: 20px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .stat-number {
            font-size: 32px;
            font-weight: 700;
            color: white;
            display: block;
            margin-bottom: 5px;
        }

        .stat-label {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.8);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .card-content {
                padding: 25px;
                flex-direction: column;
                text-align: center;
            }

            .card-icon {
                margin-right: 0;
                margin-bottom: 20px;
            }

            .card-number {
                font-size: 36px;
            }

            .dashboard-header {
                padding: 20px;
                margin-bottom: 20px;
            }

            .dashboard-header h1 {
                font-size: 28px;
            }
        }

        @media (max-width: 480px) {
            .card-content {
                padding: 20px;
            }

            .card-number {
                font-size: 28px;
            }

            .card-icon {
                width: 60px;
                height: 60px;
                font-size: 24px;
            }
        }

        /* Loading Animation */
        .preloader {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #5a6fd8, #6a4190);
        }
    </style>
</head>

<body class="fix-header">
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
			<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /></svg>
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
                    <ul class="navbar-nav mr-auto mt-md-0"></ul>
                    <ul class="navbar-nav my-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="images/bookingSystem/3.png" alt="user" class="profile-pic" />
                            </a>
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
                        <li> <a href="dashboard.php"><i class="fa fa-tachometer"></i><span>Dashboard</span></a></li>
                        <li class="nav-label">Management</li>
                        <li> <a href="all_users.php"> <span><i class="fa fa-user"></i></span><span>Users</span></a></li>
                        <li> <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-archive"></i><span>Shops</span></a>
                            <ul aria-expanded="false" class="collapse">
								<li><a href="all_restaurant.php">All Shops</a></li>
								<li><a href="add_category.php">Add Category</a></li>
                                <li><a href="add_restaurant.php">Add Shop</a></li>
                            </ul>
                        </li>
                       <li> <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-cutlery"></i><span>Menu</span></a>
                            <ul aria-expanded="false" class="collapse">
								<li><a href="all_menu.php">All Menu</a></li>
								<li><a href="add_menu.php">Add Menu</a></li>
                            </ul>
                        </li>
						 <li> <a href="all_orders.php"><i class="fa fa-shopping-cart"></i><span>Orders</span></a></li>
                    </ul>
                </nav>
            </div>
        </div>

        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="dashboard-header">
                    <h1><i class="fas fa-chart-line"></i> Modern Admin Dashboard</h1>
                    <p>Advanced analytics and management overview</p>
                </div>

                <!-- Stats Overview -->
                <div class="stats-overview">
                    <div class="stats-grid">
                        <div class="stat-item">
                            <span class="stat-number"><?php $sql="select * from restaurant"; $result=mysqli_query($db,$sql); echo mysqli_num_rows($result);?></span>
                            <span class="stat-label">Total Shops</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number"><?php $sql="select * from dishes"; $result=mysqli_query($db,$sql); echo mysqli_num_rows($result);?></span>
                            <span class="stat-label">Total Products</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number"><?php $sql="select * from users"; $result=mysqli_query($db,$sql); echo mysqli_num_rows($result);?></span>
                            <span class="stat-label">Total Users</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number"><?php $sql="select * from users_orders"; $result=mysqli_query($db,$sql); echo mysqli_num_rows($result);?></span>
                            <span class="stat-label">Total Orders</span>
                        </div>
                    </div>
                </div>

                <!-- Main Dashboard Cards -->
                <div class="dashboard-grid">
                    <!-- Users Card -->
                    <div class="modern-card users-card">
                        <div class="card-content">
                            <div class="card-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="card-stats">
                                <div class="card-title">User Management</div>
                                <div class="card-number"><?php $sql="select * from users"; $result=mysqli_query($db,$sql); echo mysqli_num_rows($result);?></div>
                                <div class="card-description">Registered users in the system</div>
                                <div class="card-actions">
                                    <a href="all_users.php" class="card-btn">Manage Users</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Shops Card -->
                    <div class="modern-card shops-card">
                        <div class="card-content">
                            <div class="card-icon">
                                <i class="fas fa-store"></i>
                            </div>
                            <div class="card-stats">
                                <div class="card-title">Shop Management</div>
                                <div class="card-number"><?php $sql="select * from restaurant"; $result=mysqli_query($db,$sql); echo mysqli_num_rows($result);?></div>
                                <div class="card-description">Active shops and vendors</div>
                                <div class="card-actions">
                                    <a href="all_restaurant.php" class="card-btn">Manage Shops</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Menu Card -->
                    <div class="modern-card menu-card">
                        <div class="card-content">
                            <div class="card-icon">
                                <i class="fas fa-utensils"></i>
                            </div>
                            <div class="card-stats">
                                <div class="card-title">Menu Management</div>
                                <div class="card-number"><?php $sql="select * from dishes"; $result=mysqli_query($db,$sql); echo mysqli_num_rows($result);?></div>
                                <div class="card-description">Available menu items</div>
                                <div class="card-actions">
                                    <a href="all_menu.php" class="card-btn">Manage Menu</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Orders Card -->
                    <div class="modern-card orders-card">
                        <div class="card-content">
                            <div class="card-icon">
                                <i class="fas fa-shopping-bag"></i>
                            </div>
                            <div class="card-stats">
                                <div class="card-title">Order Management</div>
                                <div class="card-number"><?php $sql="select * from users_orders"; $result=mysqli_query($db,$sql); echo mysqli_num_rows($result);?></div>
                                <div class="card-description">Total orders processed</div>
                                <div class="card-actions">
                                    <a href="all_orders.php" class="card-btn">Manage Orders</a>
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