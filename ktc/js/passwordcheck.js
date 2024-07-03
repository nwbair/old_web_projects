function checkPassword()
{
	var password1 = document.getElementById('newPassword');
	var password2 = document.getElementById('verifyPassword');
	
	var message = document.getElementById('confirmMessage');
	
	var goodColor = "#66cc66";
	var badColor = "#ff6666";
	
	if(password1.value == password2.value) {
		password2.style.backgroundColor = goodColor;
		message.style.color = goodColor;
		message.innerHTML = "Passwords match.";
		
	} else {
		password2.style.backgroundColor = badColor;
		message.style.color = badColor;
		message.innerHTML = "Passwords do not match.";
	}
}
