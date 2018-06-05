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

}



$idNya = $Database->search_user_by_id($_SESSION['username'] );

if (empty($idNya)) {

	die('Belum login kamu ini, so ie banget jADI hacker');

}



$q = mysql_query("SELECT * FROM tutor WHERE id = '".((int) mysql_real_escape_string($_GET['id']))."'");

if ($q) {

	if (mysql_num_rows($q) != 1) {

		die('nyari apa sih dek');



	}

} else {

	die('nyari apa sih dek!');





}

$data = mysql_fetch_array($q);




?>

<!DOCTYPE html>

<html>

<head>

<?= $Modules->header(htmlspecialchars($data['nama_tutor']));?>

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

		<div class="content">

				<div class="container-fluid">
					<div class="row">

						<div class="col-md-12">

							<div class="card">

                                <div class="card-header">

                                    <h4 class="card-title"><?=htmlspecialchars($data['nama_tutor'])?> - <?=htmlspecialchars($data['tipe'])?> <small>(Author: <?=htmlspecialchars($data['author'])?>)</small></small>

                                    </h4>

                                </div>

                                <div class="card-content">

                                    <div class="row">

                                        <div class="col-md-12">

                                            <div class="tab-content">

                                                <div class="tab-pane active" id="dashboard-2">

                                                   <?=($data['deskripsi'])?></div>

                                            </div>

                                        </div>

                                    </div>

                            </div>

						</div>

					</div>

				</div>


			</div>

		</div>

<?= $Modules->footer();?>

</body>

</html>