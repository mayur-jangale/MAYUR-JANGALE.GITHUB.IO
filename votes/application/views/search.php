<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><?php $this->view('head'); ?>
  <h3>SEARCH BY NAME </br>(example: av for avinash)</h3> 
        <form action="/people/results" id="usrform" method="post">
  <input class="form-control" type="text" name="key">
  
<br>
<input class="w3-btn w3-ripple w3-red w3-border w3-border-red  w3-round-large center" type="Submit">
</form>



<hr><h2>OR</h2>
                <h3> FIND FRIENDS BY LOCATION</h3>
   <font color="green"><br><?php echo $this->session->flashdata('msg'); ?></font>
      <font color="green"> <?php echo validation_errors(); ?></font>
        <form action="/people/results" id="usrform" method="post">
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
    
  <input class="form-control" type="text" name="key" placeholder="Name"><br>
  <input type="submit" class="w3-btn w3-ripple w3-red w3-border w3-border-red  w3-round-large center" value="Search">
</form>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>   
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script> 
    <script src="/js/location.js"></script>  
     </div>
	 <?php $this->view('footer'); ?>
</body>
</html>

