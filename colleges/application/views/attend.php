
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><?php $this->view('head');
?>
<div class="blank">
    	<h2>Take attendance</h2>
    	<div class="blankpage-main">
            <div class="signup-block">
          <form action="" method="post" id="submitf">
              
              Class Name:
                <select name="cid" form="submitf" style="width:100%;font-size: 0.9em;padding: 10px 20px;width: 100%;color: #686967;outline: none;border: 1px solid #D3D3D3;
                        border-radius: 5px;-ms-border-radius: 5px;-moz-border-radius: 5px;-o-border-radius: 
                        5px;background: #F5F5F5;margin: 0em 0em 1.5em 0em;" >
                
                    <?php foreach($class as $row){?>
                    <option value="<?php echo $row->id;?>"><?php echo $row->name;?></option>
                    <?php }?>
                </select>
              Date for Attendance:<br> 
              <input type="date" name="date" id="datep" style="width:100%;font-size: 0.9em;padding: 10px 20px;width: 100%;color: #686967;outline: none;border: 1px solid #D3D3D3;
                        border-radius: 5px;-ms-border-radius: 5px;-moz-border-radius: 5px;-o-border-radius: 
                        5px;background: #F5F5F5;margin: 0em 0em 1.5em 0em;" value="" required=""><br>
						<script>
						$(document).ready(function(){
						  $("button").click(function(){
							$("#toggler").toggle();
						  });
						});
						</script>

						<button class="btn btn-1 btn-primary" type='button'>Advanced</button>

						<div id="toggler" style="display:none"><font color="red">Note: This is for advanced users only.</font><br>
						No of lectures today on selected class(<font color="red">Carefull: Same attendance will be copied for next lectures</font>)
						 <select name="nooflecs" style="font-size: 0.9em;
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
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
               
                </select>
						</div><hr>
              Note: Checked means Present and Unchecked means Unsent.<br>
                              <?php for($i=1;$i<=120;$i++){?>
                    <label class="container">Roll No:<?php echo $i; ?>
                      <input type="checkbox" name="roll<?php echo $i; ?>" checked="checked">
                      <span class="checkmark"></span>
                    </label>
                <?php }?>
              
		<input type="submit" name="submit" value="Submit">														
	</form>
    	</div>
            </div>
</div>

<script>

document.getElementById('datep').value = new Date().toDateInputValue();    
</script>
<?php $this->view('footer'); ?>           
    

