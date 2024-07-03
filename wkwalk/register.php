<div id="register">
	<h1>Create an account for WK aCCHross America</h1>
	<form name="register" action="process.php" method="POST">
		<p>
			<label for="Email">Email</label>
			<input type="text" name="email" class="input" />
		</p>
		<p>
			<label for="password">Password</label> 
			<input type="password" name="password" class="input" />
		</p>
		<p>
			<label for="password2">Verify Password</label> 
			<input type="password" name="password2" class="input" />
		</p>
		<p>
			<label for="firstname">First Name</label> 
			<input type="text"  name="firstname" class="input" />
		</p>
		<p>
			<label for="lastname">Last Name</label> 
			<input type="text"  name="lastname" class="input"/>
		</p>
		<p>		
			<label for="department">Department</label> 
			<input type="text"  name="department" class="input" />
		</p>
		<p>
			<label for="gender">Gender</label> 
			<input type="text"  name="gender" class="input" />
		</p>
		<p>
			<label for="ymca">YMCA Member?</label> 
			<input type="text"  name="ymca" class="input" />
		</p>
		<p>
			<label for="team">Team</label> 
			<select name="team" class="select">
			<?php 
			$sql = "select teamid, teamname from team"; 
			$result = mysql_query($sql);
			while($row = mysql_fetch_array($result)) {
				echo "<option value=\"".$row['teamid']."\">".$row['teamname']."\n ";
			}
			?>
			</select>
		</p>										  
		<p>
			<input type="hidden" name="registertime" value="<?php $time = time(); echo $time; ?>" />
			<input type="hidden" name="register" value="1">
			<input type="submit" value="Register!" class="button" />
		</p>
	</form> 
</div>