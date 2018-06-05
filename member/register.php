<?php
/**
 * @Author: Eka Syahwan
 * @Date:   2017-04-18 21:21:18
 * @Modified by: Nikko Enggaliano 
 * @Last Modified time: 2018-06-25
 */
require_once('../modules/modules.class.php');

require_once('../modules/db.class.php');

$Modules 	= new Modules;

$Database 	= new Database;
if (empty($_SESSION['nay'])) { $_SESSION['nay'] = md5('nepska'.time().'nayeon'); }

if(isset($_SESSION['iammember']) != ""){
unset($_SESSION['nay']);
header("Location: index.php");
exit;
}

$status = true;

if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirm'])) 
{
	if($_POST['nayeon'] != $_SESSION['nay'])
	{
		die('Gak usah sok heker! Hus!');
	}

if($_POST['password'] != $_POST['confirm'])
{
	echo "<script>alert('Pastikan Password Anda Sama!');window.history.back();</script>";
	die();
}

	$status = $Database->cekcek($_POST['username'],$_POST['email'],$_POST['name']);

	if($status == 'failgan')

	{

		echo '<script>alert("data sudah ada");</script>';

		die();

	}else{

		$stat = $Database->register($_POST['username'],$_POST['password'],$_POST['email'],$_POST['name']);

			if($stat){

				$stat = $Database->memberLogin($_POST['username'],$_POST['password']);

					if($stat != "gagal"){

 					header("Location: ?");

			}

	}

}

}

?>

<!DOCTYPE html>

<html lang="en">

    <head> 

		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
		<script type="text/javascript" href="http://code.jquery.com/jquery-3.3.1.min.js"></script>


		<!-- Website CSS style -->

		<link rel="stylesheet" type="text/css" href="css/style2.css">



		<!-- Website Font style -->

	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">

		

		<!-- Google Fonts -->

		<link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>

		<link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>



		<title>Register Page</title>

	</head>

	<body>

		<div class="container">

			<div class="row main">

				<div class="panel-heading">

	               <div class="panel-title text-center">

	               		<h1 class="title">Callestasia Register Page</h1>

	               		<hr />

	               	</div>

	            </div> 

				<div class="main-login main-center">

					<!-- Start Form -->

					<form class="form-horizontal" method="post" action="">

						

						<div class="form-group">

							<label for="name" class="cols-sm-2 control-label">Your Team</label>

							<div class="cols-sm-10">

								<div class="input-group">

									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>

									<input type="text" class="form-control" name="name" id="name"  placeholder="Enter Your Team"/>

								</div>

							</div>

						</div>



						<div class="form-group">

							<label for="email" class="cols-sm-2 control-label">Your Email</label>

							<div class="cols-sm-10">

								<div class="input-group">

									<span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>

									<input type="text" class="form-control" name="email" id="email"  placeholder="Enter your Email"/>

								</div>

							</div>

						</div>



						<div class="form-group">

							<label for="username" class="cols-sm-2 control-label">Username</label>

							<div class="cols-sm-10">

								<div class="input-group">

									<span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>

									<input type="text" class="form-control" name="username" id="username"  placeholder="Enter your Username"/>

								</div>

							</div>

						</div>

						<div class="form-group">

							<label for="password" class="cols-sm-2 control-label">Password</label>

							<div class="cols-sm-10">

								<div class="input-group">

									<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>

									<input type="password" class="form-control" name="password" id="password"  placeholder="Enter your Password"/>

								</div>

							</div>

						</div>



						<div class="form-group">

							<label for="confirm" class="cols-sm-2 control-label">Confirm Password</label>

							<div class="cols-sm-10">

								<div class="input-group">

									<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>

									<input type="password" class="form-control" name="confirm" id="confirm"  placeholder="Confirm your Password"/>
									<input type="hidden" name="nayeon" value="<?= $_SESSION['nay'] ?>">

								</div>

							</div>

						</div>



						<div class="form-group ">

							<button type="submit" class="btn btn-primary btn-lg btn-block login-button">Register</button>

						</div>

						</form>

						<div class="login-register">

				            <a href="index.php">Login</a>

				        </div>

				</div>

			</div>

		</div>



		<script type="text/javascript" src="assets/js/bootstrap.js"></script>

	</body>

</html>