<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><?php $this->view('head');
?>
<div class="blank">
    	<h2>New Announcement</h2>
    	<div class="blankpage-main">
            <div class="signup-block">
          <form action="" method="post" id="submitf">
              Title:
		<input type="text" name="title" value="" required="">
                Description:
                <input type="text" name="desc" value="" required=""  cols="40" 
       rows="5"
       style="height:200px;"  > 
                Google Drive link for attachment:
                <input type="text" name="link" value="" required="">
                Class Name:
                <select name="cid" form="submitf" style="width:100%;font-size: 0.9em;padding: 10px 20px;width: 100%;color: #686967;outline: none;border: 1px solid #D3D3D3;
                        border-radius: 5px;-ms-border-radius: 5px;-moz-border-radius: 5px;-o-border-radius: 
                        5px;background: #F5F5F5;margin: 0em 0em 1.5em 0em;" >
                    <?php foreach($class as $row){?>
                    <option value="<?php echo $row->id;?>"><?php echo $row->name;?></option>
                    <?php }?>
                </select>
              
		<input type="submit" name="submit" value="Submit">														
	</form>
    	</div>
            </div>
</div>
<?php $this->view('footer'); ?>

