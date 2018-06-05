<!DOCTYPE html>
<html>
<head>
	<title>Belajar Command Linux</title>
</head>
<body>
<form method="post" action="">
<input  type="text" name="cd">
<button type="submit">Let's go</button>
</form>

<?php
$ls = array('ls', 'll' , 'ls -la' , 'ls -l');
$cat1 = array('cat Flag1.txt' , 'cat flag1.txt' , 'Cat Flag1.txt');
$cat2 = array('cat Flag2.txt' , 'cat flag2.txt' , 'Cat Flag2.txt');
$cat3 = array('cat Flag3.txt' , 'cat flag3.txt' , 'Cat Flag3.txt');
$cat4 = array('cat Flag4.txt' , 'cat flag4.txt' , 'Cat Flag4.txt');
$cat5 = array('cat *' , 'Cat *' , 'CAT *');
$blocked = array('rm' , 'rm *' , 'rm -rf' , 'restart' , 'shutdown' , 'zip' , 'unzip' , 'curl' , 'gcc');
$post = $_POST['cd'];
if(in_array($post, $ls)) {
	echo "1. Flag1.txt"; 
	echo "2. Flag2.txt";
	echo "3. Flag3.txt";
	echo "4. Flag4.txt";
} elseif (in_array($post, $cat1)) {
	echo "Call";
} elseif (in_array($post, $cat2)) {
	echo "tasia{";
} elseif (in_array($post, $cat3)) {
	echo "L1nux_so_f"; 
} elseif (in_array($post, $cat4)) {
	echo "Un_h3h3}";
} elseif (in_array($post, $cat5)) {
	echo "Callestasia{L1nux_so_fUn_h3h3}";
} elseif (in_array($post, $blocked)) {
	echo '<script>alert("Gak Usah Sok Heker BOS!")</script>';
	die('Gak Usah Sok Heker BOS!');
} else {
	echo "Error Command Not Found Or Disable By Admin!";
}
?>

</body>
</html>