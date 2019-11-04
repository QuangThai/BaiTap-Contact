<?php
	include_once 'conn.php';
	$information="";
	if(isset($_POST['username'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$sql = "SELECT * FROM users WHERE username='".$username."' AND password='".$password."' LIMIT 1 ";
		$result = mysqli_query($con,$sql);
		if(mysqli_num_rows($result) == 1 ) {
			header("location:contact.php");
			exit();
		}
		else {
			
			echo "<script>alert('Vui lòng kiểm tra lại thông tin đăng nhập')</script>";
		}
	}
?>


<!doctype html>
<html>
<head>
	<title>Official Signup Form Flat Responsive widget Template :: w3layouts</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Official Signup Form Responsive, Login form web template,Flat Pricing tables,Flat Drop downs  Sign up Web Templates, Flat Web Templates, Login signup Responsive web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	<!-- fonts -->
	<link href="//fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Monoton" rel="stylesheet">
	<!-- /fonts -->
	<!-- css -->
	<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/style.css" rel='stylesheet' type='text/css' media="all" />
	<!-- /css -->
</head>
<body>
<h1 class="w3ls">Login Form</h1>
<div class="content-w3ls">
	<div class="content-agile1">
		<h2 class="agileits1">Quang Thái</h2>
		<p class="agileits2">K40C-CNTT</p>
	</div>
	<div class="content-agile2">
		<form action="login.php" method="post">
			<div class="form-control w3layouts"> 
				<input type="text" id="firstname" name="username" placeholder="username" title="Please enter your First Name" required="">
			</div>

			<div class="form-control w3layouts">	
				<input type="password" id="password2" name="password" placeholder="password" title="Please enter a valid email" required="">
			</div>
			
			<input type="submit" class="register" value="login">
		</form>
		<?php if(strlen($information)!= 0) {?> 
            <div class="alert alert-danger" style="color: red;text-align: center; margin-bottom: 20px;">
                <?php echo $information; ?>
            </div>
        <?php }?>
		<script type="text/javascript">
			window.onload = function () {
				document.getElementById("password1").onchange = validatePassword;
				document.getElementById("password2").onchange = validatePassword;
			}
			function validatePassword(){
				var pass2=document.getElementById("password2").value;
				var pass1=document.getElementById("password1").value;
				if(pass1!=pass2)
					document.getElementById("password2").setCustomValidity("Passwords Don't Match");
				else
					document.getElementById("password2").setCustomValidity('');	 
					//empty string means no validation error
			}
		</script>
		<p class="wthree w3l">Fast Signup With Your Favourite Social Profile</p>
		<ul class="social-agileinfo wthree2">
			<li><a href="#"><i class="fa fa-facebook"></i></a></li>
			<li><a href="#"><i class="fa fa-youtube"></i></a></li>
			<li><a href="#"><i class="fa fa-twitter"></i></a></li>
			<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
		</ul>
	</div>
	<div class="clear"></div>
</div>
</body>
</html>