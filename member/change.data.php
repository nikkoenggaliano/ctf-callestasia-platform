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
$array = array("2SKdq0-X0yQ","J_CFBjAyPWE","rRzxEiBLQCA","V2hlQkVJZhE","wQ_POfToaVY");
$num = array_rand($array);


	if(isset($_POST['submit']))
	{
		$status = "";
		$exec = $Database->user_change($_POST['nick'],$_POST['email'],$idsper);
		if($exec){
		echo "<script type='text/javascript'>window.top.location='http://ctf.callestasia.org/member/index.php?change=_succes';</script>";
		exit;
		}else{
			$status = "Something Wrong Here!";
		}
	}
	?>





<!DOCTYPE html>
<html>
<head>
	<title>Change Your Information Here!</title>
</head>
<body>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<div class="container">
    <div class="row">
		<form class="form-horizontal" method="post">
<fieldset>

<!-- Form Name -->
<legend><center>User Callestasia Changer!</center></legend>
<center><h2><?= $status; ?></h2>
<div class="form-group">
	<label class="col-md-4 control-label" for="requestid">Here Some Fun Video</label>
	<div class="col-md-4">
	<?php	
	echo 
		 '<iframe width="420" height="315"
			src="https://www.youtube.com/embed/'.$array[$num].'"'.'>
		</iframe>'
		?> 
	</div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="requestid">Your Username</label>  
  <div class="col-md-4">
  <input id="requestid" name="username" placeholder="Request Id" class="form-control input-md" required="" type="text" value="<?= $infoUser['username']?>" disabled>
    
  </div>
</div>
<div class="form-group">
  <label class="col-md-4 control-label" for="requestid">Your Team</label>  
  <div class="col-md-4">
  <input id="requestid" name="nick" placeholder="Request Id" class="form-control input-md" required="" type="text" value="<?= $infoUser['nick']?>" >
    
  </div>
</div>
<!-- Select Basic -->

<!-- Textarea -->

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="date">Your Email</label>  
  <div class="col-md-4">
  <input id="requestid" name="email" placeholder="Request Id" class="form-control input-md" required="" type="text" value="<?= $infoUser['email']?>" >
    
  </div>
</div>
<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="submit"></label><center>
  <div class="col-md-4">
    <input type="submit" name="submit" value="Let's Go!" class="btn btn-default">
  </div></center>
</div>

</fieldset>
</form>

	</div>
</div>

</body>
</html>