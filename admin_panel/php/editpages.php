<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit Pages</title>


<link href="../style/css/transdmin.css" rel="stylesheet" type="text/css" media="screen" />
<!--[if IE 6]><link rel="stylesheet" type="text/css" media="screen" href="style/css/ie6.css" /><![endif]-->
<!--[if IE 7]><link rel="stylesheet" type="text/css" media="screen" href="style/css/ie7.css" /><![endif]-->


<script type="text/javascript" src="../style/js/jquery.js"></script>
<script type="text/javascript" src="../style/js/jNice.js"></script>
</head>

<body>
	<div id="wrapper">
    	
    	<h1><a href="#"><span>AlmostLabs</span></a></h1>
        
       
        <ul id="mainNav">
        	<li><a href="../home.html">HOME</a></li> 
        	<li><a href="../createusers.html" >MANAGE USERS</a></li>
        	<li><a href="#" class="active">MANAGE PAGES</a></li>
        	<li><a href="#">OPTION</a></li>
        	<li class="logout"><a href="#">LOGOUT</a></li>
        </ul>

        
        <div id="containerHolder">
			<div id="container">
        		<div id="sidebar">
                	<ul class="sideNav">
                    	<li><a href="../createpages.html" >Create Pages</a></li>
                    	<li><a href="editpages.php" class="active" >Edit Pages</a></li>
                    	<li><a href="deletepages.php">Delete pages</a></li>
                    </ul>
                   
                </div>    
                
                
                
                <h2><a href="#">Manage pages</a> &raquo; <a href="#" class="active">Edit Pages</a></h2>
    <div id="main"><br>
                	<form name="search" method="post" action="" class="jNice">
					
<?php
$host="localhost";
$username="root"; 
$password="";
$db_name="almostlabs"; 
$tbl_name="pages";


mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");


$sql="SELECT * FROM $tbl_name";
$result=mysql_query($sql);

?>

<tr>
<td><table>
<tr>

</tr>
<tr>
<td align="left"><strong>ID</strong></td>
<td align="left"><strong>Title</strong></td>
<td align="left"><strong>Date</strong></td>
<td align="left">&nbsp;</td>
</tr>
<?php
while($rows=mysql_fetch_array($result)){
?>
<tr>
<td><? echo $rows['ID']; ?></td>
<td><? echo $rows['title']; ?></td>
<td><? echo $rows['created']; ?></td>
<td><a href="../pgconfirmup.html?id=<? echo $rows['ID']; ?>"><img src="../style/img/edit.png" /></a></td>
</tr>
<?


}

 
mysql_close();

?> 
</table></td>
</tr><br></div>			
                
                
         <div class="clear"></div>
            
            
        </div>	
        
        
    </div>
	<p id="footer">Copyright &copy 2011,AlmostLabs</p>
   
</body>
</html>


