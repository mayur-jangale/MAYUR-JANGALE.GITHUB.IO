<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->view('head');
?>

<div class="blank">
  <h2>Edit Announcement</h2>	

    <?php
    if(!empty($success_msg)){
    echo $success_msg;
    }elseif(!empty($error_msg)){
    echo $error_msg;
    }
    ?>
  <div class="blankpage-main">
            <div class="signup-block">
          <form action="" method="post" id="submitf">
              <?php foreach($data as $row){ ?>
              Title:
		<input type="text" name="title" value="<?php echo $row->title?>" required="">
                Description:
                <input type="text" name="desc" value="<?php echo $row->content?>" required=""  cols="40" rows="5" style="height:200px;"  > 
                Google Drive link for attachment:
                <input type="text" name="link" value="<?php echo $row->dlink?>" required="">
               
              
		<input type="submit" name="submit" value="Submit">	
              <?php }?>
	</form>
    	</div>
    </div>
</div> 
<?php $this->view('footer'); ?> 
