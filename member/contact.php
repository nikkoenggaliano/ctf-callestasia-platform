<?php

/**
 * @Author: Eka Syahwan
 * @Date:   2017-04-18 21:21:18
 * @Modified by: Nikko Enggaliano & Muhammad Gholy
 * @Last Modified time: 2018-06-25
 */

require_once('../modules/modules.class.php');

require_once('../modules/db.class.php');

$Modules = new Modules;$Modules->isUser();

$Database = new Database;

if(isset($_SESSION['username']) == ""){

	header("Location: login.php");
	exit;

}

?>

<!DOCTYPE html>

<html>

<head>

<?= $Modules->header("Dashboard");?>

</head>

<body>

	<div class="wrapper">

	<?= $Modules->slideMenu();?>

	<div class="main-panel">

		<!-- Head Navigator -->

		<nav class="navbar navbar-transparent navbar-absolute">

			<div class="container-fluid">

				<div class="navbar-minimize">

					<button id="minimizeSidebar" class="btn btn-round btn-white btn-fill btn-just-icon">

						<i class="material-icons visible-on-sidebar-regular">more_vert</i>

						<i class="material-icons visible-on-sidebar-mini">view_list</i>

					</button>

				</div>

				<div class="navbar-header">

					<button type="button" class="navbar-toggle" data-toggle="collapse">

						<span class="sr-only">Toggle navigation</span>

						<span class="icon-bar"></span>

						<span class="icon-bar"></span>

						<span class="icon-bar"></span>

					</button>

				</div>

			</div>

		</nav>

		<!--End Head Navigator -->

		

	<div class="container-fluid">

		<div class="col-sm-8 col-sm-offset-2">

			<!--      Wizard container        -->

			<div class="wizard-container">

				<div class="card wizard-card" data-color="rose" id="wizardProfile">

					<form action="" method="" novalidate="novalidate">

						<!--        You can switch " data-color="purple" "  with one of the next bright colors: "green", "orange", "red", "blue"       -->

						<div class="wizard-header">

							<h3 class="wizard-title">

								Contact

							</h3>

							<h5>Anda bisa menghubungi kami.</h5>

						</div>

						<div class="wizard-navigation">

							<ul class="nav nav-pills">

								<li style="width: 33.3333%;" class="active">

									<a href="#about" data-toggle="tab" aria-expanded="true">About</a>

								</li>

								

							</ul>

							<div class="moving-tab" style="width: 254.688px; transform: translate3d(-8px, 0px, 0px); transition: transform 0s;">About</div></div>

							<div class="tab-content">

								<div class="tab-pane active" id="about">

									<div class="col-sm-10">

										<div class="form-group">

											<label>Nama</label>

											<p class="form-control-static">Nikko Enggaliano</p>

											<label>Line</label>

											<p class="form-control-static">nepska</p>

											<label>Email</label>

											<p class="form-control-static">nikkoenggaliano@gmail.com</p>

											<label>Alamat</label>

											<p class="form-control-static">Sidoarjo </p><br/><br/>

											<label>Edited</label>

											<p class="form-control-static"><a href="https://www.muhammadgholy.me" target="_blank">Muhammad Gholy</a></p>

										</div>

									</div>

								</div>

							</div>

						</form>

					</div>

				</div>

				<!-- wizard container -->

			</div>

		</div>



	</div>



</div>

<?= $Modules->footer();?>

</body>

</html>