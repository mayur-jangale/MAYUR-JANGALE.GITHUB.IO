<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><?php $this->view('head'); ?>
				<form action="/users/login" method="post">
					<p class="legend">Login Here<span class="fa fa-hand-o-down"></span></p>
                                          <?php
    if(!empty($success_msg)){
        echo '<p class="statusMsg">'.$success_msg.'</p>';
    }elseif(!empty($error_msg)){
        echo '<p class="statusMsg">'.$error_msg.'</p>';
    }
    ?>
					<div class="input">
						<input type="email" placeholder="Email" name="email" required class="form-control"/>
						
                                                <?php echo form_error('email','<span class="help-block">','</span>'); ?>
					</div>
					<div class="input">
						<input type="password" placeholder="Password" name="password" required class="form-control"/>
						
                                        </div><br>
					<button type="submit" class="btn submit" >
						Login
                                                <?php echo form_error('password','<span class="help-block">','</span>'); ?>
					</button>
				</form>
				<a href="https://social.classbroom.me/forgot-password" class="bottom-text-mak-widls">Forgot Password?</a>
			| <a href="/users/register" class="bottom-text-mak-widls" >Register</a>
                        </div>
		</div>
		<!-- //content -->
		<!-- copyright -->
		<div class="copyright">
			
		</div>
		<!-- //copyright -->
	</div>

	<?php $this->view('footer'); ?>
</body> 

</html>