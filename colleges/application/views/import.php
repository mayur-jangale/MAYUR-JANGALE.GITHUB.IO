
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><?php $this->view('head');
?>
<div class="blank">
    	<h2>Import Students</h2>
    	<div class="blankpage-main">
            <div class="signup-block">
			To import classwise students follow the following steps:<br>
		Step 1. Download the Sample file by <a href="/sample.xls">clicking here</a>.<br>
		Step 2. Update the file with own data.<br>
		step 3. Choose the class Name:<br>
          <form action="" method="post" id="submitf">
                <select name="cid" form="submitf" style="width:100%;font-size: 0.9em;padding: 10px 20px;width: 100%;color: #686967;outline: none;border: 1px solid #D3D3D3;
                        border-radius: 5px;-ms-border-radius: 5px;-moz-border-radius: 5px;-o-border-radius: 
                        5px;background: #F5F5F5;margin: 0em 0em 1.5em 0em;" >
                
                    <?php foreach($class as $row){?>
                    <option value="<?php echo $row->id;?>"><?php echo $row->name;?></option>
                    <?php }?>
                </select>
		step 4. Choose the Names sheet:<br>
		<input type="file" name="efile[]" required accept=".xls, .xlsx" >	
              <br>
        Step 5. Submit      
		<input type="submit" name="submit" value="Submit">														
	</form><hr>
		Step 6. Varify Uploaded data by exporting attendence <a href="/attend/export">here.</a>
    	</div>
            </div>
</div>

<script>

document.getElementById('datep').value = new Date().toDateInputValue();    
</script>
<?php $this->view('footer'); ?>           
    

