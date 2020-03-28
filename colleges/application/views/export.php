<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->view('head');
?>

<div class="blank">
  <h2>Export Attendance</h2>	

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
                                      <th>Class</th>
                                                                     
                                      <th>Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                              <?php
                              $x=1;
                              
                              foreach($class as $row){?> 
                              <tr>
                                  <td><?php echo $x ?></td>
                                  <td><?php echo $row->name  ?></td>
                                  
                                  <td>  
                                  
                                  <a href="/export/classid/<?php echo $row->id ?>" class="btn btn-1 btn-success">Export</a>
                                 
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


<?php $this->view('footer'); ?>
