<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link href="/css/adminstyle.css" rel="stylesheet"> 


	
</head>
<body>
<?php 
$email = session('email');
$password = null;

if (!Session::has('login_fail')) {
	$password = session('password');
}
 ?>

		
<form method="post" action="{{url('admin/login')}}">
	{{csrf_field()}}
	<div class="login-form">
		<h1>LSIMAGE PRINT ENTERPRICE</h1>
		<div class="login-form-panel-header">
			<h3>Admin Login</h3>
		</div>
		<div class="login-form-panel">
		 <div class="form-field">
		 	<input type="text" name="email" value="{{$email}}" placeholder="E-mail address">
					
			<div class="error-message">
			{{$errors->first('email')}}
			</div>

		</div>

		<div class="form-field">
			<input type="password" name="password" value="{{$password}}" placeholder="Password">

			<div class="error-message">
			{{$errors->first('password')}}
			</div>
		</div>
		<input type="submit" name="login" value="LOGIN">
	
			<p>Forget your password?	<a href="forgetpassword.php">Click Here</a></p>

		<div class="error-message">
			<?php if (Session::has('login_fail')): ?>
			{{\Session::get('login_fail')}}
			<?php endif ?>
			
		</div>
		</div>
		
		 
		
		

	</div>
			
</form>
</body>
</html>
