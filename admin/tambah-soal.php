<?php
/**
 * @Author: Eka Syahwan
 * @Date:   2017-04-18 21:21:18
 * @Modified by: Nikko Enggaliano & Muhammad Gholy
 * @Last Modified time: 2018-06-25
 */
require_once('../modules/modules.class.php');
require_once('../modules/db.class.php');
$Modules = new Modules;$Modules->isAdmin();
$Database = new Database;
if(isset($_SESSION['username']) == ""){
	header("Location: login.php");
}
if(isset($_POST['name']) != "" && isset($_POST['description']) != "" && isset($_POST['kategori']) && isset($_POST['score']) != "" && isset($_POST['flag']) && isset($_POST['level']) != "") {
	$status = $Database->tambahkan_flag(mysql_real_escape_string($_POST['name']),mysql_real_escape_string($_POST['description']),mysql_real_escape_string($_POST['kategori']),mysql_real_escape_string($_POST['score']),mysql_real_escape_string($_POST['flag']),mysql_real_escape_string($_POST['level']));	
	if($status == "sukses"){
		header("Location: manage-flag?_=success");
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<?= $Modules->header("Tambah Flag");?>
<style>
	textarea {
	border: 1px solid #ffffff;
	width: 100%;
	height: 400px;
	padding-left: 5px;
	margin: 10px auto;
	resize: none;
	background: transparent;
	color: #ffffff;
	font-family: 'Ubuntu';
	font-size: 13px;
}
</style>
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
			<?php
				if($status){
					echo '<div class="alert alert-danger">'.$status.'!</div>';
				}
			?>
				<div class="row">
				<div class="col-md-12">
					<div class="card">
						<form method="post" action="" class="form-horizontal">
							<div class="card-header card-header-text" data-background-color="rose">
								<h4 class="card-title">Tambah Flag</h4>
							</div>
							<div class="card-content">
								<div class="row">
									<label class="col-sm-2 label-on-left">Nama Soal</label>
									<div class="col-sm-10">
										<div class="form-group label-floating is-empty">
											<label class="control-label"></label>
											<input name="name" type="text" class="form-control" placeholder="Nama Soal" required="">
											<span class="material-input"></span>
										</div>
									</div>
								</div>
								<div class="row">
									<label class="col-sm-2 label-on-left">Deskripsi Flag</label>
									<div class="col-sm-10">
										<div class="form-group label-floating is-empty">
											<label class="control-label"></label>
											<textarea name="description" type="text" class="form-control" placeholder="Deskripsi Flag" required=""> </textarea>
											<span class="material-input"></span>
										</div>
									</div>
								</div>
							
								<div class="row">
									<label class="col-sm-2 label-on-left">Kategori</label>
									<div class="col-sm-10">
										<div class="form-group label-floating is-empty">
											<label class="control-label"></label>
											<input name="kategori" type="text" class="form-control" placeholder="Kategori" required="">
											<span class="material-input"></span></div>
										</div>
								</div>
								<div class="row">
									<label class="col-sm-2 label-on-left">Score</label>
									<div class="col-sm-10">
										<div class="form-group label-floating is-empty">
											<label class="control-label"></label>
											<input name="score" type="number" class="form-control" placeholder="Point" required="">
											<span class="material-input"></span></div>
										</div>
								</div>
								<div class="row">
									<label class="col-sm-2 label-on-left">Flag</label>
									<div class="col-sm-10">
										<div class="form-group label-floating is-empty">
											<label class="control-label"></label>
											<input name="flag" type="text" class="form-control" placeholder="format flag (sensitive value)" required="">
											<span class="material-input"></span></div>
										</div>
								<div class="row">
									<label class="col-sm-2 label-on-left">Level</label>
									<div class="col-sm-10">
										<div class="form-group label-floating is-empty">
											<label class="control-label"></label>
											<input name="level" type="text" class="form-control" placeholder="Easy/Normal/Hard" required="">
											<span class="material-input"></span></div>
										</div>

									<button class="btn btn-success">Submit<div class="ripple-container"></div></button>
								</div>
								</form>
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