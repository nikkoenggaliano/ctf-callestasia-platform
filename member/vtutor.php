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

?>
<!DOCTYPE html>
<html>
<head>
<?= $Modules->header("Tutorial");?>
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
							<h4 class="card-title">List Tutorial</h4>
							<div class="row">
								<div class="col-md-12">
									<div class="table-responsive table-sales">
										<table class="table">
											<tbody>
												<tr>
													<td>Tipe</td>
													<td class="text-left">Nama Tutorial</td>
													<td class="text-right">Author</td>
												</tr>
									<?php
									foreach ($Database->vtutor() as $key => $data) {
									echo '<tr>
								<td width="10%">'.$data['tipe'].'</td>
<td><b style="color:red;"><a target="_blank" href="tutor/'.$data['id'].'">'.$data['nama_tutor'].'</a></b></td>
<td class="text-right"><b><mark style="background-color: Red; color: White; ">'.$data['author'].'</mark></b></td>
											<td class="text-right">';		
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