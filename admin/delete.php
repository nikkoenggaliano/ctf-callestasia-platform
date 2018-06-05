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
	header("Location: /admin/login.php");
}
if($_SESSION['iamadmin']){
	switch ($_GET['type']) {
		case 'flag':
			$status = $Database->hapus_flag($_GET['id']);
			header("Location: /admin/manage-flag");
		break;
		case 'user':
			$status = $Database->hapus_user($_GET['id']);
			header("Location: /admin/manage-member");
		break;
		case 'info':
			$status = $Database->hapus_info($_GET['id']);
			header("Location: /admin/manage-info");
		break;
		case 'tutor':
			$status = $Database->hapus_tutor($_GET['id']);
			header("Location: /admin/manage-tutor");
		break;
		default:
			# code...
		break;
	}

}