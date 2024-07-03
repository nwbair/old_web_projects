<?php 
include_once 'common/header.php'; 
include_once 'inc/class.files.inc.php';

$dir = "education";
$fileListing = new files();
$myfiles = $fileListing->getDirectoryList($dir);

echo '<ul id="education filelist">';
foreach($myfiles as $file):
?>
	<li><a href="<?php echo $dir . '/' . $file; ?>"><?php echo $file; ?></a></li>

<?php
endforeach;
echo "</ul";

include_once 'common/footer.php'; 

?>