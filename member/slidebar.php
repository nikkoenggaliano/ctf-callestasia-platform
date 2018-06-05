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
?>
<div class="sidebar" data-active-color="rose" data-background-color="black">
<div class="logo"><a href="index.php" class="simple-text">Capture the Flag</a></div>
<div class="sidebar-wrapper">
	<!-- Side Navigator -->
	<div class="user">
		<div class="info">
			<a data-toggle="collapse" href="#collapseExample" class="collapsed"><?= "Hello ".$_SESSION['username'];?><b class="caret"></b></a>
			<div class="collapse" id="collapseExample">
				<ul class="nav">							
					<li><a href="/member/data">Edit Data</a></li>
					<li><a href="/member/password">Edit Password</a></li>
					<li><a href="/member/logout">Logout</a></li>
				</ul>
			</div>
		</div>
	</div>
    <!--End Side Navigator -->
    <!--Navigator -->
	<ul class="nav">
		<li class="">
			<a href="/member">
				<i class="material-icons">dashboard</i>
				<p>Home</p>
			</a>
		</li>
		<li class="">
			<a href="/member/view">
				<i class="material-icons">flag</i>
				<p>Soal</p>
			</a>
		</li>
		<li class="">
			<a href="/member/rules">
				<i class="material-icons">settings</i>
				<p>Rules</p>
			</a>
		</li>
		<li class="">
			<a href="/member/prize">
				<i class="material-icons">card_giftcard</i>
				<p>Prize</p>
			</a>
		</li>
		<li class="">
			<a href="/member/tutor">
			<i class="material-icons">question_answer</i>
			<p>Tutorial</p>
			</a>
			</li>
		<li class="">
			<a href="/member/contact">
				<i class="material-icons">email</i>
				<p>Contact</p>
			</a>
		</li>
	</ul>
	<!--End Navigator -->
</div>
</div>