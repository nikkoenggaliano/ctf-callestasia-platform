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
		if(md5($_POST['p1']) != $infoUser['password'])
		{
			$status =  "Wrong Password";
		}elseif($_POST['pn'] != $_POST['pn2'])
		{
			$status = "Password yang diketikan tidak sama!";
		}elseif($_POST['p1'] == $_POST['pn'])
		{
			$status = "Password Baru tidak boleh sama dengan password sebelumnya!";
		}else{
			$exec = $Database->password_change($_POST['pn2'],$idsper);
			if($exec)
			{
				echo "<script type='text/javascript'>window.top.location='http://ctf.callestasia.org/member/index.php?change=_succes_';</script>";
				exit;
			}
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
<legend><center>Password Callestasia Changer!</center></legend>
<?php 
if($status != "")
{
	echo '<center><h2 style="color: blue;">'.$status.'</h2></center>';
}
?>
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
  <label class="col-md-4 control-label" for="requestid">Enter Old Password</label>  
  <div class="col-md-4">
  <input id="requestid" name="p1" placeholder="Old Password" class="form-control input-md" required="" type="text" autocomplete="off">
    
  </div>
</div>
<div class="form-group">
  <label class="col-md-4 control-label" for="requestid">Enter New Password</label>  
  <div class="col-md-4">
  <input id="requestid" name="pn" placeholder="New Password" class="form-control input-md" required="" type="text" autocomplete="off">
    
  </div>
</div>
<!-- Select Basic -->

<!-- Textarea -->

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="date">Enter New Password Again</label>  
  <div class="col-md-4">
  <input id="requestid" name="pn2" placeholder="Enter Again" class="form-control input-md" required="" type="text" autocomplete="off" >
    
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