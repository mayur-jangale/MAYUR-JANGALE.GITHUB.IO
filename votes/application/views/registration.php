<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><?php $this->view('head'); ?>

<h2>User Registration</h2>

   <?php echo form_error('email_check','<span class="help-block">','</span>'); ?>
    <form action="" method="post">
        <div class="form-group">
            <input type="text" class="form-control" name="name" placeholder="Name" required="" value="<?php echo !empty($user['name'])?$user['name']:''; ?>">
          <?php echo form_error('name','<span class="help-block">','</span>'); ?>
        </div>
        <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="Email" required="" value="<?php echo !empty($user['email'])?$user['email']:''; ?>">
          <?php echo form_error('email','<span class="help-block">','</span>'); ?>
        </div>
       <!-- <div class="form-group">
            <input type="text" class="form-control" name="phone" placeholder="Phone" value="<?php echo !empty($user['phone'])?$user['phone']:''; ?>">
        </div>-->
        <div class="form-group">
          <input type="password" class="form-control" name="password" placeholder="Password" required="">
          <?php echo form_error('password','<span class="help-block">','</span>'); ?>
        </div>
        <div class="form-group">
          <input type="password" class="form-control" name="conf_password" placeholder="Confirm password" required="">
          <?php echo form_error('conf_password','<span class="help-block">','</span>'); ?>
        </div>
        <div class="form-group">
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
        </div>
          <div class="form-group"> 
            <select name="country" class="form-control countries" id="countryId" required="required">
        <option value="">Select Country</option>
        </select>

        </div>
         <div class="form-group"> 

                <select name="state" class="form-control states" id="stateId" required="required">
        <option value="">Select State</option>
        </select>

        </div>
         <div class="form-group"> 

                <select name="city" class="form-control cities" id="cityId" required="required">
        <option value="">Select City</option>
        </select>

        </div>


        <div class="form-group">
            <input type="submit" name="Submit"  value="Register"/>
        </div>
    </form>

    <p class="footInfo">Already have an account? <a href="/users/login">Login here</a></p>              
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>   
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script> 
    <script src="/js/location.js"></script>  
	<?php $this->view('footer'); ?>
</body>
</html>