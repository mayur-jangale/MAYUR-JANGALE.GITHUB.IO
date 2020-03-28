<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!--Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>Login | Classbroom.me Colleges</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<link href="/css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<!-- Custom Theme files -->
<link href="/css/style.css" rel="stylesheet" type="text/css" media="all"/>
<!--js-->
<script src="/js/jquery-2.1.1.min.js"></script> 
<!--icons-css-->
<link href="/css/font-awesome.css" rel="stylesheet"> 
<!--Google Fonts-->
<link href='//fonts.googleapis.com/css?family=Carrois+Gothic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Work+Sans:400,500,600' rel='stylesheet' type='text/css'>
<!--static chart-->
</head>

<body>	
<div class="login-page">
    <div class="login-main">  	
    	 <div class="login-head">
				<h1>Login As Student/Teacher</h1>
			</div>
			<div class="login-block">
				<form action="/users/login" method="post">
                                        <?php
                                        if(!empty($success_msg)){
                                            echo '<p class="statusMsg">'.$success_msg.'</p>';
                                        }elseif(!empty($error_msg)){
                                            echo '<p class="statusMsg">'.$error_msg.'</p>';
                                        }
                                        ?>
					<input type="text" name="email" placeholder="Email" required="">
                                        <?php echo form_error('email','<span class="help-block">','</span>'); ?>
					<input type="password" name="password" class="lock" placeholder="Password">
                                        <?php echo form_error('password','<span class="help-block">','</span>'); ?>
					<div class="forgot-top-grids">
						<div class="forgot-grid">
							
						</div>
						<!--<div class="forgot">
							<a href="https://social.classbroom.me/forgot-password">Forgot password?</a>
						</div>-->
						<div class="clearfix"> </div>
					</div>
					<input type="submit" name="Sign In" value="Login">	
					<h3>Not a member?<a href="/users/register"> Sign up now</a></h3>				
					
				</form>
				<h5><a href="/">Go Back to Home</a></h5>
			</div>
     
</div>
<center><a href="https://www.classbroom.me">Home</a> | <a href="https://social.classbroom.me">Globe</a> | <a href="https://chat.classbroom.me">English Practice</a> | <a href="https://test.classbroom.me">Tests</a> | 
<a href="https://forum.classbroom.me">Questions</a> | <a href="https://notes.classbroom.me">Notes</a> | <a href="https://dictionary.classbroom.me">Dictionary</a> 
</center>
<!--inner block end here-->
<!--copy rights start here-->
<div class="copyrights">
	 <p>© Classbroom.me - All Rights Reserved | Template Donated by <a href="http://w3layouts.com/" target="_blank">W3layouts</a> </p>
</div>	
		<script src="/js/jquery.nicescroll.js"></script>
		<script src="/js/scripts.js"></script>
		<!--//scrolling js-->
<script src="/js/bootstrap.js"> </script>
<!-- mother grid end here-->
</body>
</html>  	


