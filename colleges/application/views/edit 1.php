<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><?php $this->view('head');
?>
<div class="blank">
    	<h2>Edit attendance</h2>
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
              Date to edit<br> 
              <input type="date" name="date" id="datep" style="width:100%;font-size: 0.9em;padding: 10px 20px;width: 100%;color: #686967;outline: none;border: 1px solid #D3D3D3;
                        border-radius: 5px;-ms-border-radius: 5px;-moz-border-radius: 5px;-o-border-radius: 
                        5px;background: #F5F5F5;margin: 0em 0em 1.5em 0em;"><br><hr>
             
              <input type="submit" name="submit" value="edit">														
	</form>
    	</div>
            </div>
</div>

<script>

document.getElementById('datep').value = new Date().toDateInputValue();    
</script>
<?php $this->view('footer'); ?>   
