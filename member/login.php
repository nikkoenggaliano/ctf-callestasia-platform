<?php
/**
 * @Author: Eka Syahwan
 * @Date:   2017-04-18 21:21:18
 * @Modified by: Nikko Enggaliano & Muhammad Gholy
 * @Last Modified time: 2018-06-25
 */
require_once('../modules/modules.class.php');
require_once('../modules/db.class.php');
$Database = new Database;
if (empty($_SESSION['nay'])) { $_SESSION['nay'] = md5('nepska'.time().'nayeon'); }
if(isset($_SESSION['iammember']) != ""){
unset($_SESSION['nay']);
header("Location: index.php");
exit;

}
if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['nayeon'])){
		if($_POST['nayeon'] != $_SESSION['nay'])
	{
		die('Gak usah sok heker! Hus!');
	}
$status = $Database->memberLogin($_POST['username'],$_POST['password']);
if($status != "gagal"){
header("Location: ?");
}
} 
?>

<!DOCTYPE html>
<html>
<head>
<title>Login Member | Callestasia</title>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Custom Theme files -->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!--web-fonts-->
<link href='//fonts.googleapis.com/css?family=Signika:400,300,600,700' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Righteous' rel='stylesheet' type='text/css'>
<!--//web-fonts-->
<!--js-->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="js/easyResponsiveTabs.js" type="text/javascript"></script>
	<script type="text/javascript">
		$(document).ready(function () {
			$('#horizontalTab').easyResponsiveTabs({
				type: 'default', //Types: default, vertical, accordion           
				width: 'auto', //auto or any width like 600px
				fit: true   // 100% fit in a container
			});
		});
	   </script>
<!--//js-->
<script type="text/javascript">
	function cum()
	{
		alert('Coming soon');
	}

function cum1()
{
	alert('If You forget your password, Please Contact me at nikkoenggaliano@gmail.com');
	alert('Thank You!');
}	
</script>
</head>
<body>
	<!-- main -->
	<div class="main">
		<h1>Callestasia Login Page</h1>
		<div class="login-form">
			<div class="login-left">
				<div class="logo">
					<img src="images/i1.jpg" alt=""/>
					<h2>Welcome!</h2>
					<p>You Must Login First</p>
					<?php
							if($status == "gagal"){
								echo '<script>alert("Error, Username / Password Salah!");</script>';
								echo '<p style="color:pink; font-size:100%;"><strong>Username / Password Salah!</strong></p>';
							}
						?>

				</div>
				<div class="social-icons">
					<ul>
						<li><a href="https://fb.com/nepska" target="_blank"><img src="images/i1.png" alt=""/></a></li>
						<li><a href="#" class="twt"><img src="images/i2.png" alt=""/></a></li>
						<li><a href="#" class="ggl"><img src="images/i3.png" alt=""/></a></li>
					</ul>
				</div>
			</div>
			<div class="login-right">
				<div class="sap_tabs">
					<div id="horizontalTab" style="display: block; width: 100%; margin: 0px;">
						<ul class="resp-tabs-list">
							<li class="resp-tab-item" aria-controls="tab_item-0" role="tab"><span style="color:red;">Login</span></li>
							<li class="resp-tab-item" aria-controls="tab_item-1" role="tab"><label>/</label><a href="register.php"><span style="color:red;">Sign up</span></a></li>
							<div class="clear"> </div>
						</ul>				  	 
						<div class="resp-tabs-container">
							<div class="tab-1 resp-tab-content" aria-labelledby="tab_item-0">
								<div class="login-top">
									<form method="post" action="" autocomplete="off">
										<input type="hidden" name="nayeon" value="<?= $_SESSION['nay'] ?>">
										<input type="text" name="username" class="email" placeholder="Username" >
										<input type="password" name="password" class="password" placeholder="Password">		
									<!-- </form> -->
									<div class="login-text">
										<ul>
											<!-- <li><label><input type="checkbox" value="Remember-Me" /> Remember Me?</label></li> -->
											<li><a href="javascript:cum1();">Forgot password?</a></li>
									</div>
									<div class="login-bottom login-bottom1">
										<div class="submit">
											<!-- <button type="submit">Lets GO!</button>
											<form action="logon.php" method="post"> -->
												<input type="submit" name="submit" value="Lets GO!">
											</form>
										</div>
										<ul>
											<li><p>Or login with</p></li>
											<li><a href="javascript:cum();"><img src="images/i1.png" alt=""/></a></li>
											<li><a href="javascript:cum();" class="twt"><img src="images/i2.png" alt=""/></a></li>
											<li><a href="javascript:cum();" class="ggl"><img src="images/i3.png" alt=""/></a></li>
										</ul>
										<div class="clear"></div>
									</div>	
								</div>
							</div>
						</div>							
					</div>	
				</div>
			</div>
			<div class="clear"> </div>
		</div>
	</div>
	<!--//main -->	
	<div class="copyright">
		<p> &copy; 2017 - <?php echo date("Y")?><a href="https://callestasia.com/" target="_blank" >  Callestasia CTF </a></p>
	</div>	
</body>
</html>