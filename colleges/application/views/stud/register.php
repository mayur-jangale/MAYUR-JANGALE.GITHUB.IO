
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
<title>Students Registration | Classbroom.me Colleges</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Shoppy Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
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
<!--inner block start here-->
<div class="signup-page-main">
     <div class="signup-main">  	
    	 <div class="signup-head">
            <h1>Join Class As Student</h1>
         </div>
			<div class="signup-block">
                            <?php foreach($classdata as $row) {?>
                            <b>Class name: <?php echo $row->name?><br>
                            College name: <?php echo $row->cname?></b>
                           
                           <hr>
                                <?php }?>
				 I am:<br><select style="font-size: 0.9em;
                                padding: 10px 20px;
                                width: 100%;
                                color: #686967;
                                outline: none;
                                border: 1px solid #D3D3D3;
                                border-radius: 5px;
                                -ms-border-radius: 5px;
                                -moz-border-radius: 5px;
                                -o-border-radius: 5px;
                                background: #F5F5F5;
                                margin: 0em 0em 1.5em 0em;">
            <option>choose</option>
            <option value="red">First time user, I do not have account yet.</option>
            <option value="green">Returning user, I already have account.</option>
            
            
        </select>
    
         <div class="red box">
             <form action="" method="post">
                                     <?php echo form_error('email_check','<span class="help-block">','</span>'); ?>
					<input type="text" name="name" placeholder="Name" required="">
                                         <?php echo form_error('name','<span class="help-block">','</span>'); ?>
					<input type="text" name="email" placeholder="Email" required="" >
                                         <?php echo form_error('email','<span class="help-block">','</span>'); ?>
                                        <input type="text" name="mobile" placeholder="Mobile Number for SMS Updates">
					<input type="password" class="lock" name="password" placeholder="Password" required="">
                                        <?php echo form_error('password','<span class="help-block">','</span>'); ?>
                                        <input type="password" class="lock" name="conf_password" placeholder="Confirm password" required="">
                                        <?php echo form_error('conf_password','<span class="help-block">','</span>'); ?>
                                                                        <?php
                                          if(!empty($user['gender']) && $user['gender'] == 'Female'){
                                              $fcheck = 'checked="checked"';
                                              $mcheck = '';
                                          }else{
                                              $mcheck = 'checked="checked"';
                                              $fcheck = '';
                                          }
                                          ?> 
                                          <div class="radio">
                                              <label>
                                              <input type="radio" name="gender" value="Male" <?php echo $mcheck; ?>>
                                              Male
                                              </label>
                                          </div>
                                          <div class="radio">
                                              <label>
                                                <input type="radio" name="gender" value="Female" <?php echo $fcheck; ?>>
                                                Female
                                              </label>
                                          </div>
                                      
					<div class="forgot-top-grids">
						<div class="forgot-grid">
							<ul>
								<li>
									<input type="checkbox" id="brand1" value="">
									<label for="brand1"><span></span>I agree to the terms</label>
								</li>
							</ul>
						
                                       </div>
                                        <center>
                                            <input type="submit" name="signup" value="Sign up" >
                                        </center>
                                     
                                   </div>
                       
				</form>
         </div>
         <div class="green box">
             <form action="" method="post">
                                        <?php
                                        if(!empty($success_msg)){
                                            echo '<p class="statusMsg">'.$success_msg.'</p>';
                                        }elseif(!empty($error_msg)){
                                            echo '<p class="statusMsg">'.$error_msg.'</p>';
                                        }
                                        ?>
					<input type="text" name="email" placeholder="Email" required="" >
                                        <?php echo form_error('email','<span class="help-block">','</span>'); ?>
					<input type="password" name="password" class="lock" placeholder="Password" >
                                        <?php echo form_error('password','<span class="help-block">','</span>'); ?>
					<div class="forgot-top-grids">
						<div class="forgot-grid">
							
						</div>
						<div class="forgot">
							<a href="#">Forgot password?</a>
						</div>
						<div class="clearfix"> </div>
					</div>
					<input type="submit" name="login" value="Login">	
									
					
				</form>
         </div>
   
                            
                            <script type="text/javascript">
                                $(document).ready(function(){
                                    $("select").change(function(){
                                        $(this).find("option:selected").each(function(){
                                            var optionValue = $(this).attr("value");
                                            if(optionValue){
                                                $(".box").not("." + optionValue).hide();
                                                $("." + optionValue).show();
                                            } else{
                                                $(".box").hide();
                                            }
                                        });
                                    }).change();
                                });
                            </script>
				
			</div></div>
			
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>   
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script> 

	
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
