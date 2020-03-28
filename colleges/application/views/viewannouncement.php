<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->view('head');
foreach($data as $row){ ?>
<div class="blank">
    <h2><?php echo $row->title?></h2>
    <?php
    if(!empty($success_msg)){
    echo $success_msg;
    }elseif(!empty($error_msg)){
    echo $error_msg;
    }
    ?>
    <div class="blankpage-main"> 
        <b>Description:</b>  
    <?php echo $row->content?>
    <hr>            
    
    <?php if(isset($row->dlink))?><b>Attachment:<a href="<?php echo $row->dlink?>"> Download</a></b><?php ;?>
               	
<?php }?>

   </div>
</div> 
<?php $this->view('footer'); ?> 