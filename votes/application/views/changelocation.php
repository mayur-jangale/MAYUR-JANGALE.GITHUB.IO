<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
    <?php $this->view('head'); ?>

<h3>Select The Location</h3> 
Currently Set to: <?php echo $location->name ?>

        <form action="" role="form" class="form-horizontal" id="location" method="post" accept-charset="utf-8">
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
            <input type="submit" class="w3-btn w3-ripple w3-red w3-border w3-border-red  w3-round-large center"value="change">
</form>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>   
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script> 
    <script src="/js/location.js"></script>   
</div>
<?php $this->view('footer'); ?>
</body>
</html>

