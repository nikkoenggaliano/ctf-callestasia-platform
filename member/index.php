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
	die('Jancok login dolo anjing'."\n");

}

$idsper 	= 	$Database->search_user_by_id($_SESSION['username']);

$infoUser  	=	$Database->search_peserta_by_ids($idsper);

$infoSolved = 	$Database->last_solved_by_id($idsper);

if(isset($_GET['change']))
{
	if($_GET['change'] == "_succes")
	{
		echo "<script type='text/javascript'>alert('Data Has Succesfull Change!');</script>";
	}elseif($_GET['change'] == "_succes_")
	{
		echo "<script type='text/javascript'>alert('Password Has Succesfull Change!');</script>";
	}
}

?>

<!DOCTYPE html>

<html>

<head>

<?= $Modules->header("Dashboard");?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0/Chart.bundle.js"></script>

 <style type="text/css">
            .container {
                width: 50%;
                margin: 15px auto;
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

			<div class="row">

				<div class="col-md-12">

					<div class="card">

						<div class="card-header">

							<h4 class="card-title">Informations</h4>

						</div>

						<div class="card-content">

							<div class="alert alert-info">
<marquee>
								<?php

									$action		=  mysql_query("SELECT * FROM `posted` WHERE `kategori_id` = 1");

									while ($datas = mysql_fetch_array($action) ) {

									echo $datas['isi'];

								}?>
</marquee>
							</div>

						</div>

					</div>

				</div>

			</div>

			<div class="row">

				<div class="col-lg-3 col-md-6 col-sm-6">

					<div class="card card-stats">

						<div class="card-header" data-background-color="orange">

							<i class="material-icons">weekend</i>

						</div>

						<div class="card-content">

							<p class="category">Your Score</p>

							<h3 class="card-title"><?= $infoUser['score']?></h3>

						</div>

						<div class="card-content">

							<p class="category">Max Score</p>

							<h3 class="card-title"><?= $Database->count_value_score()?></h3>

							<?php 

							$a1 = (int) $Database->count_value_score();
							$a2 = (int) $infoUser['score'];

							echo " Need ".'<b>'.($a1-$a2).'</b>'." To Max Score"; 

							?>

						</div>


					</div>

				</div>

				<div class="col-lg-3 col-md-6 col-sm-6">

					<div class="card card-stats">

						<div class="card-header" data-background-color="green">

							<i class="material-icons">assignment</i>

						</div>

						<div class="card-content">

							<p class="category">Total Mission</p>

							<h3 class="card-title"><?= $Database->count_flag();?></h3>

						</div>

						<div class="card-content">

							<p class="category">Solved</p>

							<h3 class="card-title"><?= $infoSolved;?></h3>


							<?php 

							$awal = (int) $Database->count_flag();
							$akhir = (int) $infoSolved;

							echo '<b>'.($awal-$akhir).'</b>'." Not Solved";
 
							?>

						</div>

					</div>

				</div>

				<div class="col-lg-6 col-md-12 col-sm-12">

					<div class="card card-stats">

						<div class="card-header" data-background-color="blue">

							<i class="material-icons">alarm</i>

						</div>

						<div class="card-content">

							<p class="category">Last Submit Flag</p>

							<h3 class="card-title"><?=date('Y-m-d H:i', $infoUser['time'])?></h3>

						</div>

						<div class="card-content">

							<p class="category">Your IP</p>

							<h3 class="card-title"><?= $_SERVER['REMOTE_ADDR']; ?></h3>
							

						</div>

					</div>

				</div>

			</div>

			<div class="row">

				<div class="col-md-12">

					<div class="card">

						<div class="card-header card-header-icon" data-background-color="green">

							<i class="material-icons">language</i>

						</div>

<?php
$koneksi     = mysqli_connect("localhost", "callesta_ctf", "oV!8,igcvciw", "callesta_ctf");
$bulan       = mysqli_query($koneksi, "SELECT `username` FROM `peserta` ORDER BY `peserta`.`score` DESC, `peserta`.`nick` ASC LIMIT 10 ");
$penghasilan = mysqli_query($koneksi, "SELECT `score` FROM `peserta` ORDER BY `peserta`.`score` DESC, `peserta`.`nick` ASC LIMIT 10 ");
?>
<div class="container">
            <a href="index.php"><h2>TOP 10 CTF Callestasia</h2></a>
            <canvas id="myChart" width="1200" height="1200"></canvas>
        </div>
        <script>
            var ctx = document.getElementById("myChart");
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [<?php while ($b = mysqli_fetch_array($bulan)) { echo '"' . $b['username'] . '",';}?>],
                    datasets: [{
                            label: 'Best Score: ',
                            data: [<?php while ($p = mysqli_fetch_array($penghasilan)) { echo '"' . $p['score'] . '",';}?>],
                            backgroundColor: [
                                'rgba(228, 87, 87)',
                                'rgba(75, 245, 235)',
                                'rgba(242, 222, 42)',
                                'rgba(9, 5, 223)',
                                'rgba(109, 40, 229)',
                                'rgba(248, 86, 16)',
                                'rgba(230, 85, 225)',
                                'rgba(180, 248, 98)',
                                'rgba(251, 23, 133)',
                                'rgba(17, 248, 1)',
                                'rgba(251, 23, 133)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderWidth: 1
                        }]
                },
                options: {
                    scales: {
                        yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                    }
                }
            });
        </script>


						<div class="card-content">


						</div>

					</div>

				</div>

			</div>

			<div class="row">

				<div class="col-md-12">

					<div class="card">

						<div class="card-header card-header-icon" data-background-color="rose">

							<i class="material-icons">people</i>

						</div>

						<h4 class="card-title">Latest Solved</h4>

						<div class="card-content">

							<div class="table-responsive">

								<table class="table">

									<thead>

										<tr>

											<th class="text-center">#</th>

											<th>Username</th>

											<th class="text-center">Nama Soal</th>

											<th class="text-right">Time Submit</th>

										</tr>

									</thead>

									<tbody>

									<?php

									foreach ($Database->info_lastsolved("20") as $key => $data) {

										echo '<tr>

											<td class="text-center">'.($key+1).'</td>

											<td>'.$data['tim'].'</td>

											<td class="text-center">'.$data['nama_soal'].'</td>

											<td class="text-right">'.date('Y-m-d H:i', $data['time']).'</td>

									

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