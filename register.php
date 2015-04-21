<?php

session_start();
$page_title = 'Registration Form';
require("database.php");
require("functions.php");



if (isset ($_POST['submit']))	{ 

$username = $_POST['username'];
$password = $_POST['password'];
$password2 = $_POST['password2'];
$email = $_POST['email'];
$email2 = $_POST['email2'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$address1 = $_POST['address1'];
$address2 = $_POST['address2'];
$city = $_POST['city'];
$phone = $_POST['phone'];
$state = $_POST['state'];
$login = 'http://thomasg.smtchs.org/php/login.php';
$error=0;


	if(empty($username)) {
		echo "Please enter your username.";
		echo '<br>';
	}
	else {
		$username = stripslashes(trim($_POST['username']));
		$query = "SELECT username FROM users WHERE username = '$username';";
		echo $query;
		
		$result=mysql_query($query);
		if ($result==false) {
			    die(mysql_error());
			}
		
		$row = mysql_fetch_array($result, MYSQL_NUM);
				
		if (@mysql_num_rows($result) == 1) {
			echo "That username has already been taken.";
			echo '<br>';
			$error++;
			}				
		} 
	
		
	if (empty($password)) {
		echo "Please enter your password.";
		echo '<br>';
		$error++;
	}
	
	else { // record password
		$password = stripslashes(trim($_POST['password']));
		if (empty($password2)) { // check if password has been confirmed
			echo "Please confirm your password.";
			echo '<br>';
			$error++;
		}
		
		else { // record confirmed password
			if ($password != $password2) { // check if passwords match
				echo "Passwords do not match.";
				echo '<br>';
				$error++;
			}
			
			else { 
				$password2 = stripslashes(trim($_POST['password2']));
				return $password2;
			}
		}
	}
	
		
$email = trim(stripslashes(filter_var($email, FILTER_SANITIZE_EMAIL)));
	
	if (!filter_var($email, FILTER_VALIDATE_EMAIL === false)) {
		$error++;
		echo "Email address is invalid.";
		echo "<br>";
	}
	
		
	if (empty($address1)) {
		echo "Please enter your mailing address.";
		echo '<br>';
		$error++;
	} 
	else {
		$address1 = stripslashes(trim($_POST['address1']));
	}
	if (empty($city)) {
		echo "Please enter your city.";
		echo '<br>';
		$error++;
	}
	else {
		$city = stripslashes(trim($_POST['city']));
	}
	if (empty($state)) {
		echo "Please enter your state.";
		echo '<br>';
		$error++;
	}
	else {
		$state = stripslashes(trim($_POST['state']));
	}
	if (empty($phone)) {
		echo "Please enter your phone number.";
		echo '<br>';
		$error++;
	}
	else { 
		$phone = stripslashes(trim($_POST['phone']));
	}
	
	
	if ($error == 0) {
		$query = "INSERT INTO users (username, password, email, fname, lname, addressone, addresstwo, city, state, telnumber) VALUES ('$username', '$password', '$email', '$fname', '$lname', '$address1', '$address2', '$city', '$state', '$phone');";
		
	
		$result = mysql_query($query) or trigger_error("Query MySQL Error: " . mysql_error());
				
		if (mysql_affected_rows() == 1) {
			echo "You have been entered into the database, click <a href = '<?php echo $login; ?>'> here</a> to login.";
			$_SESSION['password'] = $_POST['password'];
			$_SESSION['password2'] = $_POST['password2'];
			$_SESSION['username'] = $_POST['username'];
			$_SESSION['email'] = $_POST['email'];
			$_SESSION['email2'] = $_POST['email2'];
			$_SESSION['fname'] = $_POST['fname'];
			$_SESSION['lname'] = $_POST['lname'];
			$_SESSION['address1'] = $_POST['address1'];
			$_SESSION['address2'] = $_POST['address2'];
			$_SESSION['city'] = $_POST['city'];
			$_SESSION['phone'] = $_POST['phone'];
			$_SESSION['state'] = $_POST['state'];
		}
		else {
			echo "Sorry, an error has occurred.";
		}	
	}
	
}

?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="styles/css/bootstrap.css">
   <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="styles/js/bootstrap.js"></script>

<link href="styles/css/stylesheet.css" rel="stylesheet" type="text/css">
<title>Register</title>
</head>
<body>
<div id="wrapper">
	
<nav class="navbar navbar-default navbar-fixed-top">
	<!--[if IE]><div style='clear: both; height: 112px; padding:0; position: relative;'><a href="http://www.theie7countdown.com/ie-users-info"><img src="http://www.theie7countdown.com/assets/badge_iecountdown.png" border="0" height="112" width="348" alt="" /></a></div><![endif]-->
		<div class="container-fluid">
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li role="navigation"><a href="home.html">Home</a></li>
					<li role="navigation"><a href="about.html">About Me</a></li>
					<li class="dropdown"><a href="#" data-toggle="dropdown" class="dropdown-toggle">Projects <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="conditions.php">True or False Conditionals</a></li>
							<li><a href="temperature.html">Clothing Picker</a></li>
							<li><a href="countdown.html">Countdown</a></li>
							<li><a href="fileuploader.html">File Uploader</a></li>
						</ul>
						</li>
					<li role="navigation"><a href="contact.php">Contact Me</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li role="navigation"><a href="login.html">Login</a></li>
					<li class="navbar-text">Thomas Garcia</li>
				</ul>
			</div>
		</div>
	</nav>
<h2>Register</h2>
	<form action="register.php" method="post">
		Username: <br> <input type="text" name="username" value = "<?php if (isset($username)) { echo $username; } ?>"/>
		<br>
		Password: <br> <input type="password" name="password" value = "<?php if (isset($password)) { echo $password; } ?>"/>
		<br>
		Repeat Password: <br> <input type="password" name="password2" />
		<br>
		Email: <br> <input type="text" name="email" value = "<?php if (isset($email)) { echo $email; } ?>"/>
		<br>
		Repeat Email: <br><input type="text" name="email2" />
		<br>
		First Name: <br> <input type="text" name="fname" value = "<?php if (isset($fname)) { echo $fname; } ?>"/>
		<br>
		Last Name: <br> <input type="text" name="lname" value = "<?php if (isset($lname)) { echo $lname; } ?>" />
		<br>
		Address: <br> <input type="text" name="address1" value = "<?php if (isset($address1)) { echo $address1; } ?>" />
		<br>
		Address 2: <br> <input type="text" name="address2" value = "<?php if (isset($address2)) { echo $address2; } ?>" />
		<br>
		City: <br> <input type="text" name="city" value = "<?php if (isset($city)) { echo $city; } ?>" />
		<br>
		State: <br> <input type="text" name="state" value = "<?php if (isset($state)) { echo $state; } ?>" />
		<br>
		Phone: <br> <input type="text" name="phone" value = "<?php if (isset($phone)) { echo $phone; } ?>" />
		<br>

		<input type="submit" name="submit" value="Submit" />
	</form>
<div id="footer">
	Copyright© 2015 Thomas Garcia
</div>
</div>

</body>
</html>
