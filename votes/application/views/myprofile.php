<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><?php $this->view('head'); ?>


<h3>Edit Profile</h3>
<font color="green"><br><?php echo $this->session->flashdata('msg'); ?><?php echo validation_errors(); ?></font>
     
<hr>
    
<form action="/users/update" id="usrform" method="post">
Full Name:<br>
<input type="text" name="name" value="<?php echo $user['user_fullname'] ?> " class="form-control"><br>
Location:

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
    
 <input type="submit" class="w3-btn w3-ripple w3-red w3-border w3-border-red  w3-round-large center" value="Update">
</form>

<hr>
<h3> Comments</h3>
 <?php  foreach($comment as $row)
  { 
  if($row->user== null){$a='Anonymous';}else{$a = $row->user;}
  echo "<b> Name: ".$a."  <br> ";
  echo "Written :".$row->comment."</b><br>";
  echo "by:".$row->ip."</b><br>";
  echo '<a href="/users/delete/'.$row->id.'"><b>Delete This Comment</b></a>';
  echo '<hr />';
  

      }
  ?>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>   
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script> 
    <script src="/js/location.js"></script>  
    </div>
	<?php $this->view('footer'); ?>
</body>
</html>