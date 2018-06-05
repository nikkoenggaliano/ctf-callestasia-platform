<!DOCTYPE html>
<html>
<head>
  <title>1 - 99</title>
</head>
<body>
<?php

error_reporting(0);

$a = $_GET['tebak'];

if(!isset($a)) {
  echo "Input angka coy. Contohnya ?tebak=(1 - 99) Selamat menebak";
}elseif(!is_numeric($a)) {
  echo "Hanya diperbolehkan input angka. Coba 1 - 99 ditebak";
}elseif($a == 0) {
  echo "Callesta{Th1nk_0ut_of_th3_B0x}";
}elseif($a >= 100) {
  echo "Terlalu Besar Angkanya 1 - 99 saja";
}else {
  echo "Hayoo Semangat Tebaknya! Masih Salah Tebakanya";
} ?>
</body>
</html>

