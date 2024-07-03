<?php
$db = 'ams';
$dbhost	= '';
$dbuser = '';
$dbpasswd = '';
$conn = mysql_connect($dbhost,$dbuser,$dbpasswd);
$connDB = mysql_select_db($db);


$sql = "SELECT CustID, min(DateAdded) as Date, FirmName from AMSPROFILE Where PfxMaint = 'Y' Group By CustID Having min(DateAdded) = CURDATE() Order By Date,CustID";
$result = mysql_query($sql);



for($i=0;$i<mysql_num_rows($result);$i++)
{
	$newTax[$i]=mysql_fetch_array($result);
}

for($i=0;$i<count($newTax);$i++)
{
	echo $newTax[$i][0] . "," . $newTax[$i][1] . "," . $newTax[$i][2] . "<br>";
}


mysql_select_db('newcustomer');

for($i=0;$i<count($newTax);$i++)
{
	$custid=$newTax[$i][0];
	$dateAdded=$newTax[$i][1];
	$firmName=$newTax[$i][2];
	
	
	$sql = "INSERT INTO `newcustomer`.`tax` (`id`,`DateAdded`,`CustID`,`FirmName`,`Called`,`DateCalled`,`WhoCalled`)
			VALUES (
			NULL , '$dateAdded', '$custid', '$firmName', 'F', '', ''
			);";
	mysql_query($sql);
}