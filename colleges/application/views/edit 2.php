<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->view('head');
?>

<div class="blank">
  <h2>Edit Attendance</h2>	

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
                                      <th>Time</th>
                                                                     
                                      <th>Actions</th>
                                  </tr>
                              </thead>
                              <tbody>
                              <?php
                              $x=1;
                              foreach($record as $row){?> 
                              <tr>
                                  <td><?php echo $x ?></td>
                                  <td><?php echo 'On Date '.date('M j Y g:i A', strtotime($row->stamp)).' For Date '.$row->date.'-'.$row->month.'-'.$row->year;   ?></td>
                                  
                                  <td>  
                                  
                                  <a href="/attend/edit/<?php echo $row->id ?>" class="btn btn-1 btn-success">Edit</a>
                                 
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
