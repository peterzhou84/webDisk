<?php
require_once '../lib/config.php';
require_once '_check.php';


use \Ss\File\FileManager;
use \Ss\File\DiskFileManager;
$fm=$isLan?new DiskFileManager($U->GetUid()):new FileManager($U->GetUid());

$file=$_POST['file'];
$ret=true;
foreach ($file as $i) {
	if(!$fm->delFile($i))
		$ret=false;
}
echo $ret;