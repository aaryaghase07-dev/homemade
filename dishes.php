<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php"); 
error_reporting(0);
session_start();

include_once 'product-action.php'; 

?>


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">
    <title>Dishes</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <style>
        h6.mb-1{
            font-size:2rem;
        }
        small.text-muted{
            font-size:20px;
        }
        
        .sticky-cart {
            position: sticky;
            top: 20px;
        }

        .food-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .cart-item:hover .fa-trash {
            color: #dc3545 !important;
        }

        .quantity-btn:hover {
            background-color: #e66305;
            border-color: #00ff6e;
            color: white;
        }

        .btn-primary:hover {
            transform: scale(1.05);
            transition: all 0.2s ease;
        }

        .widget-heading {
            border: none;
        }

        .menu-widget .collapse {
            background-color: #fff;
        }

        /* Cart Container Styling Adjustments */
        /* Reduce height - compact padding and spacing */
        .widget-cart .widget-body {
            padding: 12px 15px !important;
        }

        .widget-cart .order-row .widget-body {
            padding: 10px 15px !important;
        }

        .widget-cart .cart-item {
            padding-bottom: 10px !important;
            margin-bottom: 10px !important;
        }

        .widget-cart .widget-body.bg-light {
            padding: 12px 15px !important;
        }

        .widget-cart .widget-heading {
            padding: 12px 15px !important;
        }

        .widget-cart .price-wrap {
            padding: 0;
        }

        /* Increase width slightly for better balance */
        @media (min-width: 768px) {
            .sticky-cart {
                width: 105%;
            }
        }

        @media (min-width: 992px) {
            .sticky-cart {
                width: 110%;
            }
        }

        @media (max-width: 768px) {
            .sticky-cart {
                position: static;
                margin-top: 20px;
                width: 100%;
            }

            .quantity-controls {
                 justify-content: center;
                margin-bottom: 10px; 
            
            }
        }
    </style> </head>

<body>
    
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
						if(empty($_SESSION["user_id"])) // if user is not login
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
        <!-- <div class="page-wrapper">
            <div class="top-links">
                <div class="container">
                    <ul class="row links">
                      
                        <li class="col-xs-12 col-sm-4 link-item"><span>1</span><a href="restaurants.php">Choose Restaurant</a></li>
                        <li class="col-xs-12 col-sm-4 link-item active"><span>2</span><a href="dishes.php?res_id=<?php echo $_GET['res_id']; ?>">Pick Your favorite food</a></li>
                        <li class="col-xs-12 col-sm-4 link-item"><span>3</span><a href="#">Order and Pay</a></li>
                        
                    </ul>
                </div>
            </div> -->
			<?php $ress= mysqli_query($db,"select * from restaurant where rs_id='$_GET[res_id]'");
									     $rows=mysqli_fetch_array($ress);
										  
										  ?>
            <section class="inner-page-hero bg-image" data-image-src="images/img/show.jpeg">
                <div class="profile">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12  col-md-4 col-lg-4 profile-img">
                                <div class="image-wrap">
                                    <figure><?php echo '<img src="admin/Res_img/'.$rows['image'].'" alt="Restaurant logo" >'; ?></figure>
                                </div>
                            </div>
							
                            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 profile-desc">
                                <div class="pull-left right-text white-txt">
                                    <h6><a href="#"><?php echo $rows['title']; ?></a></h6>
                                    <p><?php echo $rows['address']; ?></p>   
                                </div>
                            </div>
							
							
                        </div>
                    </div>
                </div>
            </section>
            <div class="breadcrumb">
                <div class="container">
                   
                </div>
            </div>
            <div class="container m-t-30">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3 order-1 order-md-1">
                        <div class="sticky-cart">
                         <div class="widget widget-cart shadow-sm border-0">
                                <div class="widget-heading bg-primary text-white rounded-top">
                                    <h3 class="widget-title mb-0">
                                 <i class="fa fa-shopping-cart mr-2"></i>Your Cart
                              </h3>



                                    <div class="clearfix"></div>
                                </div>
                                <div class="order-row bg-white">
                                    <div class="widget-body p-3">


										<?php if(empty($_SESSION["cart_item"])): ?>
											<div class="text-center py-4">
												<i class="fa fa-shopping-cart fa-3x text-muted mb-3"></i>
												<p class="text-muted">Your cart is empty</p>
												<small class="text-muted">Add some homemade items from the menu!</small>
											</div>
										<?php else: ?>

											<?php

$item_total = 0;

foreach ($_SESSION["cart_item"] as $item)
{
?>

                                        <div class="cart-item border-bottom pb-2 mb-2">
											<div class="d-flex justify-content-between align-items-start">
												<div class="flex-grow-1">
													<h6 class="mb-1"><?php echo $item["title"]; ?></h6>
													<small class="text-muted">₹<?php echo $item["price"]; ?> × <?php echo $item["quantity"]; ?></small>
												</div>
												<a href="dishes.php?res_id=<?php echo $_GET['res_id']; ?>&action=remove&id=<?php echo $item["d_id"]; ?>" class="text-danger ml-2" title="Remove item">
													<i class="fa fa-trash"></i>
												</a>
											</div>
											<div class="text-right mt-1">
												<strong>₹<?php echo ($item["price"]*$item["quantity"]); ?></strong>
											</div>
										</div>

	<?php
$item_total += ($item["price"]*$item["quantity"]);
}
?>
										<?php endif; ?>





                                    </div>
                                </div>



                                <div class="widget-body bg-light p-3 rounded-bottom">
                                    <div class="price-wrap text-center">
                                        <p class="mb-1 text-muted">TOTAL</p>
                                        <h3 class="value mb-2"><strong class="text-primary"><?php echo "₹".$item_total; ?></strong></h3>
                                        <p class="text-success mb-3"><i class="fa fa-truck mr-1"></i>Free Delivery!!!</p>
                                        <?php
                                        if($item_total==0){
                                        ?>


                                        <a href="checkout.php?res_id=<?php echo $_GET['res_id'];?>&action=check"  class="btn btn-secondary btn-lg btn-block disabled">Checkout</a>

                                        <?php
                                        }
                                        else{
                                        ?>
                                        <a href="checkout.php?res_id=<?php echo $_GET['res_id'];?>&action=check"  class="btn btn-success btn-lg btn-block"><i class="fa fa-shopping-cart mr-2"></i>Checkout</a>
                                        <?php
                                        }
                                        ?>

                                    </div>
                                </div>




                            </div>
             
                        </div>



                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-6 order-2 order-md-2">
                     <div class="menu-widget" id="2">
                            <div class="widget-heading">
                                <h3 class="widget-title text-dark">
                              MENU <a class="btn btn-link pull-right" data-toggle="collapse" href="#popular2" aria-expanded="true">
                              <i class="fa fa-angle-right pull-right"></i>
                              <i class="fa fa-angle-down pull-right"></i>
                              </a>
                           </h3>
                                <div class="clearfix"></div>
                            </div>
                            <div class="collapse in" id="popular2">
						<?php  
									$stmt = $db->prepare("select * from dishes where rs_id='$_GET[res_id]'");
									$stmt->execute();
									$products = $stmt->get_result();
									if (!empty($products)) 
									{
									foreach($products as $product)
										{
						
													
													 
													 ?>
                                <div class="food-item">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-lg-8">
										<form method="post" action='dishes.php?res_id=<?php echo $_GET['res_id'];?>&action=add&id=<?php echo $product['d_id']; ?>'>
                                            <div class="rest-logo pull-left">
                                                <a class="restaurant-logo pull-left" href="#"><?php echo '<img src="admin/Res_img/dishes/'.$product['img'].'" alt="Food logo">'; ?></a>
                                            </div>
                                
                                            <div class="rest-descr">
                                                <h6><a href="#"><?php echo $product['title']; ?></a></h6>
                                                <p> <?php echo $product['slogan']; ?></p>
                                            </div>
                           
                                        </div>
                               
                                        <div class="col-xs-12 col-sm-12 col-lg-4 pull-right item-cart-info">
										<span class="price pull-left" >₹<?php echo $product['price']; ?></span>
										  <div class="quantity-controls" style="margin-left:30px; display: inline-flex; align-items: center;">
										    <button type="button" class="btn btn-sm btn-outline-secondary quantity-btn minus-btn" style="padding: 2px 8px; margin-right: 5px;">
										      <i class="fa fa-minus"></i>
										    </button>
										    <input class="form-control quantity-input" type="text" name="quantity" value="1" size="2" readonly style="width: 50px; text-align: center; margin: 0 5px;" />
										    <button type="button" class="btn btn-sm btn-outline-secondary quantity-btn plus-btn" style="padding: 2px 8px; margin-right: 10px;">
										      <i class="fa fa-plus"></i>
										    </button>
										  </div>
										  <input type="submit" class="btn theme-btn" value="Add to cart" />
										</div>
										</form>
                                    </div>
              
                                </div>
                
								
								<?php
									  }
									}
									
								?>
								
								
                              
                            </div>
             
                        </div>
            
                       
                    </div>
                    
                </div>
     

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

 
    <div class="modal fade" id="order-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                <div class="modal-body cart-addon">
                    <div class="food-item white">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-lg-6">
                                <div class="item-img pull-left">
                                    <a class="restaurant-logo pull-left" href="#"><img src="http://placehold.it/70x70" alt="Food logo"></a>
                                </div>
              
                                <div class="rest-descr">
                                    <h6><a href="#">Sandwich de Alegranza Grande Menü (28 - 30 cm.)</a></h6> </div>
               
                            </div>
           
                            <div class="col-xs-6 col-sm-2 col-lg-2 text-xs-center"> <span class="price pull-left">₹ 2.99</span></div>
                            <div class="col-xs-6 col-sm-4 col-lg-4">
                                <div class="row no-gutter">
                                    <div class="col-xs-7">
                                        <select class="form-control b-r-0" id="exampleSelect2">
                                            <option>Size SM</option>
                                            <option>Size LG</option>
                                            <option>Size XL</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-5">
                                        <input class="form-control" type="number" value="0" id="quant-input-2"> </div>
                                </div>
                            </div>
                        </div>
               
                    </div>
              
                    <div class="food-item">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-lg-6">
                                <div class="item-img pull-left">
                                    <a class="restaurant-logo pull-left" href="#"><img src="http://placehold.it/70x70" alt="Food logo"></a>
                                </div>
                    
                                <div class="rest-descr">
                                    <h6><a href="#">Sandwich de Alegranza Grande Menü (28 - 30 cm.)</a></h6> </div>
                
                            </div>
               
                            <div class="col-xs-6 col-sm-2 col-lg-2 text-xs-center"> <span class="price pull-left">₹ 2.49</span></div>
                            <div class="col-xs-6 col-sm-4 col-lg-4">
                                <div class="row no-gutter">
                                    <div class="col-xs-7">
                                        <select class="form-control b-r-0" id="exampleSelect3">
                                            <option>Size SM</option>
                                            <option>Size LG</option>
                                            <option>Size XL</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-5">
                                        <input class="form-control" type="number" value="0" id="quant-input-3"> </div>
                                </div>
                            </div>
                        </div>
            
                    </div>
            
                    <div class="food-item">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-lg-6">
                                <div class="item-img pull-left">
                                    <a class="restaurant-logo pull-left" href="#"><img src="http://placehold.it/70x70" alt="Food logo"></a>
                                </div>
                       
                                <div class="rest-descr">
                                    <h6><a href="#">Sandwich de Alegranza Grande Menü (28 - 30 cm.)</a></h6> </div>
                 
                            </div>
                
                            <div class="col-xs-6 col-sm-2 col-lg-2 text-xs-center"> <span class="price pull-left">₹ 1.99</span></div>
                            <div class="col-xs-6 col-sm-4 col-lg-4">
                                <div class="row no-gutter">
                                    <div class="col-xs-7">
                                        <select class="form-control b-r-0" id="exampleSelect5">
                                            <option>Size SM</option>
                                            <option>Size LG</option>
                                            <option>Size XL</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-5">
                                        <input class="form-control" type="number" value="0" id="quant-input-4"> </div>
                                </div>
                            </div>
                        </div>
                 
                    </div>
               
                    <div class="food-item">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-lg-6">
                                <div class="item-img pull-left">
                                    <a class="restaurant-logo pull-left" href="#"><img src="http://placehold.it/70x70" alt="Food logo"></a>
                                </div>
                 
                                <div class="rest-descr">
                                    <h6><a href="#">Sandwich de Alegranza Grande Menü (28 - 30 cm.)</a></h6> </div>
                      
                            </div>
                       
                            <div class="col-xs-6 col-sm-2 col-lg-2 text-xs-center"> <span class="price pull-left">₹ 3.15</span></div>
                            <div class="col-xs-6 col-sm-4 col-lg-4">
                                <div class="row no-gutter">
                                    <div class="col-xs-7">
                                        <select class="form-control b-r-0" id="exampleSelect6">
                                            <option>Size SM</option>
                                            <option>Size LG</option>
                                            <option>Size XL</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-5">
                                        <input class="form-control" type="number" value="0" id="quant-input-5"> </div>
                                </div>
                            </div>
                        </div>
           
                    </div>
             
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn theme-btn">Add to cart</button>
                </div>
            </div>
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

    <!-- Quantity Control Script -->
    <script>
        $(document).ready(function() {
            // Handle quantity increment/decrement
            $('.quantity-btn').click(function() {
                var $button = $(this);
                var $input = $button.closest('.quantity-controls').find('.quantity-input');
                var currentValue = parseInt($input.val());

                if ($button.hasClass('plus-btn')) {
                    $input.val(currentValue + 1);
                } else if ($button.hasClass('minus-btn')) {
                    if (currentValue > 1) {
                        $input.val(currentValue - 1);
                    }
                }
            });
        });
    </script>
</body>

</html>
