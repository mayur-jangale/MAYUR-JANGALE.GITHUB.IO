<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><?php $this->view('head');
?>
<?php if($user['type']==0){?>
                  
          
			
                            <div class="col-md-4 market-update-gd">
				<div class="market-update-block clr-block-1">
					<div class="col-md-8 market-update-left">
						<h3><?php echo $studno?></h3>
						<h4>TOTAL STUDENTS</h4>
						
					</div>
					<div class="col-md-4 market-update-right">
						<i class="fa fa-file-text-o"> </i>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-4 market-update-gd">
				<div class="market-update-block clr-block-2">
				 <div class="col-md-8 market-update-left">
					<h3><?php echo $classno?></h3>
					<h4>TOTAL CLASSROOMS</h4>
					
				  </div>
					<div class="col-md-4 market-update-right">
						<i class="fa fa-eye"> </i>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-4 market-update-gd">
				<div class="market-update-block clr-block-3">
					<div class="col-md-8 market-update-left">
						<h3><?php echo $annono?></h3>
						<h4>Announcements Sent</h4>
						
					</div>
					<div class="col-md-4 market-update-right">
						<i class="fa fa-envelope-o"> </i>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
                      

<?php }
else{?>
                        
<div class="blank">
  <h2>Announcements</h2>	

    <?php
    if(!empty($success_msg)){
    echo $success_msg;
    }elseif(!empty($error_msg)){
    echo $error_msg;
    }
    ?>

    <div class=" chit-chat-layer1-left">
               <div class="work-progres">
                            
                            <div class="table-responsive">
                                <table class="table table-hover">
                                  <thead>
                                    <tr>
                                      <th>#</th>
                                      <th>Title</th>
                                      <th>Time</th>
                                      <th>Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                              <?php
                              $x=1;
                              foreach($data as $row){?> 
                              <tr>
                                  <td><?php echo $x ?></td>
                                  <td><?php echo $row->title ?></td>                                
                                                             
                                  <td><?php echo date('M j Y g:i A', strtotime($row->timestamp)); ?></td>
                                  <td>  
                                  <a href="/announcement/open/<?php echo $row->id ?>" class="btn btn-1 btn-primary">Open</a>
                              
                                  </td>
                              </tr>
                              <?php
                              $x++;
                              }?>
                          </tbody>
                      </table>
                  </div>
             </div>
      </div>        

</div>

<?php } ?>
<?php $this->view('footer'); ?>

