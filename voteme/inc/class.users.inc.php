<?php

/**
 * Handles the user interactions for the app
 *
 *
 * @author Nick Bair
 * @copyright 2012 Nick Bair
 *
 */

class Users
{
	/**
	 * Database object
	 *
	 * @var object
	 */
	private $_db;

	/**
	 * Check for a database object and creates one if it does not exist
	 *
	 * @param object $db
	 * @return void
	 */
	public function __construct($db=NULL)
	{
		if(is_object($db))
		{
			$this->_db = $db;
		}
		else
		{
			$dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME;
			$this->_db = new PDO($dsn, DB_USER, DB_PASS);
		}
	}

	/**
	 * Check and insert a new account in the database
	 *
	 * @return string      action status message
	 *
	 */
	public function createAccount()
	{
		$u = trim($_POST['username']);
		$v = sha1(time());

		$sql = "SELECT COUNT(Username) AS theCount
				FROM Users
				WHERE Username=:email";
		if($stmt = $this->_db->prepare($sql)) 
		{
			$stmt->bindParam(":email", $u, PDO::PARAM_STR);
			$stmt->execute();
			$row = $stmt->fetch();
			if($row['theCount']!=0)
			{
				return "<h2> Error </h2>"
					 . "<p>The email address is already in use. "
					 . "Please try a different email address.</p>";		 
			}
			if(!$this->sendVerificationEmail($u, $v))
			{
				return "<h2> Error </h2>"
					 . "<p> There was an error sending your verification email. Please "
					 . "<a href="mailto:help@voteme.com<script type="text/javascript">
					/* <![CDATA[ */
						(function(){try{var s,a,i,j,r,c,l=document.getElementById("__cf_email__");a=l.className;if(a){s='';r=parseInt(a.substr(0,2),16);for(j=2;a.length-j;j+=2){c=parseInt(a.substr(j,2),16)^r;s+=String.fromCharCode(c);}s=document.createTextNode(s);l.parentNode.replaceChild(s,l);}}catch(e){}})();
					/* ]]> */
					</script>">contact us</a>"
                     . "for support. We apologize for the inconvenience. </p>";
			}
			$stmt->closeCursor();
		}

		$sql = "INSERT INTO users(Username, ver_code)
				VALUES(:email, :ver)";
		if($stmt = $this->_db->prepare($sql))
		{
			$stmt->bindParam(":email", $u, PDO::PARAM_STR);
			$stmt->bindParam(":ver", $v, PDO::PARAM_STR);
			$stmt->execute();
			$stmt->closeCursor();

			$userID = $this->_db->lastInsertId();
			$url = dechex($userID);

			/*
			 * If the UserID was successfully retrieved,
			 * then create a default list.
			 */
			$sql = "INSERT INTO lists (UserID, ListURL)
			        VALUES ($userID, $url)";
			if(!this->_db->query($sql))
			{
				return "<h2> Error </h2>"
				     . "<p> Your account was created, but "
				     . "creating your default list failed. </p>";
			} else {
				return "<h2> Success! </h2>"
				     . "<p> Your account was successfully created "
				     . "with the username <strong>$u</strong>."
				     . "Check your email!";
			}
		} else {
			return "<h2> Error </h2><p> Couldn't insert the "
			     . "user information into the database. </p>";
		}
	}

	/**
	 * Send an email with a verification link to the new user
	 *
	 * @param string $email    The user's email address
	 * @param string $ver      The random verification code for the user
	 * @return boolean         True on successful send and FALSE on failure
	 */
	private function sendVerificationEmail($email, $ver)
	{
		$e = sha1($email); // For verification purposes
		$to = trim($email);

		$subject = "[Vote Me] Please Verify Your Account";

		$headers = <<<MESSAGE
FROM: Vote Me <donotreply@voteme.com<script type="text/javascript">
/* <![CDATA[ */
	(function(){try{var s,a,i,j,r,c,l=document.getElementById("__cf_email__");a=l.className;if(a){s='';r=parseInt(a.substr(0,2),16);for(j=2;a.length-j;j+=2){c=parseInt(a.substr(j,2),16)^r;s+=String.fromCharCode(c);}s=document.createTextNode(s);l.parentNode.replaceChild(s,l);}}catch(e){}})();
/* ]]> */
</script>>
Content-Type: text/plain;
MESSAGE;

			$msg = <<<EMAIL 
You have a new account at Vote Me!

To get started, please activate your account and choose a
password by following the link below.

Your Username: $email

Activate your account: http://dev.almostlabs.com/voteme/accountverify.php?v=$ver&e=$e

If you have any questions, please contact help@voteme.com.<script type="text/javascript">
/* <![CDATA[ */
	(function(){try{var s,a,i,j,r,c,l=document.getElementById("__cf_email__");a=l.className;if(a){s='';r=parseInt(a.substr(0,2),16);for(j=2;a.length-j;j+=2){c=parseInt(a.substr(j,2),16)^r;s+=String.fromCharCode(c);}s=document.createTextNode(s);l.parentNode.replaceChild(s,l);}}catch(e){}})();
/* ]]> */
</script>

--
Thanks!

EMAIL;

		return mail($to, $subject, $msg, $headers);

	}

	/** 
	 * Check the credentials and verify the account
	 *
	 * @return array    an array containing status code and message
	 */
	public function verifyAccount()
	{
		$sql = "SELECT Username
		        FROM users 
		        WHERE ver_code=:ver
		        AND SHA1(Username)=:user
		        AND verified=0";

		if($stmt = $this->_db->prepare($sql))
		{
			$stmt->bindParam(':ver', $_GET['v'], PDO::PARAM_STR);
			$stmt->bindParam(':user', $_GET['e'], PDO::PARAM_STR);
			$stmt->execute();
			$row = $stmt->fetch();
			if(isset($row['Username']))
			{
				// Logs the user in if verification is successful
				$_SESSION['Username'] = $row['Username'];
				$_SESSION['LoggedIn'] = 1;
			} else {
				return array(4, "<h2>Verification Error</h2>n"
					.	"<p>This account has already been verified. "
					.	"Did you <a href="/password.php">forget "
					.	"your password?</a>");
			}
			$stmt->closeCursor();

			// No error message is required if verification is successful
			return array(0, NULL);
		} else {
			return array(2, "<h2>Error</h2>n<p>Database error.</p>");
		}
	}

	/** 
	 * Change the user's password
	 *
	 * @return boolean      TRUE on success and FALSE on failure
	 */
	public function updatePassword()
	{
		if(isset($_POST['p'])
			&&isset($_POST['r'])
			&& $_POST['p']==$_POST['r'])
		{
			$sql = "UPDATE users
					SET Password=MD5(:pass), verified=1
					WHERE ver_code=:ver
					LIMIT 1";
			try
			{
				$stmt = $this->_db->prepare($sql);
				$stmt->bindParam(":pass", $_POST['p'], PDO::PARAM_STR);
				$stmt->bindParam(":ver", $_POST['v'], PDO::PARAM_STR);
				$stmt->execute();
				$stmt->closeCursor();

				return TRUE;
			}
			catch(PDOException $e)
			{
				return FALSE;
			} 
		} else {
			return FALSE;
		}
	}
	
	/**
	 * Checks credentials and logs in the user
	 * 
	 * @return boolean       TRUE on success and FALSE on failure
	 */
	 
	public function accountLogin()
	{
		$sql = "SELECT Username
				FROM users
				WHERE Username=:user
				AND Password=MD5(:pass)
				Limit 1";
		try
		{
			$stmt = $this->_db->prepare($sql);
			$stmt->bindParam(':user', $_POST['username'], PDO::PARAM_STR);
			$stmt->bindParam(':pass', $_POST['password'], PDO::PARAM_STR);
			$stmt->execute();
			if($stmt->rowCount()==1)
			{
				$_SESSION['Username'] = htmlentities($_POST['username'], ENT_QUOTES);
				$_SESSION['LoggedIn'] = 1;
				return TRUE;
			}
			else {
				return FALSE;
			}
		}
		
		catch(PDOException $e)
		{
			return FALSE;
		}
				
	}
}