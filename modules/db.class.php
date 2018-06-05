<?php
/**
 * @Author: Eka Syahwan
 * @Date:   2017-04-18 21:21:18
 * @Modified by: Nikko Enggaliano & Muhammad Gholy
 * @Last Modified time: 2018-06-25
 */
session_start();
date_default_timezone_set('Asia/Jakarta');
class Database
{
		var $host 	= "localhost";
		var $uname 	= "root";
		var $pass 	= "";
		var $db 	= "ctf";

// 		var $host = "localhost";
// 		var $uname = "root";
// 		var $pass = "";
// 		var $db = "ctf";

	public function __construct(){
			$koneksi = mysql_connect($this->host, $this->uname, $this->pass);
			mysql_select_db($this->db);
			if($koneksi){
				//echo "Koneksi database mysql dan php berhasil.";
			}else{
				//echo "Koneksi database mysql dan php GAGAL !";
			}
	}

public function filter($data) {
    	$data = htmlspecialchars(trim(htmlentities(strip_tags($data))));
    	if (get_magic_quotes_gpc())
        	$data = stripslashes($data);
    		$data = mysql_real_escape_string($data);
    	return $data;
	}
	public function ctfDate(){
		return  date("Y-m-d h:i:s");
	}
	########### SEARCH ####################
	public function search_peserta_by_id($id){
		$search = mysql_query("SELECT * FROM `peserta` WHERE `id` = '$id'");
		$search = mysql_fetch_array($search);
		return $search['username'];
	}
	public function search_peserta_by_ids($id){
		$search = mysql_query("SELECT * FROM `peserta` WHERE `id` = '$id'");
		$search = mysql_fetch_array($search);
		return $search;
	}
	public function search_soal_by_id($id){
		$search = mysql_query("SELECT * FROM `submit` WHERE `id` = '$id'");
		$search = mysql_fetch_array($search);
		return $search;
	}
	public function search_tutor_by_id($id){
		$search = mysql_query("SELECT * FROM `tutor` WHERE `id` = '$id'");
		$search = mysql_fetch_array($search);
		return $search;
	}
	public function search_soal_by_idinfo($id){
		$search = mysql_query("SELECT * FROM `posted` WHERE `id` = '$id'");
		$search = mysql_fetch_array($search);
		return $search;
	}
	public function search_posted_by_id($id){
		$search = mysql_query("SELECT * FROM `kategori` WHERE `id` = '$id'");
		$search = mysql_fetch_array($search);
		return $search['nama_kategori'];
	}
	public function count_player(){
		 $count = mysql_query("SELECT * FROM `peserta`");
		 $count = mysql_num_rows($count);
		 return $count;
	}
	public function count_flag(){
		 $count = mysql_query("SELECT * FROM `submit`");
		 $count = mysql_num_rows($count);
		 return $count;
	}

	public function count_value_score() {
		$count = mysql_query("SELECT SUM(score) as total FROM submit");
		$count = mysql_fetch_array($count);
		return $count['total'];
	}
	public function count_lastsolved(){
		 $count = mysql_query("SELECT * FROM `last_solved` limit 20");
		 $count = mysql_num_rows($count);
		 return $count;
	}
	########### show data ####################
	public function list_peserta(){
		$action		=  mysql_query("SELECT * FROM `peserta`");
		while ($row = mysql_fetch_array($action)) {
			$array[] = array('id' => $row['id'],'username' => $row['username']);
		}
		return $array;
	}
	public function list_kategori(){
		$action		=  mysql_query("SELECT * FROM `kategori`");
		while ($row = mysql_fetch_array($action)) {
			$array[] = array('id' => $row['id'],'kategori' => $row['nama_kategori']);
		}
		return $array;
	}
	public function tampilkan_flag_list(){
		$action = mysql_query("SELECT * FROM `submit`");
		while ($row = mysql_fetch_array($action)) {
			$flag[] = array(
				'id' 		=> $row['id'],
				'nama_soal' => $row['nama_soal'],
				'deskripsi'	=> htmlspecialchars($row['deskripsi']),
				'kategori'  => $row['kategori'],
				'score' 	=> $row['score'],
				'flag'		=> $row['flag'],
				'level'		=> $row['level'],
			);
		}
		return $flag;
	}
	public function tampilkan_tutor_list(){
		$action = mysql_query("SELECT * FROM `tutor`");
		while ($row = mysql_fetch_array($action)) {
			$flag[] = array(
				'id' 		=> $row['id'],
				'nama_tutor' => $row['nama_tutor'],
				'deskripsi'	=> htmlspecialchars($row['deskripsi']),
				'tipe'  => $row['tipe'],
				'author' 	=> $row['author'],
			);
		}
		return $flag;
	}
	public function tampilkan_member_list($asc){
		$action = mysql_query("SELECT * FROM `peserta` ORDER BY `peserta`.`score` $asc ");
		while ($row = mysql_fetch_array($action)) {
			$member[] = array(
				'id' 			=> $row['id'],
				'username'  	=> $row['username'],
				'nick'   		=> $row['nick'],
				'score' 		=> $row['score'],
				'status' 		=> $row['status'],
			);
		}
		return $member;
	}
	public function tampilkan_info_list(){
		$action = mysql_query("SELECT * FROM `posted`");
		while ($row = mysql_fetch_array($action)) {
			$posted[] = array(
				'id' 			=> $row['id'],
				'isi' 			=> $row['isi'],
				'kategori'		=> $this->search_posted_by_id($row['kategori_id']),
			);
		}
		return $posted;
	}
	########### DELETE ####################
	public function hapus_flag($id){
		$action = mysql_query("DELETE FROM `submit` WHERE `submit`.`id` = '$id'");
		if($action){
			return true;
		}else{
			return false;
		}
	}
	public function hapus_user($id){
		$action = mysql_query("DELETE FROM `peserta` WHERE `peserta`.`id` = '$id'");
		if($action){
			return true;
		}else{
			return false;
		}
	}
	public function hapus_info($id){
		$action = mysql_query("DELETE FROM `posted` WHERE `posted`.`id` = '$id'");
		if($action){
			return true;
		}else{
			return false;
		}
	}
	public function hapus_tutor($id){
		$action = mysql_query("DELETE FROM `tutor` WHERE `tutor`.`id` = '$id'");
		if($action){
			return true;
		}else{
			return false;
		}
	}
	########### UPDATE / ADD ####################
	public function statusMember($key){
		switch ($key) {
			case '1':
				$action = mysql_query("UPDATE `peserta` SET `status`=1");
			break;
			case '2':
				$action = mysql_query("UPDATE `peserta` SET `status`=2");
			break;
			
			default:
				# code...
			break;
		}
	}
	public function tambahkan_flag($nama_soal,$desc,$kategori,$score,$flag,$level){
			$action = mysql_query("INSERT INTO `submit`(`id`, `nama_soal`, `deskripsi`, `kategori`, `score`, `flag`, `level`) VALUES (0,'$nama_soal','$desc','$kategori','$score','$flag','$level')");
			if($action){
				return "sukses";
			}else{
				return "Kesalahan di database";
			}
		}
		public function tambahkan_tutor($nama_tutor,$desc,$tipe,$author){
			$action = mysql_query("INSERT INTO `tutor`(`id`, `nama_tutor`, `deskripsi`, `tipe`, `author`) VALUES (0,'$nama_tutor','$desc','$tipe','$author')");
			if($action){
				return "sukses";
			}else{
				return "Kesalahan di database";
			}
		}
	
	public function update_flag($nama_soal,$desc,$kategori,$score,$flag,$level,$id){
		$sql  = 'UPDATE
		 `submit` SET
		  `nama_soal` = \''.$nama_soal.'\',
		   `deskripsi` = \''.$desc.'\', 
		   `kategori` = \''.$kategori.'\', 
		   `score` = \''.$score.'\',
		    `flag` = \''.$flag.'\',
		    `level` = \''.$level.'\'
		     WHERE 
		     `id` = \''.$id.'\'';
		$sql  = mysql_query($sql); 
		if($sql){
			return true;
		}else{
			die(mysql_error());
			return false;
		}
	}
	public function update_tutor($nama_tutor,$desc,$tipe,$author,$id){
		$sql  = 'UPDATE
		 `tutor` SET
		  `nama_tutor` = \''.$nama_tutor.'\',
		   `deskripsi` = \''.$desc.'\', 
		   `tipe` = \''.$tipe.'\', 
		   `author` = \''.$author.'\'
		     WHERE 
		     `id` = \''.$id.'\'';
		$sql  = mysql_query($sql); 
		if($sql){
			return true;
		}else{
			die(mysql_error());
			return false;
		}
	}
	public function update_info($nama_info,$isi,$id){
		$sql  = 'UPDATE
		 `submit` SET
		  `nama_soal` = \''.$nama_info.'\',
		   `deskripsi` = \''.$isi.'\' 
		   	WHERE 
		     `id` = \''.$id.'\'';
		$sql  = mysql_query($sql); 
		if($sql){
			return true;
		}else{
			die(mysql_error());
			return false;
		}
	}

	public function user_change($nick,$email,$id){
		$nick = $this->filter($nick);
		$email = $this->filter($email);
		$id = $this->filter($id);
		$sql  = 'UPDATE
		 `peserta` SET
		   `email` = \''.$email.'\',
		    `nick` = \''.$nick.'\'
		   	WHERE 
		     `id` = \''.$id.'\'';
		$sql  = mysql_query($sql); 
		if($sql){
			return true;
		}else{
			die(mysql_error());
			return false;
		}
	}

	public function password_change($password,$id){
		$password = md5($password);
		$id = $this->filter($id);
		$sql  = 'UPDATE
		 `peserta` SET
		   `password` = \''.$password.'\'
		   	WHERE 
		     `id` = \''.$id.'\'';
		$sql  = mysql_query($sql); 
		if($sql){
			return true;
		}else{
			die(mysql_error());
			return false;
		}
	}

	public function tambahkan_user($username,$password,$nick,$status,$score){
		$action = mysql_query("INSERT INTO `peserta`(`id`, `username`, `password`, `nick`, `score`, `time`, `status`) VALUES (0,'$username','$password','$nick','$score','','$status')");
		if($action){
			return true;
		}else{
			return false;
		}
	}
	public function update_user($id,$username,$password = false,$nick,$status,$score){
		if($password == false){
			$sql  = 'UPDATE `peserta` SET `username` = \''.$username.'\', `nick` = \''.$nick.'\', `score` = \''.$score.'\', `status` = \''.$status.'\' WHERE `peserta`.`id` = '.$id.'';
			$sql  = mysql_query($sql);
			if($sql){
				return true;
			}else{
				return false;
			}
		}else{
			$sql  = 'UPDATE `peserta` SET `username` = \''.$username.'\', `password` = \''.md5($password).'\', `universitas` = \''.$universitas.'\', `score` = \''.$score.'\', `status` = \''.$status.'\' WHERE `peserta`.`id` = '.$id.'';
			$sql  = mysql_query($sql);
			if($sql){
				return true;
			}else{
				return false;
			}
		}
	}
	public function tambahkan_info($isi,$kategori){
		$sql = mysql_query("INSERT INTO `posted`(`id`, `isi`, `kategori_id`) VALUES (0,'$isi','$kategori')");
		if($sql){
			return true;
		}else{
			return false;
		}
	}
	################## TABLE ###################
	public function info_lastsolved($count){
		$mysql = mysql_query("SELECT * FROM `last_solved` ORDER BY `last_solved`.`time` DESC LIMIT $count");
		while ($data = mysql_fetch_array($mysql)) {
			$peserta_id = $data['peserta_id'];
			$flag_id    = $data['flag_id'];
			$nama_soal	= $data['nama_soal'];
			$datas[] 	= array(
				'tim'	=> $this->search_peserta_by_id($data['peserta_id']),
				'nama_soal' => $data['nama_soal'],
				'time' 	=> $data['time'], 
				 
			);
		}
		return $datas;
	}
	public function info_topplayer(){
		$mysql = mysql_query("SELECT * FROM `peserta` ORDER BY `peserta`.`score` DESC, `peserta`.`nick` ASC LIMIT 10");
		while ($data = mysql_fetch_array($mysql)) {
			$datas[] = array(
				'tim'    => $data['username'], 
				'score'  => $data['score'], 
				'nick'   => $data['nick'], 
			);
		}
		return $datas;
	}
		################## View Soal  ####################
	public function view(){
		$mysql = mysql_query("SELECT * FROM `submit` ORDER BY `submit`.`nama_soal` ASC LIMIT 100");
		while ($data = mysql_fetch_array($mysql)) {
			$datas[] = array(
				'id' => $data['id'],
				'kategori' => $data['kategori'],
				'nama_soal'    => $data['nama_soal'], 
				'level'	 => $data['level'],
				'score'  => $data['score'],

			);
		}
		return $datas;
	}
	################## View Tutorial #################
	public function vtutor(){
		$mysql = mysql_query("SELECT * FROM `tutor` ORDER BY `tutor`.`nama_tutor` ASC LIMIT 100");
		while ($data = mysql_fetch_array($mysql)) {
			$datas[] = array(
				'id' => $data['id'],
				'nama_tutor' => $data['nama_tutor'], 
				'tipe'	 => $data['tipe'],
				'author'  => $data['author'],

			);
		}
		return $datas;
	}
	################## FLAG  ####################
	public function last_solved_by_id($id){
		$mysql = mysql_query("SELECT * FROM `last_solved` WHERE `peserta_id` = '$id'");
		$mysql = mysql_num_rows($mysql);
		return $mysql;
	}
	public function search_user_by_id($id){
		$sql = mysql_query("SELECT * FROM `peserta` WHERE `username` = '$id'");
		$sql = mysql_fetch_array($sql);
		return $sql[id];
	}
	public function checklastsalvoed($pid,$fid){
		$sql 	= mysql_query("SELECT * FROM `last_solved` WHERE `peserta_id` = '$pid' AND `flag_id` = '$fid'");
		$jumlah = mysql_num_rows($sql);
		if ( $jumlah == 0 ) {
			return false;
		}else{
			return true;
		}
	}
	public function sflag($flag,$id){
		$this->kickPlayer();
		$flag = $this->filter($flag);
		$sql = mysql_query("SELECT * FROM `flag` WHERE `flag` = '$flag' AND `peserta_id` != '$id'");
		$arr = mysql_fetch_array($sql);
		if($arr['nama_soal']){
			$flag = $this->checklastsalvoed($id,$arr[id]);
			if($flag){
				$notif = array(
					'msg' => 'Tidak dapat memasukan flag yang sama!',
					'css' => 'info',
					'cdo' => false, 
				);
			}else{
				$flid 		= $arr['id'];
				$time 		= $this->ctfDate();
				$srcscore 	= $this->search_peserta_by_ids($id);
				$scores 	= ($srcscore['score']+$arr['score']);
				$sql = mysql_query("INSERT INTO `last_solved`(`id`, `peserta_id`, `flag_id`, `time`) VALUES (0,'$id','$flid','$time')");
				if($sql){
					$updt = mysql_query("UPDATE `peserta` SET `score`='$scores',`time`='$time' WHERE `peserta`.`id` = '$id'");
					if($updt){
						$notif = array(
							'msg' => 'Selamat anda mendapatkan flag <b>Admin</b> dengan point '.$arr['score'].' !',
							'css' => 'success',
							'cdo' => true, 
						);
					}else{
						$notif = array(
							'msg' => 'kesalahan saat memperbarui data!',
							'css' => 'danger',
							'cdo' => true, 
						);
					}
				}else{
					$notif = array(
						'msg' => 'kesalahan saat memperbarui data!',
						'css' => 'danger',
						'cdo' => true, 
					);
				}
			}
		}else{
				$sql = mysql_query("SELECT * FROM `flag` WHERE `flag` = '$flag' AND `peserta_id` = '$id'");
				$arr = mysql_fetch_array($sql);
				if($arr['nama_soal']){
				$flag = $this->checklastsalvoed($id,$arr[id]);
				if($flag){
					$notif = array(
						'msg' => 'Tidak dapat memasukan flag yang sama!',
						'css' => 'info',
						'cdo' => false, 
					);
				}else{
					$flid 		= $arr['id'];
					$time 		= $this->ctfDate();
					$srcscore 	= $this->search_peserta_by_ids($id);
					$scores 	= ($srcscore['score']+$arr['score_perserta']);
					$sql = mysql_query("INSERT INTO `last_solved`(`id`, `peserta_id`, `flag_id`, `time`) VALUES (0,'$id','$flid','$time')");
					if($sql){
						$updt = mysql_query("UPDATE `peserta` SET `score`='$scores',`time`='$time' WHERE `peserta`.`id` = '$id'");
						if($updt){
							$notif = array(
								'msg' => 'Selamat anda mendapatkan flag <b>Admin</b> dengan point '.$arr['score_perserta'].' !',
								'css' => 'success',
								'cdo' => true, 
							);
						}else{
							$notif = array(
								'msg' => 'kesalahan saat memperbarui data!',
								'css' => 'danger',
								'cdo' => true, 
							);
						}
					}else{
						$notif = array(
							'msg' => 'kesalahan saat memperbarui data!',
							'css' => 'danger',
							'cdo' => true, 
						);
					}
				}
			}else{
				$notif = array(
					'msg' => 'Flag tidak di temukan atau format flag salah!',
					'css' => 'danger',
					'cdo' => false, 
				);
			}

			/*$notif = array(
				'msg' => 'flag tidak di temukan atau format flag salah!',
				'css' => 'danger',
				'cdo' => false, 
			);*/

		}
		return $notif;
	}
	########### LOGIN ##########################
	public function adminLogin($username,$password){
		$username	= $this->filter($username);
		$password   = $this->filter($password);

		$cekuser 	= mysql_query("SELECT * FROM `admin` WHERE username = '$username'");
		$jumlah 	= mysql_num_rows($cekuser);
		$hasil 		= mysql_fetch_array($cekuser);
		if ( $jumlah == 0 ) {
				return 'gagal';
		}else{
			if ( md5($password) <> $hasil['password'] ) {
				return 'gagal';
			}else{
				$_SESSION['username'] = $username;
				$_SESSION['iamadmin'] = $username;
			}
		}
	}
public function cekcek($username,$email,$nick)
{
	$username 	= $this->filter($username);
	$email		= $this->filter($email);
	$nick		= $this->filter($nick);

	$cek1 		= mysql_query("SELECT * FROM `peserta` WHERE username = '$username'");
	$j1			= mysql_num_rows($cek1);
	$h1 		= mysql_fetch_array($cek1);
	$cek2		= mysql_query("SELECT * FROM `peserta` WHERE username = '$email'");			
	$j2			= mysql_num_rows($cek2);
	$h2 		= mysql_fetch_array($cek2);
	$cek3		= mysql_query("SELECT * FROM `peserta` WHERE username = '$nick'");			
	$j3			= mysql_num_rows($cek3);
	$h3 		= mysql_fetch_array($cek3);

	if($j1 == 0 && $j2 != 0 && $j3 != 0)
	{
		return 'failgan';
	}

}

	public function memberLogin($username,$password){
		$username	= $this->filter($username);
		$password   = $this->filter($password);
		
		$cekuser 	= mysql_query("SELECT * FROM `peserta` WHERE username = '$username'");
		$jumlah 	= mysql_num_rows($cekuser);
		$hasil 		= mysql_fetch_array($cekuser);
		if ( $jumlah == 0 ) {
				return 'gagal';
		}else{
			if ( md5($password) <> $hasil['password'] ) {
				return 'gagal';
			}else{
				$_SESSION['username']  = $username;
				$_SESSION['iammember'] = $username;
			}
		}
	}
	public function register($username,$password,$email,$nick){
		$username	= $this->filter($username);
		$email		= $this->filter($email);
		$nick		= $this->filter($nick);
		$password   = $this->filter($password);
		
		return mysql_query("INSERT INTO peserta VALUES (
			'".rand(100,999).rand(100,999)."', 
			'".$username."', 
			'".$email."',
			'".$nick."',
			'".md5($password)."', 
			'', 
			'0', 
			'".time()."', 
			'1')");
		
	}
	public function kickPlayer(){
		for ($i=0; $i <3; $i++) { 
			if($_SESSION['iammember']){
				$id 	= $this->search_user_by_id($_SESSION['username']);
				$status = $this->search_peserta_by_ids($id); 
				if($status['status'] != 1){
					session_destroy();
					header("Location: login.php");
					exit;
				}
			}
		}
	}
}

// public function generate_token(){
// 		$_SESSION['token']  = "__csrfToken:".md5(date("dmY h:i:s").rand(10000,90000));
// 		return $_SESSION['token'];
// 	}
// 	public function show_tokenHTML(){
// 		echo '<input type="hidden" name="token" value="'.$this->generate_token().'"></input>';
// 	}
// 	public function validateToken($token){
// 		if($token != $_SESSION['token']){
// 			return false;
// 		}else{
// 			return true;
// 		}
// 	}


$Database = new Database();
$Database->kickPlayer();
