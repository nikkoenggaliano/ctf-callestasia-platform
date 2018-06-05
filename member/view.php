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
$idNya = $Database->search_user_by_id($_SESSION['username'] );
if (empty($idNya)) {
	die('Belum login kamu ini, so ie banget jADI hacker');
}

?>
<!DOCTYPE html>
<html>
<head>
<?= $Modules->header("Soal");?>
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
						<div class="card-header card-header-icon" data-background-color="green">
							<i class="material-icons">language</i>
						</div>
						<div class="card-content">
							<h4 class="card-title">List Challenge</h4>
							<div class="row">
								<div class="col-md-12">
									<div class="table-responsive table-sales">
										<table class="table">
											<tbody>
												<tr>
													<td>Kategori</td>
													<td>Nama Soal</td>
													<td>Solver</td>
													<td>Level</td>
													<td class="text-right">
														Point
													</td>
													<!-- 	<td class="text-right">
															Time
														</td> -->
												</tr>
									<?php
									foreach ($Database->view() as $key => $data) {
	$saol = mysql_query("SELECT * FROM last_solved where soal_id = '".$data['id']."'");
	$jum = mysql_num_rows($saol);

									echo '<tr>
											<td width="10%">'.$data['kategori'].'</td>';

											$uvuvweweonyeten = mysql_query("SELECT * FROM last_solved WHERE peserta_id = '".mysql_real_escape_string($idNya)."' AND soal_id = '".mysql_real_escape_string($data['id'])."'");
											if (mysql_num_rows($uvuvweweonyeten) >= 1) {
												echo '<td><del><u><a target="_blank" href="view/'.$data['id'].'">'.$data['nama_soal'].'</a></u></del></td>';
											} else {
												echo '<td><b style="color:red;"><a target="_blank" href="view/'.$data['id'].'">'.$data['nama_soal'].'</a></b></td>';

											}
												echo '	
												<td class="text-left">
												<div class="flag"><i>'.$jum.'</i></div>
											</td>
												<td class="text-left">
												<div class="flag"><b>'.$data['level'].'</b></div>
											</td>
												<td class="text-right"><b><mark style="background-color: pink;">'.$data['score'].'</mark></b></td>
											<td class="text-right">
												<div class="flag">'.$data['time'].'</div>
											</td>
										</tr>';
									}
									?>
											</tbody>
										</table>
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