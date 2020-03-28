<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->view('head');
?>

<div class="blank">
  <h2>Classrooms</h2>	

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
                                      <th>Classroom Name</th>
                                      <th>College</th>                                   
                                                                        
                                      <th>Total Students</th>
                                      <th>Actions</th>
                                  </tr>
                              </thead>
                              <tbody>
                              <?php
                              $x=1;
                              foreach($data as $row){?> 
                              <tr>
                                  <td><?php echo $x ?></td>
                                  <td><?php echo $row->name ?></td>
                                  <td><?php echo $row->cname ?></td>                                 
                                                             
                                  <td><?php echo $row->totals ?></td>
                                  <td>  
                                  <a href="/classroom/open/<?php echo $row->id ?>" class="btn btn-1 btn-primary">Open</a>
                                  <a href="/classroom/edit/<?php echo $row->id ?>" class="btn btn-1 btn-success">Edit</a>
                                  <a href="/classroom/invite/<?php echo $row->id ?>" type="button" class="btn btn-1 btn-info">Invite</a>
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
