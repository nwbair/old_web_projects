<div id="register">
<form name="register" action="process.php" method="POST">
<table border="0" cellspacing="0" cellpadding="3">
<tr><td>Email:</td><td><input type="text" name="email" maxlength="50"></td><td></td></tr>
<tr><td>First Name:</td><td><input type="text" name="firstname" maxlength="75"></td></tr>
<tr><td>Last Name:</td><td><input type="text" name="lastname" maxlength="75"></td></tr>
<tr><td>Street Address:</td><td><input type="text" name="street" maxlength="75"></td></tr>
<tr><td>City:</td><td><input type="text" name="city" maxlength="28"></td></tr>
<tr><td>State:</td><td><input type="text" name="state" maxlength="2"></td></tr>
<tr><td>Zip Code:</td><td><input type="text" name="zipcode" maxlength="5"></td></tr>
<tr><td>Resident County:</td><td><input type="text" name="rescounty" maxlength="20"></td></tr>
<tr><td>Home Phone #:</td><td><input type="text" name="homephone" maxlength="15"></td></tr>
<tr><td>Cell Phone #:</td><td><input type="text" name="cellphone" maxlength="15"></td></tr>
<tr><td>Cell Provider (e.g. Sprint, AT&T, etc...):</td><td><input type="text" name="cellprovider" maxlength="20"></td></tr>
<tr><td>Work Phone #:</td><td><input type="text" name="workphone" maxlength="15"></td></tr>
<tr><td>Internet Access:</td><td><select name="internet">
															<option value="broadband">I have Broadband</option>
															<option value="dialup">I have Dial-Up</option>
															<option value="no">No Internet</option>
														</select></td></tr>
<tr><td>Do you want information on Espotter?<br />(Espotter allows you to send in reports online)</td>
										<td><select name="espotter">
															<option value="yes">Yes</option>
															<option value="no">No</option>
														</select></td></tr>
<tr><td>Would you like cell phone activation notices?</td><td><select name="sms">
															<option value="yes">Yes</option>
															<option value="no">No</option>
														</select></td></tr>
<tr><td>Are you interested in becoming an amateur radio operator?</td><td><select name="rop">
															<option value="yes">Yes</option>
															<option value="no">No</option>
														</select></td></tr>

<tr><td><hr /></td><td><hr /></td></tr>														
<tr><td>Callsign:</td><td><input type="text" name="callsign" maxlength="75"></td></tr>
<tr><td>Availability: <br />Hold CTRL to select multiple.</td><td><select name="availability">
													<option value="anytime">Anytime</option>
													<option value="evenings">Evenings</option>
													<option value="weekends">Weekends</option>
													<option value="weeknight">Week Nights</option>
													<option value="weekday">Week Day</option>
												</select></td></tr>
<tr><td>Repeaters used:</td><td><input type="text" name="repeaters" maxlength="75"></td></tr>	
<tr><td>Current County SKYWARN/EOC point of contact:</td><td><input type="text" name="eoc" maxlength="75"></td></tr>											
<tr><td>Are you Echolink ready?</td><td><select name="echo">
															<option value="yes">Yes</option>
															<option value="no">No</option>
														</select></td></tr>
<tr><td>Are you ready for mobile weather spotting?</td><td><select name="mobilespot">
															<option value="yes">Yes</option>
															<option value="no">No</option>
														</select></td></tr>
<tr><td>Have you ever volunteered at the Wichita NWS during severe weather?</td><td><select name="volunteered">
															<option value="yes">Yes</option>
															<option value="no">No</option>
														</select></td></tr>

<tr><td>Have you been briefed on how to volunteer at the Wichita NWS?</td><td><select name="nwsbriefed">
															<option value="yes">Yes</option>
															<option value="no">No</option>
														</select></td></tr>
														
<tr><td>Comments:</td><td><textarea rows="2" name="comment"></textarea></td></tr>
<tr><td colspan="2" align="right">
<input type="hidden" name="registertime" value="<?php $time = time(); echo $time; ?>">
<input type="hidden" name="register" value="1">
<input type="submit" value="Register!"></td></tr>
</table>
</form>
</div>