<?php 
include_once 'common/header.php'; 
include_once 'inc/class.files.inc.php';

$dir = "achievements";
$fileListing = new files();
$myfiles = $fileListing->getDirectoryList($dir);

echo '<ul id="achievements filelist">';
foreach($myfiles as $file):
?>
	<li><a href="<?php echo $dir . '/' . $file; ?>"><?php echo $file; ?></a></li>

<?php
endforeach;
echo "</ul";

include_once 'common/footer.php'; 

?>