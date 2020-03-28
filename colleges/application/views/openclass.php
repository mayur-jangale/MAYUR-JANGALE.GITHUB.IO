<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->view('head');
?>

<div class="blank">  
    <h2><?php foreach($class as $classs)echo $classs->name; ?></h2>	

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
                                      <th>Announcement</th>
                                                                       
                                                                        
                                      <th>Views</th>
                                      <th>Actions</th>
                                  </tr>
                              </thead>
                              <tbody>
                              <?php
                              $x=1;
                              foreach($data as $row){?> 
                              <tr>
                                  <td><?php echo $x ?></td>
                                  <td><?php echo $row->title ?></td>                            
                                  <td><?php echo $row->views ?></td>
                                  <td>  
                                  <a href="/announcement/open/<?php echo $row->id ?>" class="btn btn-1 btn-primary">Open</a>
                                  <a href="/announcement/edit/<?php echo $row->id ?>" class="btn btn-1 btn-success">Edit</a>
                                  
                                  </td>
                              </tr>
                              <?php
                              $x++;
                              }?>
                          </tbody>
                      </table>
                  </div>
             </div>
      </div>  </div>        




 <?php $this->view('footer'); ?> 