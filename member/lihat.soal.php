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
if (!isset($_SESSION['nay'])) {
 $_SESSION['nay'] = md5('nepska'.time().'nayeon'); 

}

if(isset($_SESSION['username']) == ""){

	header("Location: login.php");
	unset($_SESSION['nay']);
	exit();
	

}



$idNya = $Database->search_user_by_id($_SESSION['username'] );

if (empty($idNya)) {

	die('Belum login kamu ini, so ie banget jADI hacker');

}



$q = mysql_query("SELECT * FROM submit WHERE id = '".((int) mysql_real_escape_string($_GET['id']))."'");

if ($q) {

	if (mysql_num_rows($q) != 1) {

		die('nyari apa sih dek');



	}

} else {

	die('nyari apa sih dek!');





}

$data = mysql_fetch_array($q);


//count solved
	$saol = mysql_query("SELECT * FROM last_solved where soal_id = '".$data['id']."'");
	$jum = mysql_num_rows($saol);

// solver

	// $exec = mysql_fetch_array($solver);

	$muhammadgholyquery = mysql_query("SELECT * FROM last_solved WHERE peserta_id = '".mysql_real_escape_string($idNya)."' AND soal_id = '".$data['id']."'");
if (isset($_POST['flag'])) {
	if($_POST['nayeon'] != $_SESSION['nay'])
	{
		die('Gak usah sok heker!');
	}

	if ($muhammadgholyquery) {
		if (mysql_num_rows($muhammadgholyquery) == 0) {

			$q = mysql_query("SELECT * FROM submit WHERE BINARY flag = '".mysql_real_escape_string($_POST['flag'])."' AND id = '".mysql_real_escape_string($data['id'])."'");

			if ($q) {

				if (mysql_num_rows($q) != 1) {

					$notif = array(

						'msg' => 'Flag Masih Salah Ya. Semangat!',

						'css' => 'danger',

						'cdo' => true

					);



				} else {

					$eueData = mysql_fetch_array($q);

					$srcscore 	= $Database->search_peserta_by_ids($idNya);



					// Anuin

					$scores 	= ($srcscore['score']+$eueData['score']);

					$sql = mysql_query("INSERT INTO `last_solved`(`peserta_id`, `soal_id`, `nama_soal` , `time`) VALUES 

						('$idNya','".$data['id']."','".$data['nama_soal']."','".time()."')");



					$updt = mysql_query("UPDATE `peserta` SET `score`='$scores',`time`='".time()."' WHERE `peserta`.`id` = '$idNya'");

					if($updt){

						$notif = array(

							'msg' => 'Selamat anda mendapatkan <b>Flag</b> dengan point '.$eueData['score'].' !',

							'css' => 'success',

							'cdo' => true

							); 



					}else{

						$notif = array(

							'msg' => 'kesalahan saat memperbarui data!',

							'css' => 'danger',

							'cdo' => true

						);

					}





				}

			} else {

				$notif = array(

					'msg' => 'Database error!',

					'css' => 'danger',

					'cdo' => true

				);





			}
		} else {
			$notif = array(

				'msg' => 'Sudah solved ya dek ku <3',

				'css' => 'danger',

				'cdo' => true

			);
		}
	}

}



?>

<!DOCTYPE html>

<html>

<head>

<?= $Modules->header(htmlspecialchars($data['nama_soal']));?>

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

            if(isset($notif)){

            	echo '<div class="alert alert-'.$notif['css'].'">

                       <span>'.$notif['msg'].'</span>

                </div>';

            header( "refresh:5; /member/view" );

            }?>

					





					<div class="row">

						<div class="col-md-12">

							<div class="card">

                                <div class="card-header">

                                    <h4 class="card-title"><?=htmlspecialchars($data['nama_soal'])?> - <small class="category"><?=htmlspecialchars($data['kategori'])?> (<?=htmlspecialchars($data['score'])?> Points)</small> - <small>Solved By <?= $jum ?> Player</small>

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
				<div class="card">

                    <form method="post" action="" class="form-horizontal">

                        <div class="card-header card-header-text" data-background-color="rose">

                            <h4 class="card-title">Submit Flag</h4>
                         

                        </div>

                        <div class="card-content">

                            <div class="row">

                                <label class="col-sm-2 label-on-left">Format Flag</label>

                                <div class="col-sm-10">

                                    <div class="form-group label-floating is-empty">

                                        <label class="control-label"></label>

                                        <input type="text" class="form-control" name="flag" autocomplete="OFF" <?php if (mysql_num_rows($muhammadgholyquery) > 0) { echo "disabled value='".$data['flag']."' "; } ?>> 
                                        <input type="hidden" name="nayeon" value="<?= $_SESSION['nay']; ?>">

                                        <span class="help-block">Tolong untuk di perhatikan data flag yang akan di submit.</span>

                                    <span class="material-input"></span><span class="material-input"></span></div>

                                </div>

                            </div>

                            <div class="row">

                               <div class="form-footer text-right">

                                <button type="submit" class="btn btn-rose btn-fill" <?php if (mysql_num_rows($muhammadgholyquery) > 0) { echo "disabled"; }?>>Submit Flag<div class="ripple-container"></div></button>
                                <button type="button" onclick="$('#solverCTF').modal('show');" class="btn btn-info">Solver</button>

                            </div>

                            </div>

                        </div>

                    </form>

                </div>


			</div>

		</div>

<?= $Modules->footer();?>
<div class="modal fade" id="solverCTF" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?= $jum ?> Solver</h5>
      </div>
      <div class="modal-body">
      	<?php
      		
      		$solver = mysql_query("SELECT peserta.`username`, peserta.`time` from peserta, last_solved WHERE peserta.id = last_solved.peserta_id AND soal_id = '".$data['id']."' ORDER BY time asc");
      		while ($exec = mysql_fetch_array($solver)) {
  
      		
   			echo  $exec['username'].'<br>';
      		
      	
      		}

      	?>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</div>
</body>

</html>