<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$message = '';
if(isset($msg) && $msg ==1){
	$message = '<div class="alert alert-danger">Username or Password was incorrect!</div>';
}
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Admin Login</title>
	
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	
	<style type="text/css">
		#login-box{
			    border: solid 1px #ddd;
			padding: 30px;
			margin-top: 10%;
			box-shadow: 1px 1px 1px #ccc;
			border-radius: 5px;
		}
		.links{
			float: right;
		}
	</style>
</head>
<body>

<div class="container">
	

	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6" id="login-box">
			<?php echo $message; ?>
			<form action="<?php echo base_url("Login/login_action"); ?>" name="login_form" method="POST" onSubmit="return validation()">
				<h4>Admin Login</h4>
				<div class="form-group">			
					<input type="text" name="username" id="username" placeholder="Username" class="form-control"/>
				</div>
				<div class="form-group">
					<input type="password" name="password" id="password" placeholder="Password" class="form-control"/>
				</div>

				<div class="form-group">
					<input type="submit" name="login" value="Login"class="btn btn-primary"/>
				</div>
			</form>
		</div>
	</div>

</div>
<script>
function validation(){
	var user = document.getElementById("username").value;
	var pass = document.getElementById("password").value;
	if(user == ""){
		alert("Please Enter Username"); return false;
	}
	if(pass == ""){
		alert("Please Enter Password"); return false;
	}
}
</script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</body>
</html>