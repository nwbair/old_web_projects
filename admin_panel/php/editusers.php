<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit Users</title>


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
        	<li><a href="../createusers.html" class="active">MANAGE USERS</a></li>
        	<li><a href="../createpages.html">MANAGE PAGES</a></li>
        	<li><a href="#">OPTION</a></li>
        	<li class="logout"><a href="#">LOGOUT</a></li>
        </ul>

        
        <div id="containerHolder">
			<div id="container">
        		<div id="sidebar">
                	<ul class="sideNav">
                    	<li><a href="../createusers.html" >Create Users</a></li>
                    	<li><a href="editusers.php" class="active">Edit Users</a></li>
                    	<li><a href="deleteusers.php" >Delete Users</a></li>
						<li><a href="userlist.php" >User List</a></li>
						
                    </ul>
                    
                </div>    
               
                
                
                <h2><a href="#">Manage Users</a> &raquo; <a href="#" class="active">Edit Users</a></h2>
                <div id="main"><br>
                	<form name="search" method="post" action="" class="jNice">
					
<?php
$host="localhost"; 
$username="root"; 
$password=""; 
$db_name="almostlabs"; 
$tbl_name="users"; 


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
<td align="left"><strong>First Name</strong></td>
<td align="left"><strong>Last Name</strong></td>
<td align="left"><strong>Email</strong></td>
<td align="left">&nbsp;</td>
</tr>
<?php
while($rows=mysql_fetch_array($result)){
?>
<tr>
<td><? echo $rows['ID']; ?></td>
<td><? echo $rows['first']; ?></td>
<td><? echo $rows['last']; ?></td>
<td><? echo $rows['email']; ?></td>
<td><a href="delconfirm.ph?id=<? echo $rows['ID']; ?>"><img src="../style/img/edit.png" /></a></td>
</tr>
<?


}

 
mysql_close();

?> 
</table></td>
</tr><br>

				</form>
                </div>
                
                
                <div class="clear"></div>
            </div>
            
        </div>	
        
        
        <p id="footer">Copyright &copy 2011,AlmostLabs</p>
    </div>
    
</body>
</html>


