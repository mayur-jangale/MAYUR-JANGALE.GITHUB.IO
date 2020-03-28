
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><?php $this->view('head');
?>
<div class="blank">
    	<h2>Edit Attendance</h2>
    	<div class="blankpage-main">
            <div class="signup-block">
          <form action="" method="post" id="submitf">
              
              
              <?php foreach($record as $row){
                   
                    $someArray = json_decode($row->data, true);
                     ?>
              Note: Checked means Present and Unchecked means Unsent.<br>
                    <?php for($i=1;$i<=120;$i++){?>
                    <label class="container">Roll No:<?php echo $i; ?>
                      <input type="checkbox" name="roll<?php echo $i; ?>" <?php if($someArray[0][$i]=='on')echo 'checked="checked"';?>>
                      <span class="checkmark"></span>
                    </label>
                <?php }?>
              <?php }?>
              
		<input type="submit" name="submit" value="Submit">														
	</form>
    	</div>
            </div>
</div>

<?php $this->view('footer'); ?>           
    

