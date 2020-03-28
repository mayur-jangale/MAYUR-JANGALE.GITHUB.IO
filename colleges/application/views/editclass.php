<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><?php $this->view('head');
?>


<div class="blank">
    	<h2>Edit Classroom</h2>
    	<div class="blankpage-main">
            <div class="signup-block">
          <form action="/classroom/edit/<?php echo $id?>" method="post">
              Name:
              <?php foreach ($row as $rows){ ?>
		<input type="text" name="name" value="<?php echo $rows->name?>" required="">
                <input type="hidden" name="quantity" value="120" required=""> 
                College/Institute/organisation Name:
                <input type="text" name="cname" value="<?php echo $rows->cname?>" required="">
              <?php }?>
		<input type="submit" name="edit" value="edit">														
	</form>
    	</div>
            </div>
    </div>
<?php $this->view('footer'); ?>