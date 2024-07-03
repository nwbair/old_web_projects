<?php
require_once 'includes/functions.php';

// Clean post variables before using in SQL query.
$email = cleanInput($_SESSION['email']);
	
// Define the SQL query to get the user ID. Use cleaned variables.
$sql = 'Select * from users where email = "' . $email . '"' ;

$result = $db->query($sql);
$row = $result->fetch();

?>
<div id="profile">
<form name="profile" action="process.php" method="POST">
<table border="0" cellspacing="0" cellpadding="3">
<tr><td>Email:</td><td><input type="text" name="email" maxlength="50" value="<?php echo $row['email']; ?>"></td><td></td></tr>
<tr><td>First Name:</td><td><input type="text" name="firstname" maxlength="75" value="<?php echo $row['firstname']; ?>"></td></tr>
<tr><td>Last Name:</td><td><input type="text" name="lastname" maxlength="75" value="<?php echo $row['lastname']; ?>"></td></tr>
<tr><td>Street Address:</td><td><input type="text" name="street" maxlength="75" value="<?php echo $row['street']; ?>"></td></tr>
<tr><td>City:</td><td><input type="text" name="city" maxlength="28" value="<?php echo $row['city']; ?>"></td></tr>
<tr><td>State:</td><td><input type="text" name="state" maxlength="2" value="<?php echo $row['state']; ?>"></td></tr>
<tr><td>Zip Code:</td><td><input type="text" name="zipcode" maxlength="5" value="<?php echo $row['zipcode']; ?>"></td></tr>
<tr><td>Resident County:</td><td><input type="text" name="rescounty" maxlength="20" value="<?php echo $row['rescounty']; ?>"></td></tr>
<tr><td>Home Phone #:</td><td><input type="text" name="homephone" maxlength="15" value="<?php echo $row['homephone']; ?>"></td></tr>
<tr><td>Cell Phone #:</td><td><input type="text" name="cellphone" maxlength="15" value="<?php echo $row['cellphone']; ?>"></td></tr>
<tr><td>Cell Provider (e.g. Sprint, AT&T, etc...):</td><td><input type="text" name="cellprovider" maxlength="20" value="<?php echo $row['cellprovider']; ?>"></td></tr>
<tr><td>Work Phone #:</td><td><input type="text" name="workphone" maxlength="15" value="<?php echo $row['workphone']; ?>"></td></tr>
<tr><td>Internet Access:</td><td><select name="internet">
															<option value="broadband" <?php isSelect($row['internet'], 'broadband'); ?>>I have Broadband</option>
															<option value="dialup" <?php isSelect($row['internet'], 'dialup'); ?>>I have Dial-Up</option>
															<option value="no" <?php echo isSelect($row['internet'], 'no'); ?>>No Internet</option>
														</select></td></tr>
<tr><td>Do you want information on Espotter?<br />(Espotter allows you to send in reports online)</td>
										<td><select name="espotter">
															<option value="yes" <?php isSelect($row['espotter'], 'yes'); ?>>Yes</option>
															<option value="no" <?php isSelect($row['espotter'], 'no'); ?>>No</option>
														</select></td></tr>
<tr><td>Would you like cell phone activation notices?</td><td><select name="sms">
															<option value="yes" <?php isSelect($row['sms'], 'yes'); ?>>Yes</option>
															<option value="no" <?php isSelect($row['sms'], 'no'); ?>>No</option>
														</select></td></tr>
<tr><td>Are you interested in becoming an amateur radio operator?</td><td><select name="rop">
															<option value="yes" <?php isSelect($row['rop'], 'yes'); ?>>Yes</option>
															<option value="no" <?php isSelect($row['rop'], 'no'); ?>>No</option>
														</select></td></tr>

<tr><td><hr /></td><td><hr /></td></tr>														
<tr><td>Callsign:</td><td><input type="text" name="callsign" maxlength="75" value="<?php echo $row['callsign']; ?>"></td></tr>
<tr><td>Availability: <br />Hold CTRL to select multiple.</td><td><select name="availability">
													<option value="anytime" <?php isSelect($row['availability'], 'anytime'); ?>>Anytime</option>
													<option value="evenings" <?php isSelect($row['availability'], 'evenings'); ?>>Evenings</option>
													<option value="weekends" <?php isSelect($row['availability'], 'weekends'); ?>>Weekends</option>
													<option value="weeknight" <?php isSelect($row['availability'], 'weeknights'); ?>>Week Nights</option>
													<option value="weekday" <?php isSelect($row['availability'], 'weekday'); ?>>Week Day</option>
												</select></td></tr>
<tr><td>Repeaters used:</td><td><input type="text" name="repeaters" maxlength="75" value="<?php echo $row['repeaters']; ?>"></td></tr>	
<tr><td>Current County SKYWARN/EOC point of contact:</td><td><input type="text" name="eoc" maxlength="75" value="<?php echo $row['eoc']; ?>"></td></tr>											
<tr><td>Are you Echolink ready?</td><td><select name="echo">
															<option value="yes" <?php isSelect($row['echo'], 'yes'); ?>>Yes</option>
															<option value="no" <?php isSelect($row['echo'], 'no'); ?>>No</option>
														</select></td></tr>
<tr><td>Are you ready for mobile weather spotting?</td><td><select name="mobilespot">
															<option value="yes" <?php isSelect($row['mobilespot'], 'yes'); ?>>Yes</option>
															<option value="no" <?php isSelect($row['mobilespot'], 'no'); ?>>No</option>
														</select></td></tr>
<tr><td>Have you ever volunteered at the Wichita NWS during severe weather?</td><td><select name="volunteered">
															<option value="yes" <?php isSelect($row['volunteered'], 'yes'); ?>>Yes</option>
															<option value="no" <?php isSelect($row['volunteered'], 'no'); ?>>No</option>
														</select></td></tr>

<tr><td>Have you been briefed on how to volunteer at the Wichita NWS?</td><td><select name="nwsbriefed">
															<option value="yes" <?php isSelect($row['nwsbriefed'], 'yes'); ?>>Yes</option>
															<option value="no" <?php isSelect($row['nwsbriefed'], 'no'); ?>>No</option>
														</select></td></tr>
														
<tr><td>Comments:</td><td><textarea rows="2" name="comment"><?php echo $row['comment']; ?></textarea></td></tr>
<tr><td colspan="2" align="right">
<input type="hidden" name="update_profile" value="1">
<input type="submit" value="Update!"></td></tr>
</table>
</form>
</div>