<?php 
session_start();
$_SESSION['admin_path']='adminofdezi';
require_once($_SESSION['admin_path'].'/models/functions.php');
$func1=new functions();

require_once('functions.php');
$glob= new general_c();

if(basename($_SERVER['SCRIPT_NAME'])!='checkout_proccess.php')
	unset($_SESSION['visitor']);

//unset($_SESSION['visitor']);
//print_r($_SESSION);
$user_pages = array('user_change_password.php','user_edit_profile.php','user_edit_profile_func.php','user_left_user_menu.php','user_my_wishlist.php','user_my_wishlist_del_func.php','user_my_wishlist_func.php','user_order_history.php','user_order_history_detail.php','user_profile.php','user_registration_func.php','user_support.php','user_support_func.php');
if((!isset($_SESSION['userid']) || $_SESSION['userid']=='') && in_array(basename($_SERVER['SCRIPT_NAME']), $user_pages)){
unset($_SESSION['userid']);
header('location:index.php');
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="images/favicon.ico">

    <title>welcome To DeziColl</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link href="css/carousel.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,100italic,300italic,400italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,700' rel='stylesheet' type='text/css'>

	<? 
	if(basename($_SERVER['SCRIPT_NAME'])=='products.php'){?>
	<!--<link rel="stylesheet" id="themeCSS" href="css/price_slider/classic.css"> -->
	<link rel="stylesheet" href="js/slider/css/jquery-ui-1.8.17.custom.css">
	<script src="js/slider/js/jquery-1.7.1.js"></script>
	<script src="js/slider/js/jquery.ui.core.js"></script>
    <script src="js/slider/js/jquery.ui.widget.js"></script>
    <script src="js/slider/js/jquery.ui.mouse.js"></script>
    <script src="js/slider/js/jquery.ui.slider.js"></script>
	<? }else{?>
	<script src="js/jquery.min.js" type="text/javascript"></script>
	<? }?>
    
    <!--slider-->  
	<script type="text/javascript" src="js/ajax.js"></script>
  </head>
<!-- NAVBAR
================================================== -->
  <body>


<div id="show-msg">&nbsp;</div>
<div class="maintopheader">

<div class="headermid">
<div class="container">
<div class="row">
<div class="pull-left col-sm-6 text-left"><a href="index.php"><img src="images/logo.png"></a></div>
<div class="col-sm-6 ">
<div class="row cleafix">
<div class="col-sm-9 text-right topmenu">
<? if(isset($_SESSION['userid'])) echo 'Welcome '.$func1->get_customer($_SESSION['userid'],'fname').' '.$func1->get_customer($_SESSION['userid'],'mname').' '.$func1->get_customer($_SESSION['userid'],'lname').'<a href="#" id="logout1">Logout</a>'; else echo '<a href="#" data-toggle="modal" data-target=".reg-pop" >Login/Register</a>'; ?></div>
<ul class="nav navbar-nav navbar-right nomar">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle crt" data-toggle="dropdown" role="button" aria-expanded="false"> <span class="glyphicon glyphicon-shopping-cart"></span> <span id="cart_item"><? if(!empty($_SESSION['cart'])){
		   		$tot_item_sum=0;
				foreach($_SESSION['cart'] as $ids=>$qty){
		   			$tot_item_sum += $qty[0];  
				}
				echo $tot_item_sum;			}
			else echo "0";?> Items</span><span class="caret"></span></a>
          <ul class="dropdown-menu dropdown-cart cart-ul" role="menu" style="width:300px">
			<li>
			  <table width="100%">
				<tr>
					<td width="20%"></td>
					<td width="50%">Product</td>
					<td width="15%">Price(Rs)</td>
					<td width="5%">QTY</td>
					<td width="10%" valign="middle">&nbsp;</td>
				</tr>
			  </table>
                 
              </li>
			<? 
			if(isset($_SESSION['cart'])){
			foreach($_SESSION['cart'] as $ids=>$qty)
			{ $slt_pro_info=mysql_query("select pro_price, pro_image, pro_name from products where pro_id = $ids");
				$get_pro_info=mysql_fetch_row($slt_pro_info);
				$s_cart_image=explode(",",$get_pro_info[1])[0];
			?>
              <li>
			  <table width="100%">
				<tr class="cart-menu-tr">
					<td width="20%"><img src="images/products/thumb_<?=$s_cart_image;?>" style="width:100%" alt=""></td>
					<td width="50%"><?=$get_pro_info[2]?></td>
					<td width="15%"><?=$get_pro_info[0]?></td>
					<td width="15%" align="center"><?=$qty[0]?></td>
					<td width="10%" valign="middle" id="sdfs"><span class="item-right" id="as">
                        <button class="btn btn-xs btn-danger pull-right remove_item" data-code="<?=$ids?>">x</button>
                    </span></td>
				</tr>
			  </table>
                 
              </li>
              <? }}?>
			  <li class="divider"></li>
              <li><a class="text-center" href="shopping-cart.php">View Cart</a></li>
			  
			  
			  
			  <!--<li>
                  <span class="item">
                    <span class="item-left">
                        <img src="http://lorempixel.com/50/50/" alt="">
                        <span class="item-info">
                            <span>Item name</span>
                            <span>23$</span>
                        </span>
                    </span>
                    <span class="item-right">
                        <button class="btn btn-xs btn-danger pull-right">x</button>
                    </span>
                </span>
              </li>
              <li>
                  <span class="item">
                    <span class="item-left">
                        <img src="http://lorempixel.com/50/50/" alt="">
                        <span class="item-info">
                            <span>Item name</span>
                            <span>23$</span>
                        </span>
                    </span>
                    <span class="item-right">
                        <button class="btn btn-xs btn-danger pull-right">x</button>
                    </span>
                </span>
              </li>
              <li>
                  <span class="item">
                    <span class="item-left">
                        <img src="http://lorempixel.com/50/50/" alt="">
                        <span class="item-info">
                            <span>Item name</span>
                            <span>23$</span>
                        </span>
                    </span>
                    <span class="item-right">
                        <button class="btn btn-xs btn-danger pull-right">x</button>
                    </span>
                </span>
              </li>
              <li class="divider"></li>
              <li><a class="text-center" href="">View Cart</a></li>
          </ul>
        </li>-->
      </ul>
</li>
</ul>
</div>
<div class="row">
<div class="search">
<input type="text" placeholder="Search" maxlength="64" class="form-control input-sm1">
 <button class="btn btn-primary btn-sm btn2" type="submit"><i class="fa fa-search"></i>
</button>
</div>
</div>
</div>
</div>
</div>

</div>
<div class="headerbotm">
<div class="container">
  <nav class="navbar navbar-inverse marfinTop">
    <div class="navbar-header">
    	<button data-target=".js-navbar-collapse" data-toggle="collapse" type="button" class="navbar-toggle">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>

	</div>
	
	<div class="collapse navbar-collapse js-navbar-collapse">
		<ul class="nav navbar-nav">
        <?php $cat = mysql_query("select * from prod_category where cat_parent='0' and cat_status='0'");
			  while($fetchcat = mysql_fetch_assoc($cat))
			  {?>
			<li class="dropdown mega-dropdown">
				<a class="dropdown-toggle" href="products.php?id=<?php echo $fetchcat['cat_id'];?>"><?php echo $fetchcat['cat_name'];?> <span class="caret"></span></a>				
				<ul class="dropdown-menu mega-dropdown-menu" style="display: none;">
					<li class="col-sm-3">
						<ul>
							<li class="dropdown-header"><?php echo $fetchcat['cat_name'];?> Collection</li>                            
                            <img src="images/ad5.jpg" class="img-responsive">
							<li class="divider"></li>
                            <li><a href="products.php?id=<?php echo $fetchcat['cat_id'];?>">View all Collection <span class="glyphicon glyphicon-chevron-right pull-right"></span></a></li>
						</ul>
					</li>
                    <?php 
					$j=0;
					$check = mysql_query("select * from prod_category where cat_parent=$fetchcat[cat_id] and cat_status='0'");
					$k = mysql_num_rows($check);
		/*			if($k=0 || $k<=9){$l=3;}elseif($k=10 || $k<=12){$l=4;}elseif($k=13 || $k<=15){$l=5;}elseif($k=16 || $k<=18){$l=6;}*/
					$l = ceil($k/3);
					for($i=0; $i<3; $i++)
					{ 
					?>
                    <li class="col-sm-3">
						<ul>
                        	<?php $scat = mysql_query("select * from prod_category where cat_parent=$fetchcat[cat_id] and cat_status='0' order by cat_id limit $j, $l");
							/*$fetchscat = mysql_fetch_assoc($scat);
							global $x; $x[] =$fetchscat; print_r($x);
							echo mysql_num_rows($scat);
							print_r($fetchscat);*/
						while($fetchscat = mysql_fetch_assoc($scat))
						{
							?>
                            <li class="dropdown-header"><a href="products.php?id=<?php echo $fetchscat['cat_id'];?>" style="color:#ff3546"><?php echo $fetchscat['cat_name']; ?></a></li>
							<?php $sscat = mysql_query("select * from prod_category where cat_parent=$fetchscat[cat_id] and cat_status='0'");
							while($fetchsscat = mysql_fetch_assoc($sscat))
							{
									echo "<li><a href='products.php?id=".$fetchsscat['cat_id']."'>".$fetchsscat['cat_name']."</a></li>";
							}
							?>
                            <!--<li><a href="#">Carousel Control</a></li>
                            <li><a href="#">Left &amp; Right Navigation</a></li>
							<li><a href="#">Four Columns Grid</a></li>-->
							<li class="divider"></li>
						<?php }?>
                            <!--<li class="dropdown-header">Fonts</li>
                            <li><a href="#">Glyphicon</a></li>
							<li><a href="#">Google Fonts</a></li>
                            <li class="divider"></li>
							<li class="dropdown-header">Fonts</li>
                            <li><a href="#">Glyphicon</a></li>
							<li><a href="#">Google Fonts</a></li>-->
                         
						</ul>
					</li>
					<?php $j=$j+$l;}?>
					
                    
				</ul>				
			</li>
            <?php }?>
            <!--<li class="dropdown mega-dropdown">
    			<a data-toggle="dropdown" class="dropdown-toggle" href="#">Women <span class="caret"></span></a>				
				<ul class="dropdown-menu mega-dropdown-menu" style="display: none;">
					<li class="col-sm-3">
    					<ul>
							<li class="dropdown-header">Features</li>
							<li><a href="#">Auto Carousel</a></li>
                            <li><a href="#">Carousel Control</a></li>
                            <li><a href="#">Left &amp; Right Navigation</a></li>
							<li><a href="#">Four Columns Grid</a></li>
							<li class="divider"></li>
							<li class="dropdown-header">Fonts</li>
                            <li><a href="#">Glyphicon</a></li>
							<li><a href="#">Google Fonts</a></li>
						</ul>
					</li>
					<li class="col-sm-3">
						<ul>
							<li class="dropdown-header">Plus</li>
							<li><a href="#">Navbar Inverse</a></li>
							<li><a href="#">Pull Right Elements</a></li>
							<li><a href="#">Coloured Headers</a></li>                            
							<li><a href="#">Primary Buttons &amp; Default</a></li>							
						</ul>
					</li>
					<li class="col-sm-3">
						<ul>
							<li class="dropdown-header">Much more</li>
                            <li><a href="#">Easy to Customize</a></li>
							<li><a href="#">Calls to action</a></li>
							<li><a href="#">Custom Fonts</a></li>
							<li><a href="#">Slide down on Hover</a></li>                         
						</ul>
					</li>
                    <li class="col-sm-3">
    					<ul>
							<li class="dropdown-header">Women Collection</li>                            
                           <img src="images/ad5.jpg" class="img-responsive">
                            <li class="divider"></li>
                            <li><a href="#">View all Collection <span class="glyphicon glyphicon-chevron-right pull-right"></span></a></li>
						</ul>
					</li>
				</ul>				
			</li>
            <li><a href="#">Watches</a></li>
            <li class="dropdown">
          <a aria-expanded="false" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">Kids <span class="caret"></span></a>
          <ul role="menu" class="dropdown-menu" style="display: none;">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li>
        <li><a href="#">Shoes</a></li>
        <li><a href="">Beauty</a></li>
        <li><a href="">Jewellery</a></li>
        <li><a href="">Home & Kitchen</a></li>
        <li><a href="">Gift Idea</a></li>-->
		</ul>
        
	</div>
  </nav>
</div>

</div>
</div>
